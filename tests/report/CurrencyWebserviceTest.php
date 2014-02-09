<?php

//include_once "../models/Transaction.php";

//include_once("../autoloader.php");

/**
 * Class CurrencyWebserviceTest
 * @covers CurrencyWebservice
 */
class CurrencyWebserviceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers CurrencyWebserviceTest::getExchangeRate
     */
    public function testGetExchangeRateReturnsFloatRate()
    {
        $currencyWebservice = new CurrencyWebservice();
        $fromCurrency = null;
        $toCurrency = null;
        $rate = $currencyWebservice->getExchangeRate($fromCurrency, $toCurrency);

        $this->assertTrue(is_float($rate));
    }
}