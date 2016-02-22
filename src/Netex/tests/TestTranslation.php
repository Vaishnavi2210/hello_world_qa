<?php
/**
 * Created by PhpStorm.
 * User: Netex_QA
 * Date: 19.02.2016
 * Time: 17:41
 */
namespace Netex\HelloWorldQA\tests;

use Netex\HelloWorldQA\DbModel\World;
use PHPUnit_Framework_TestCase;
use DesiredCapabilities;
use RemoteWebDriver;
use WebDriverBy;

class TestTranslation extends PHPUnit_Framework_TestCase
{
    private $googleTranslateUrl = 'https://translate.google.com/';

    /**
     * @var RemoteWebDriver
     */
    private $driver;


    public function setUp()
    {
        //Create selenium session
        $host = 'http://testing.local:4444/wd/hub';
        $capabilities = DesiredCapabilities::firefox();
        $this->driver = RemoteWebDriver::create($host, $capabilities, 5000);
        $this->driver->manage()->window()->maximize();

        $this->driver->get($this->googleTranslateUrl);



    }

    public function tearDown()
    {
        $this->driver->close();
        parent::tearDown();
    }


    public function testWord()
    {
        //Selenium web elements
        $autoDetectLanguage = $this->driver->findElement(
            WebDriverBy::xpath(
                "//div[contains(@id,'gt-lang-left')]//div[contains(@class,'gt-lang-sugg-message')]/div[contains(@value,'auto')]"
            )
        );
        $translateToEn = $this->driver->findElement(
            WebDriverBy::xpath(
                "//div[contains(@id,'gt-lang-right')]//div[contains(@class,'gt-lang-sugg-message')]/div[contains(@value,'en')]"
            )
        );
        $submitTranslate = $this->driver->findElement(
            WebDriverBy::xpath("//div[contains(@id,'gt-lang-submit')]/input"
            )
        );
        $inputText = $this->driver->findElement(
            WebDriverBy::xpath(
                "//div[contains(@id,'gt-src-wrap')]//textarea[contains(@class,'short_text')]"
            )
        );
        $translatedText = $this->driver->findElement(
            WebDriverBy::xpath(
                "//div[contains(@id,'gt-res-wrap')]//span[contains(@class,'short_text')]"
            )
        );

        //Get the last inserted entry from the database
        $world = new World();
        $word = $world->getLatestRecord();

        //assert that the $word(string) length is equal or greater than 3 chars
        $this->assertGreaterThanOrEqual(
            strlen($word),
            3,
            "The given word is too short"
        );

        //set the google autodetect language option
        $autoDetectLanguage->click();

        //set the google translation language
        $translateToEn->click();

        //Insert the word you want translated
        $inputText->sendKeys($word);

        //click on "Translate" button to translate the word inserted
        $submitTranslate->click();
        sleep(2);

        //get the translated word
        $actualText = $translatedText->getText();

        //assert that the translated word means "world"
        $this->assertEquals(
            strtolower("World"),
            strtolower($actualText),
            "The word that you translated does not translate to 'world'"
        );
    }

}