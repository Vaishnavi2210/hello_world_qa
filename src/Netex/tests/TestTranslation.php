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
    /**
     * @var string
     */
    private $googleTranslateUrl = 'https://translate.google.com/';

    /**
     * @var RemoteWebDriver
     */
    private $driver;

    public function setUp()
    {
        //Create selenium session
        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::firefox();
        $this->driver = RemoteWebDriver::create($host, $capabilities, 5000);
        $this->driver->manage()->window()->maximize();
    }

    public function tearDown()
    {
        $this->driver->close();
        parent::tearDown();
    }

    public function testWord()
    {
        //Get the last inserted entry from the database
        $world = new World();
        $word = $world->getLatestRecord();

        //assert that the $word(string) is not empty
        $this->assertNotEmpty($word,
            "Last database record is empty. Please insert a word in the database!"
        );

        //Go to google translate site
        $this->driver->get($this->googleTranslateUrl);

        //Set the google autodetect language option
        $autoDetectLanguage = $this->driver->findElement(
            WebDriverBy::xpath(
                "//div[contains(@id,'gt-lang-left')]//div[contains(@class,'gt-lang-sugg-message')]/div[contains(@value,'auto')]"
            )
        );
        $autoDetectLanguage->click();

        //Set the google translation language
        $translateToEn = $this->driver->findElement(
            WebDriverBy::xpath(
                "//div[contains(@id,'gt-lang-right')]//div[contains(@class,'gt-lang-sugg-message')]/div[contains(@value,'en')]"
            )
        );
        $translateToEn->click();

        //Insert the word you want translated
        $inputText = $this->driver->findElement(
            WebDriverBy::xpath(
                "//div[contains(@id,'gt-src-wrap')]//textarea[contains(@class,'short_text')]"
            )
        );
        $inputText->sendKeys($word);
        
        //Click on "Translate" button to translate the word inserted
        $submitTranslate = $this->driver->findElement(
            WebDriverBy::xpath("//div[contains(@id,'gt-lang-submit')]/input"
            )
        );
        $submitTranslate->click();
        sleep(2);

        //Get the translated word
        $translatedText = $this->driver->findElement(
            WebDriverBy::xpath(
                "//div[contains(@id,'gt-res-wrap')]//span[contains(@class,'short_text')]"
            )
        );
        $actualText = $translatedText->getText();

        //Assert that the translated word means "world"
        $this->assertTrue(
            'world' === strtolower($actualText) || 'the world' === strtolower($actualText),
            "The word that you translated does not translate to 'world' or 'the world'."
        );
    }
}