<?php

namespace Zwaldeck\Plugins\DBALPlugin\Driver;

use Zwaldeck\Plugins\DBALPlugin\Connection;
use Zwaldeck\Plugins\DBALPlugin\Schema\AbstractSchemaManager;

/**
 * Interface Driver
 * @package Zwaldeck\Plugins\DBALPlugin\Driver
 */
interface Driver
{
    /**
     * @param string $host
     * @param string $user
     * @param string $pass
     * @param string $databaseName
     * @param int $port
     * @param string $charset
     * @param array $options
     * @return Connection
     */
    function createConnection(string $host, string $user, string $pass, string $databaseName, int $port, string $charset = 'utf8', $options = array()): Connection;

    /**
     * Gets the schema manager to inspect & change the database schema
     *
     * @param Connection $connection
     * @return AbstractSchemaManager
     */
    function getSchemaManager(Connection $connection): AbstractSchemaManager;

    /**
     * Gets the database name
     *
     * @param Connection $connection
     * @return string
     */
    function getDatabaseName(Connection $connection): string;
}