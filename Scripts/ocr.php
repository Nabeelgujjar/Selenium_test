<?php

/**
 * @author Nabeel Shaukat
 * @copyright 2014
 */
require_once(__DIR__ . '/webdriver/lib/__init__.php');
ini_set('max_execution_time', 30000);
// start Firefox with 5 second timeout
$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::firefox();
$driver = RemoteWebDriver::create($host, $capabilities, 300000);
// navigate to 'http://docs.seleniumhq.org/'
$driver->get('http://www.i2ocr.com/');
if ($driver->findElement(WebDriverBy::id('submit_i2ocr'))->isDisplayed() === true) {

    $search_by_buy = $driver->findElement(WebDriverBy::id('i2ocr_uploadedfile'))->
        sendKeys('//local path to image file');

    // selecting the language
    $language = new WebDriverSelect($driver->findElement(WebDriverBy::id('i2ocr_languages')));
    if ($language) {
        $language->selectByValue('');
    }

    // clicking on the search button
    $submit = $driver->findElement(WebDriverBy::id('submit_i2ocr'));
    $submit->click();

    $driver->wait(30)->until(WebDriverExpectedCondition::invisible(WebDriverBy::id('ocrTextBox')));
    if ($driver->findElement(WebDriverBy::id('ocrTextBox'))->isDisplayed() === true) {
        $text = $driver->findElement(WebDriverBy::cssSelector('#searchResultsTbl div'))->getAttribute('innerHTML');
    }
    if(strlen($text) > 0 )
    file_put_contents("data.txt",$text)
}
$driver->close();
$driver->quit();


?>