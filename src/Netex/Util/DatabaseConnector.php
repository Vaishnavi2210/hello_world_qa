<?php
/**
 * Created by PhpStorm.
 * User: Cristi C
 * Date: 7/31/14
 * Time: 2:23 PM
 */

namespace Netex\HelloWorldQA\Util;


class DatabaseConnector
{
    public function getConnection($connectionProperties)
    {

        $connection = new \mysqli($connectionProperties['database.host'], $connectionProperties['database.user'], $connectionProperties['database.password'], $connectionProperties['database.name']);

        return $connection;
    }
}