<?php

/**
 * Class TransactionTableTest
 * @covers TransactionTable
 */
class TransactionTableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers TransactionTable::openFile
     */
    public function testOpenFile()
    {
        $filePath = "data.csv";
        $transactionTable = new TransactionTable();

        $this->assertTrue(!is_null($transactionTable->openFile($filePath)));
    }
}