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
$driver->get('http://www.property.com.au/');
if ($driver->findElement(WebDriverBy::id('searchBtn'))->isDisplayed() === true) {
    echo "Page loaded Successfully";

    $search_by_buy = $driver->findElement(WebDriverBy::xpath('//*[contains(text(), "Rent")]'))->
        click();
    $location = $driver->findElement(WebDriverBy::id('where'))->sendKeys('');
    $keywords = $driver->findElement(WebDriverBy::id('keywords'))->sendKeys('');
    
    // selecting the property type
    $Property_type = new WebDriverSelect($driver->findElement(WebDriverBy::id
        ('propertyType')));
    if ($Property_type) {
        $Property_type->selectByValue('');
    }

    // selecting the # of beds
    $beds = new WebDriverSelect($driver->findElement(WebDriverBy::id('numBeds')));
    if ($beds) {
        $select->selectByValue('');
    }

    // selecting the min price
    $min_price = new WebDriverSelect($driver->findElement(WebDriverBy::id('minPrice')));
    if ($min_price) {
        $select->selectByValue('');
    }
    
    // selecting the max price
    $max_price = new WebDriverSelect($driver->findElement(WebDriverBy::id('maxPrice')));
    if ($max_price) {
        $select->selectByValue('');
    }

    // clicking on the search button
    $submit = $driver->findElement(WebDriverBy::id('searchBtn'));
    $submit->click();
    
    $result_urls = array();
    
    if($driver->findElement( WebDriverBy::id('searchResultsTbl'))->isDisplayed() === true){
        if(count($driver->findElement( WebDriverBy::cssSelector('#searchResultsTbl div'))) > 0){
            foreach($driver->findElement( WebDriverBy::cssSelector('#searchResultsTbl div')) as $result){
                $result_urls[] = $result->getAttribute('href');
            } 
        } 
    }
    
    echo json_encode($result_urls);
}
$driver->close();
$driver->quit();

?>