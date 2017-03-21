<?php

namespace Zwaldeck\Plugins\DBALPlugin\Schema;


use Zwaldeck\Plugins\DBALPlugin\Connection;

/**
 * Class AbstractSchemaManager
 * @package Zwaldeck\Plugins\DBALPlugin\Schema
 */
//TODO map all constraints
abstract class AbstractSchemaManager
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     */
    public abstract function getDatabases() : array ;

    /**
     * @return Sequence[]
     */
    public abstract function getSequences() : array ;

    /**
     * @return Table[]
     */
    public abstract function getTables(): array ;

    /**
     * @param array $tableNames
     * @return boolean
     */
    public abstract function doesTablesExist(array $tableNames): bool ;

    /**
     * @param string $table
     * @return Table
     */
    public abstract function getTable(string $table): ?Table;

    /**
     * @param string $table
     * @return Column[]
     */
    public abstract function getTableColumns(string $table): array;

    /**
     * @param string $table
     * @return Index[]
     */
    public abstract function getTableIndexes(string $table): array ;

    /**
     * @param string $table
     * @return ForeignKeyConstraint[]
     */
    public abstract function getTableForeignKeys(string $table): array ;

    /**
     * @param string $db
     */
    public abstract function dropDatabase(string $db): void;

    /**
     * @param string $table
     */
    public abstract function dropTable(string $table): void;

    /**
     * @param Index $index
     * @param string $table
     */
    public abstract function dropIndex(Index $index, string $table) : void;

    /**
     * @param ForeignKeyConstraint $fk
     * @param string $table
     */
    public abstract function dropForeignKey(ForeignKeyConstraint $fk, string $table): void;

    /**
     * @param string $name
     */
    public abstract function dropSequence(string $name): void;

    /**
     * @param string $name
     */
    public abstract function dropView(string $name): void;

    /**
     * @param string $database
     */
    public abstract function createDatabase(string $database) : void;

    /**
     * @param Table $table
     */
    public abstract function createTable(Table $table): void;

    /**
     * @param Index $index
     */
    public abstract function createIndex(Index $index): void;

    /**
     * @param ForeignKeyConstraint $fk
     */
    public abstract function createForeignKey(ForeignKeyConstraint $fk): void;

    /**
     * @param Sequence $sequence
     */
    public abstract function createSequence(Sequence $sequence): void;

    /**
     * @param View $view
     */
    public abstract function createView(View $view): void;
}