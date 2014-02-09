<?php

/**
 * Class TransactionService
 */
class TransactionService
{

    private $dataSource;

    public function __construct(DataSourceInterface $dataSource)
    {
        $this->setDataSource($dataSource);
    }


    /**
     * @param $merchantId
     * @return array
     */
    public function getTransactionsByMerchantId($merchantId)
    {
        $result = array();
        $queryResult = $this->getDataSource()->getTransactionsByMerchantId($merchantId);

        if (count($queryResult) > 0) {
            foreach ($queryResult as $resultRow) {
                $transaction = new Transaction();
                $transaction->setMerchantId($resultRow['merchantId']);
                $transaction->setDate($resultRow['date']);
                $transaction->setValue($resultRow['value']);
                $result[] = $transaction;
            }
        }

        return $result;
    }

    /**
     * @param mixed $dataSource
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @return mixed
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }


}