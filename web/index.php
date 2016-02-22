<?php
/**
 * Created by PhpStorm.
 * User: Netex_QA
 * Date: 19.02.2016
 * Time: 16:11
 */
require_once("../vendor/autoload.php");

use Netex\HelloWorldQA\HTTP\GET;

class Main{

    public static function run(){
        GET::parse();
    }

    private function __construct()
    {
    }
}


Main::run();