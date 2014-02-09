<?php

/**
 * Class Merchant
 */
class Merchant
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var array()
     */
    private $transactions;
    /**
     * @var TransactionService $transactionService
     */
    protected $transactionService;


    /**
     * @param TransactionService $transactionService
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->setTransactionService($transactionService);
    }

    /**
     * @return Transaction[]
     */
    public function getTransactions()
    {
        if (!$this->transactions) {
            $this->transactions = $this->getTransactionService()->getTransactionsByMerchantId($this->getId());
        }
        return $this->transactions;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed TransactionService
     */
    public function setTransactionService(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * @return TransactionService
     */
    public function getTransactionService()
    {
        return $this->transactionService;
    }
}