<?php

class MockCurrencyWebservice extends CurrencyWebservice
{
    public function getExchangeRate($fromCurrency, $toCurrency)
    {
        return 1.2;
    }
}