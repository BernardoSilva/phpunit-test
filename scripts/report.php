<?php

include_once("../autoloader.php");


//TODO print formatted report

$merchantId = (int)$argv[1];

if (!$merchantId) {
    echo "Error: <merchantId> param missing \n";
    echo "usage: php report.php <merchantId> \n";
    exit(0);
}

// get data source object
$dataSource = new TransactionTable();

// set data service
$transactionService = new TransactionService($dataSource);


// set merchant
$merchant = new Merchant($transactionService);
$merchant->setId($merchantId);


$reportCurrency = 'GBP';
echo 'Transactions for MerchantId (' . $merchant->getId() . ') in ' . $reportCurrency . "\n";

// instantiate currency web service
$currencyWebservice = new CurrencyWebservice();


// pass currencyWebservice dependency to instantiate currency converter
$currencyConverter = new CurrencyConverter($currencyWebservice);

$merchantTransactions = $merchant->getTransactions();

if(count($merchantTransactions) > 0){
    foreach ($merchantTransactions as $transaction) {
        echo "date: " . $transaction->getDate() . "\t";
        $value = $currencyConverter->convert($transaction->getValue(), $transaction->getCurrencyIsoCode(), $reportCurrency);
        echo "value: " . CurrencyConverter::$currencies[$reportCurrency]['sign'] . $value . " \n";
    }
    echo "\n";
} else {
    echo "This merchant does not have transactions. \n\n";
}

