<?php

class MockTransactionTable extends TransactionTable{

    public function getData()
    {
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }
}