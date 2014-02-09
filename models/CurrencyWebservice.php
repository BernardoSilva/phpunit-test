<?php

/**
 * Dummy web service returning random exchange rates
 *
 */
class CurrencyWebservice
{

    /**
     * @todo return random value here for basic currencies like GBP USD EUR (simulates real API)
     *
     */
    public function getExchangeRate($fromCurrency, $toCurrency)
    {

        return (float) (rand(0, 1).'.'.rand(0,99));
    }
}