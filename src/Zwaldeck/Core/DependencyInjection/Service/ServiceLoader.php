<?php

namespace Zwaldeck\Core\DependencyInjection\Service;


use Zwaldeck\Core\DependencyInjection\ContainerInterface;
use Zwaldeck\Core\Exceptions\ServiceLoaderException;

class ServiceLoader
{
    /**
     * @var array
     */
    private $servicesToLoad;

    public function __construct(array $servicesToLoad)
    {
        $this->servicesToLoad = $servicesToLoad;
        $this->checkServiceNames();
    }

    //todo optimize this method
    public function loadServices(ContainerInterface &$container) {
        for($i = 0; $i < count($this->servicesToLoad); $i++) {

            /** @var Service $service */
            $service = $this->servicesToLoad[$i];

            if($this->canLoadService($service, $container)) {

                $realArg = $this->getRealConstructorArguments($service, $container);

                $reflectionClass = new \ReflectionClass($service->getClass());
                $serviceObj = $reflectionClass->newInstanceArgs($realArg);
                if($reflectionClass->implementsInterface("Zwaldeck\\Core\\DependencyInjection\\ContainerAwareInterface")) {
                    $serviceObj->setContainer($container);
                }

                $container->addService($service->getName(), $serviceObj);
                unset($this->servicesToLoad[$i]);
            }
        }

        if(!empty($this->servicesToLoad)) {
            $this->servicesToLoad = array_values($this->servicesToLoad);
            $this->loadServices($container);
        }
    }

    private function checkServiceNames() {
        /** @var Service $service */
        foreach ($this->servicesToLoad as $service) {
            $deps = $this->getServiceDependencies($service);
            foreach ($deps as $dep) {
                $found = false;
                /** @var Service $checkService */
                foreach ($this->servicesToLoad as $checkService) {
                    if($checkService->getName() == $dep) {
                        $found = true;
                        break;
                    }
                }

                if(!$found) {
                    throw new ServiceLoaderException("We could not find a service with the name '{$dep}' anywere in your service xml files. Is there a typo?");
                }
            }
        }
    }

    /**
     * @param Service $service
     * @param ContainerInterface $container
     * @return bool
     */
    private function canLoadService(Service $service, ContainerInterface $container): bool {
        $dependencies = $this->getServiceDependencies($service);

        if(empty($dependencies)) {
            return true;
        }

        foreach ($dependencies as $dependency) {
            if(!$container->hasService($dependency)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param Service $service
     * @return array
     */
    private function getServiceDependencies(Service $service): array {
        $dependencies = [];

        /** @var ConstructorArgument $constructorArg */
        foreach ($service->getConstructorArgs() as $constructorArg) {
            if($constructorArg->getType() === ConstructorArgumentType::SERVICE) {
                $dependencies[] = $constructorArg->getArgument();
            }
        }

        return $dependencies;
    }

    private function getRealConstructorArguments(Service $service, ContainerInterface $container): array {
        $realArg = [];

        /** @var ConstructorArgument $constructorArg */
        foreach ($service->getConstructorArgs() as $constructorArg) {
            switch ($constructorArg->getType()) {
                case ConstructorArgumentType::PLAIN:
                case ConstructorArgumentType::ARRAY:
                    $realArg[] = $constructorArg->getArgument();
                    break;
                case ConstructorArgumentType::PARAMETER:
                    if(!$container->hasParameter($constructorArg->getArgument())) {
                        throw new ServiceLoaderException("The container does not have the parameter '{$constructorArg->getArgument()}'!");
                    }
                    $realArg[] = $container->getParameter($constructorArg->getArgument());
                    break;
                case ConstructorArgumentType::SERVICE:
                    $realArg[] = $container->getService($constructorArg->getArgument());
                    break;
            }
        }

        return $realArg;
    }
}