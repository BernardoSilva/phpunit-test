<?php

/**
 * This a transaction entity
 * this maps a transaction
 *
 */
class Transaction {
    private $merchantId;
    private $date;
    private $value;
    private $currency;
    private $currencyIsoCode;

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = (int) $merchantId;
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * this method set the numeric value of the transaction
     *
     * @param mixed $value
     */
    public function setValue($value)
    {
        $currencySign = mb_substr($value, 0, 1, 'utf-8');
        $this->value = (float) mb_substr($value, 1, null, 'utf-8');
        // detect the currency by symbol,
        // this is not correct but since data is missing from csv
        // this is an improvise
        $this->detectCurrencyBySign($currencySign);
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $currencyIsoCode
     */
    public function setCurrencyIsoCode($currencyIsoCode)
    {
        $this->currencyIsoCode = $currencyIsoCode;
    }

    /**
     * @return mixed
     */
    public function getCurrencyIsoCode()
    {
        return $this->currencyIsoCode;
    }


    private function detectCurrencyBySign($sign)
    {
        $found = false;
        foreach(CurrencyConverter::$currencies as $currency){
            if($currency['sign'] == $sign){
                $found = true;
                $this->setCurrencyIsoCode($currency['iso_code']);
            }
        }
        if(!$found) {
            throw new \Exception("invalid currency read from csv file.");
        }
    }
}