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

        $pass = false;

        $phpunit = new PHPUnit_TextUI_TestRunner();

        try {
            $testResult = $phpunit->doRun($phpunit->getTest(null, dirname(__DIR__).'/tests/TestTranslation.php'),  array("printer"=>(new NoOutputPhpUnit())));
            $pass = $testResult->wasSuccessful();
        } catch (PHPUnit_Framework_Exception $e) {
        }

        return $pass;
    }

    public function act($word){
        $actFine = false;
        $created = $this->create($word);

        if($created){
            $world = new World();
            $word = $world->getLatestRecord();

            if($this->test()) {
                echo "$word means world";
            }
            else echo "<p>$word doesn't mean world!</p></br>\n";

            $actFine = true;
        }

        return $actFine;
    }
}