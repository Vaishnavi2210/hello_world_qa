<?php
/**
 * Created by PhpStorm.
 * User: Netex_QA
 * Date: 19.02.2016
 * Time: 18:22
 */

namespace Netex\HelloWorldQA\Util;

use Exception;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestSuite;
use PHPUnit_Util_Printer;
use PHPUnit_Framework_TestListener;

class NoOutputPhpUnit extends PHPUnit_Util_Printer implements PHPUnit_Framework_TestListener
{
    public function flush(){}

    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time){}
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time){}
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time){}
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time){}
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time){}
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite){}
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite){}
    public function startTest(PHPUnit_Framework_Test $test){}
    public function endTest(PHPUnit_Framework_Test $test, $time){}

}