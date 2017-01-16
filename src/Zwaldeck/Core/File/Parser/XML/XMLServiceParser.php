<?php

namespace Zwaldeck\Core\File\Parser\XML;


use Zwaldeck\Core\DependencyInjection\Service\ConstructorArgument;
use Zwaldeck\Core\DependencyInjection\Service\ConstructorArgumentType;
use Zwaldeck\Core\DependencyInjection\Service\Service;
use Zwaldeck\Core\Exceptions\InvalidXMLFormatException;
use Zwaldeck\Core\File\Parser\ServiceParser;

class XMLServiceParser extends ServiceParser
{

    public function parse()
    {
        $this->parseParameters();
        $this->parseServices();
        $this->disposeContent();
    }

    private function parseParameters() {
        if(!empty($this->content->parameters->param)) {
            foreach ($this->content->parameters->param as $paramElement) {
                if($paramElement['name'] == null) {
                    throw new InvalidXMLFormatException('The <param> tag needs to have the attribute \'name\'!');
                }

                $this->parameters[(string)$paramElement['name']] = (string) $paramElement;
            }
        }
    }

    private function parseServices() {
        if(!empty($this->content->services->service)) {
            foreach ($this->content->services->service as $serviceElement) {
                if($serviceElement['name'] == null) {
                    throw new InvalidXMLFormatException('The <service> tag needs to have the attribute \'name\'!');
                }

                if($serviceElement['class'] == null) {
                    throw new InvalidXMLFormatException('The <service> tag needs to have the attribute \'class\'!');
                }

                $service = new Service();
                $service->setName((string) $serviceElement['name']);
                $service->setClass((string) $serviceElement['class']);

                foreach ($serviceElement->{'con-arg'} as $arg) {
                    $textValue = trim((string) $arg);
                    if(!empty($textValue)) {
                        $service->addConstructorArgument(new ConstructorArgument(ConstructorArgumentType::PLAIN, $textValue));
                    }
                    else {
                        if(!empty($arg->parameter)) {
                            $service->addConstructorArgument(
                                new ConstructorArgument(ConstructorArgumentType::PARAMETER, (string)$arg->parameter)
                            );
                        }
                        else if(!empty($arg->{'link-to-service'})) {
                            $service->addConstructorArgument(
                                new ConstructorArgument(ConstructorArgumentType::SERVICE, (string) $arg->{'link-to-service'})
                            );
                        }
                        else {
                            //it's an array
                            $arr = [];
                            foreach ($arg->array->element as $arrayElement) {
                                if($arrayElement['key'] == null)     {
                                    $arr[] = (string) $arrayElement;
                                }
                                else {
                                    $arr[(string)$arrayElement['key']] = (string) $arrayElement;
                                }
                            }

                            $service->addConstructorArgument(
                                new ConstructorArgument(ConstructorArgumentType::ARRAY, $arr)
                            );
                        }
                    }
                }

                $this->services[] = $service;
            }
        }
    }
}