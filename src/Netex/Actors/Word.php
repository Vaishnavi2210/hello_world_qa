<?php

/**
 * Created by PhpStorm.
 * User: Netex_QA
 * Date: 19.02.2016
 * Time: 16:05
 */
namespace Netex\HelloWorldQA\Actors;

use Netex\HelloWorldQA\DbModel\World;
use PHPUnit_TextUI_TestRunner;
use PHPUnit_Framework_Exception;
use Netex\HelloWorldQA\Util\NoOutputPhpUnit;

class Word
{
    private function create($word){
        $created = false;

        $world = new World();
        $insertId = $world->create($word);

        if($insertId !== null){
            $created = true;
        }

        return $created;
    }

    private function test(){
        $phpunit = new PHPUnit_TextUI_TestRunner();

        try {
            $phpunit->doRun($phpunit->getTest(null, dirname(__DIR__).'/tests/TestTranslation.php'),  array("printer"=>(new NoOutputPhpUnit())));
        } catch (PHPUnit_Framework_Exception $e) {
            print $e->getMessage() . "\n";
            die ("Unit tests failed.");
        }
    }

    public function act($word){
        $actFine = false;
        $created = $this->create($word);

        if($created){
            $world = new World();
            $word = $world->getLatestRecord();
            $this->test();

            echo $word." created";
            $actFine = true;
        }

        return $actFine;
    }
}