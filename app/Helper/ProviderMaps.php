<?php


namespace App\Helper;


class ProviderMaps
{
    protected array $rawData;
    protected array $idMapping = ['id' , 'transactionIdentification'];
    protected array $currencyMapping = ['currency' , "Currency"];
    protected array $amountMapping = ['amount' , 'transactionAmount'];
    protected array $dateMapping = ['transactionDate' , 'created_at'];
    protected array $statusMapping = ['status' , 'transactionStatus'];
    protected array $phoneMapping = ['phone' , 'senderPhone'];

    protected array $paidStatusMapping = ["100" , 100 , 1  , "1" , "done"];
    protected array $pendingStatusMapping = ["200" , 200 , 2  , "2" , "wait"];
    protected array $rejectStatusMapping = ["300" , 300 , 3  , "3" , "nope"];
}
