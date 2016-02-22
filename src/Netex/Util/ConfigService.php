<?php
/**
 * Created by PhpStorm.
 * User: Cristi C
 * Date: 7/31/14
 * Time: 2:25 PM
 */

namespace Netex\HelloWorldQA\Util;


class ConfigService
{
    private function __construct()
    {
    }

    public static function readPropertyFile($configFile)
    {
        $configs = parse_ini_file($configFile);

        if (false === $configs) {
            throw new \Exception(sprintf('Invalid config file at [%s]', $configFile));
        }

        return $configs;
    }
}