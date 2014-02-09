<?php

/**
 * Source of transactions, can read data.csv directly for simplicty sake,
 * should behave like a database (read only)
 *
 */
class TransactionTable implements DataSourceInterface
{
    protected $data;
    var $dataFilePath = '../data.csv';

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        if (!$this->data) {
            $this->setData($this->fetchDataFromFile($this->dataFilePath));
        }

        return $this->data;
    }

    /**
     * Read data from a csv file and return an array with the content
     *
     * @param $filePath
     * @return array
     */
    public function fetchDataFromFile($filePath)
    {
        $fileHandler = $this->openFile($filePath);
        $tmpData = array();
        if ($fileHandler) {
            $numRows = 0;
            while ($row = fgetcsv($fileHandler, null, ';')) {
                $numRows++;
                if ($numRows == 1) {
                    continue; // ignore the first row of the csv
                }

                $tmpData[] = $row;
            }
            fclose($fileHandler);
        }
        return $tmpData;
    }


    /**
     * simple function to open a file and return the file handler
     * when the file is not found return null
     *
     * @param $filePath
     * @return null|resource
     */
    public function openFile($filePath)
    {
        if (file_exists($filePath)) {
            if ($fileHandler = fopen($filePath, 'r')) {
                return $fileHandler;
            }
        }

        return null;
    }


    public function getTransactionsByMerchantId($merchantId)
    {
        $data = $this->getData();
        $result = array();
        if (count($data) > 0) {
            foreach ($data as $row) {
                $tmpResultRow = array(
                    'merchantId' => (int) $row[0],
                    'date' => $row[1],
                    'value' => $row[2],
                );
                if ($tmpResultRow['merchantId'] === $merchantId) {
                    $result[] = $tmpResultRow;
                }
            }
        }

        return $result;
    }
}