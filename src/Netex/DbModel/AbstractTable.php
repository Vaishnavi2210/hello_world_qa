<?php

namespace Netex\HelloWorldQA\DbModel;

use ReflectionClass;
use Netex\HelloWorldQA\Util\DatabaseConnector;
use Netex\HelloWorldQA\Util\ConfigService;

abstract class AbstractTable
{

    /**
     * @var \mysqli $linkDatabase
     */
    static $dbLink;

    public function __construct()
    {
        $self = new ReflectionClass($this);
        $this->table = strtolower($self->getShortName());

        $dbConnectionProperties = ConfigService::readPropertyFile(
            dirname(dirname(__DIR__)) . '/../config/db.properties'
        );

        $databaseConnector = new DatabaseConnector();
        self::$dbLink = $databaseConnector->getConnection($dbConnectionProperties);
    }
} 