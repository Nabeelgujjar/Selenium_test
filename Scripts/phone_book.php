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

$driver->get('http://www.phonebook.com.pk/dynamic/basiclisting.aspx');
if ($driver->findElement(WebDriverBy::cssSelector('input[value="Submit"]'))->isDisplayed() === true) {

    $company_name = $driver->findElement(WebDriverBy::id('ctl00_cphM_cName'))->sendKeys('');
    
     // selecting the city
    $city = new WebDriverSelect($driver->findElement(WebDriverBy::id('ctl00_cphM_ddlcity')));
    if ($city) {
        $city->selectByVisibleText('');
    }

     // selecting the area
    $area = new WebDriverSelect($driver->findElement(WebDriverBy::id('ctl00_cphM_ddlarea')));
    if ($area) {
        $area->selectByVisibleText('');
    }
    
    $Address = $driver->findElement(WebDriverBy::id('ctl00_cphM_cAdd'))->sendKeys('//company address here');
    $phone_num = $driver->findElement(WebDriverBy::id('ctl00_cphM_cph'))->sendKeys('//company phone # here');
    $mobile_num = $driver->findElement(WebDriverBy::id('ctl00_cphM_cCell'))->sendKeys('//company mobile # here');
    $fax = $driver->findElement(WebDriverBy::id('ctl00_cphM_cFax'))->sendKeys('//company fax here');
    $email = $driver->findElement(WebDriverBy::id('ctl00_cphM_cEmail'))->sendKeys('//Email here');
    $website = $driver->findElement(WebDriverBy::id('ctl00_cphM_cWeb'))->sendKeys('//website here');
    $contact_person = $driver->findElement(WebDriverBy::id('ctl00_cphM_cCP'))->sendKeys('//company contact person here');
    $keywords = $driver->findElement(WebDriverBy::id('ctl00_cphM_cKw'))->sendKeys('//keywords here');

    
    for($i=1 ; $i <= 6 ; $i++){
        $driver->findElement(WebDriverBy::id('ctl00_cphM_chk'.$i))->click();
    }
    // clicking on the submit button
    $submit = $driver->findElement(WebDriverBy::id('ctl00_cphM_btnsub'));
    $submit->click();

    $succcess = $driver->wait(60)->until(
			  	WebDriverExpectedCondition::visible(
			    	WebDriverBy::xpath('//*[contians(text() , "Your Basic Request has been received Successfully")]')
			  	)
			);
    if(!$success){
        if($driver->findElement(WebDriverBy::id('ctl00_cphM_rfvCompName'))->isDisplayed === true){
            echo "Company Name Required";
        }
        if($driver->findElement(WebDriverBy::id('ctl00_cphM_rfvEmail'))->isDisplayed === true){
            echo "Email is required or Email Address is NOT valid";
        }
        if($driver->findElement(WebDriverBy::id('ctl00_cphM_rfvCP'))->isDisplayed === true){
            echo "Contact Person Required";
        }
        if($driver->findElement(WebDriverBy::id('ctl00_cphM_rfvKeyword'))->isDisplayed === true){
            echo "Keywords are required";
        }
    }
}
$driver->close();
$driver->quit();


?>