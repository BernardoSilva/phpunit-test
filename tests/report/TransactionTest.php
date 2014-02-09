<?php

//include_once "../models/Transaction.php";

//include_once("../autoloader.php");


class TransactionTest extends PHPUnit_Framework_TestCase
{
    public function setUp(){ }
    public function tearDown(){ }

    public function testConnectionIsValid()
    {
        // test to ensure that the object from an fsockopen is valid
        $transactionObj = new Transaction();

        $this->assertTrue($transactionObj->getCurrencyIsoCode() !== false);
    }
}