<?php

interface DataSourceInterface{
    public function getData();
    public function setData($data);
    public function getTransactionsByMerchantId($merchantId);
}