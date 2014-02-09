<?php

/**
 * Class TransactionTableTest
 * @covers TransactionTable
 */
class TransactionServiceTest extends PHPUnit_Framework_TestCase
{


    /**
     * @covers       TransactionTable::getTransactionsByMerchantId
     * @dataProvider provideNoResult
     * test if the method returns an array of Transaction objects
     */
    public function testGetTransactionsByMerchantIdNoResults($staticData)
    {
        $staticMerchantId = 1;
        $numberOfResultsExpected = 0;

        $mockTransactionTable = new MockTransactionTable();
        $transactionServiceObject = new TransactionService($mockTransactionTable);
        $mockTransactionTable->setData($staticData);
        $result = $transactionServiceObject->getTransactionsByMerchantId($staticMerchantId);

        $this->assertCount($numberOfResultsExpected, $result);
    }


    /**
     * @covers       TransactionTable::getTransactionsByMerchantId
     * @dataProvider provideMultipleResults
     * test if the method returns an array of Transaction objects
     */
    public function testGetTransactionsByMerchantIdOneResult($staticData)
    {
        $staticMerchantId = 2;
        $numberOfResultsExpected = 1;
        $mockTransactionTable = new MockTransactionTable();
        $transactionServiceObject = new TransactionService($mockTransactionTable);
        $transactionServiceObject->getDataSource()->setData($staticData);
        $result = $transactionServiceObject->getTransactionsByMerchantId($staticMerchantId);

        $this->assertCount($numberOfResultsExpected, $result);
    }


    /**
     * @covers       TransactionTable::getTransactionsByMerchantId
     * @dataProvider provideMultipleResults
     * test if the method returns an array of Transaction objects
     */
    public function testGetTransactionsByMerchantIdMultipleResults($staticData)
    {
        $staticMerchantId = 1;
        $numberOfResultsExpected = 2;
        $mockTransactionTable = new MockTransactionTable();
        $transactionServiceObject = new TransactionService($mockTransactionTable);
        $transactionServiceObject->getDataSource()->setData($staticData);
        $result = $transactionServiceObject->getTransactionsByMerchantId($staticMerchantId);

        $this->assertCount($numberOfResultsExpected, $result);
    }


    /**
     * @dataProvider provideOneResult
     * check if the method is returnin an array of Transaction objects
     */
    public function testGetTransactionsByMerchantIdIsReturningTransactionObject($staticData)
    {
        $staticMerchantId = 1;
        $mockTransactionTable = new MockTransactionTable();
        $mockTransactionTable->setData($staticData);
        $transactionServiceObject = new TransactionService($mockTransactionTable);


        $result = $transactionServiceObject->getTransactionsByMerchantId($staticMerchantId);

        $this->assertTrue($result[0] instanceof Transaction);
    }


    public function provideNoResult()
    {
        return array(
            'no_result' => array(
                array()
            ),
        );
    }

    public function provideOneResult()
    {
        return array(
            'one_result' => array(
                array(
                    array('1', '01/05/2010', '£50.00')
                )
            ),
        );
    }

    public function provideMultipleResults()
    {
        return array(
            'multiple_results' => array(
                array(
                    array('1', '01/05/2010', '£50.00'),
                    array('1', '02/05/2010', '€12.00'),
                    array('2', '03/05/2010', '$44.00')
                )
            )
        );
    }
}