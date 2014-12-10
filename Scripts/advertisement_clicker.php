<?php

/**
 * @author Nabeel Shaukat
 * @copyright 2014
 */

require_once(__DIR__ . '/webdriver/lib/__init__.php');
ini_set('max_execution_time', 300000000);
// start Firefox with 5 second timeout
$host = 'http://localhost:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::firefox();
$driver = RemoteWebDriver::create($host, $capabilities, 300000);

// navigate to 'http://docs.seleniumhq.org/'
$driver->get('http://www.visit4earn.com/index.php');
$link = $driver->findElement(WebDriverBy::linkText('Login'));
$link->click();

$username = $driver->findElement(WebDriverBy::id('username'));
$username->sendKeys('user_name');
$password = $driver->findElement(WebDriverBy::id('password'));
$password->sendKeys('password');
sleep(20);
if (file_exists('code.txt')) {
    $code = file_get_contents('code.txt');
}

$security_code = $driver->findElement(WebDriverBy::id('code'));
$security_code->sendKeys($code);
$enterin = $driver->findElement(WebDriverBy::className('f-submit'));
$enterin->submit();

$link = $driver->findElement(WebDriverBy::linkText('View Ads'));
$link->click();
sleep(6);
$driver->get('http://www.visit4earn.com/viewads.php');
$link = $driver->findElement(WebDriverBy::cssSelector('a[href="javascript:void(0);"]:nth-child(3)'));
$link->click();
$next = $driver->wait(30)->until(WebDriverExpectedCondition::
    presenceOfElementLocated(WebDriverBy::tagName('body')));
sleep(40);
$executer = $driver->execute(DriverCommand::ACCEPT_ALERT);
$executer = $driver->execute(DriverCommand::ACCEPT_ALERT);
sleep(6);
//$driver->close();
$driver->get('http://www.visit4earn.com/viewads.php');
$link = $driver->findElement(WebDriverBy::cssSelector('a[href="javascript:void(0);"]:nth-child(4)'));
$link->click();
$next = $driver->wait(30)->until(WebDriverExpectedCondition::
    presenceOfElementLocated(WebDriverBy::tagName('body')));
sleep(40);
$executer = $driver->execute(DriverCommand::ACCEPT_ALERT);
$executer = $driver->execute(DriverCommand::ACCEPT_ALERT);
sleep(6);

$driver->get('http://www.visit4earn.com/viewads.php');
$link = $driver->findElement(WebDriverBy::cssSelector('a[href="javascript:void(0);"]:nth-child(5)'));
$link->click();
$next = $driver->wait(30)->until(WebDriverExpectedCondition::
    presenceOfElementLocated(WebDriverBy::tagName('body')));
sleep(40);
$executer = $driver->execute(DriverCommand::ACCEPT_ALERT);
$executer = $driver->execute(DriverCommand::ACCEPT_ALERT);
sleep(6);
$driver->close();
$driver->quit();



?>