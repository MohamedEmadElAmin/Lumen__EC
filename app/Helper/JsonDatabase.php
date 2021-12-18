<?php


namespace App\Helper;


use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class JsonDatabase
{
    private static array $formattedData;

    public static function getDataFromJsonFiles(array $params = []): array
    {
        if(!isset(self::$formattedData))
            self::$formattedData = (new self)->readJsonFiles($params);

        return self::$formattedData;
    }


    //this will be registered as service
    private function readJsonFiles(array $params = []): array
    {
        //Filters
        $provider = array_key_exists('provider' , $params) ? $params['provider'] : NULL;
        $statusCode = array_key_exists('statusCode' , $params) ? $params['statusCode'] : NULL;
        $currency = array_key_exists('currency' , $params) ? $params['currency'] : NULL;
        $amountMin = array_key_exists('amountMin' , $params) ? $params['amountMin'] : NULL;
        $amountMax = array_key_exists('amountMax' , $params) ? $params['amountMax'] : NULL;


        $folderPath = realpath(__DIR__ . '/../../database/json');

        //Guard/Fail Test -->
        try
        {
            $files = scandir($folderPath);
        }
        catch(\Exception $e)
        {
           return ["success" => false , "error" => "Path or Folder Not Found."];
        }



        $data = [];
        foreach($files as $file)
        {
            if($file != "." && $file != ".." && $file != "Thumbs.db" && $file != basename(__FILE__))
            {
                $info = pathinfo($file);
                if(isset($info['extension']) && $info['extension'] != 'json')
                    continue;

                //Filter1
                if($provider && $info['filename'] != $provider)
                    continue;

                //Skip json file if the file had any error
                try
                {
                    $json = json_decode(file_get_contents($folderPath . "/" .$info['basename']), true);
                    $data = array_merge($data , $json);
                }
                catch(\Exception $e)
                {
                    //ignore this file for now
                    //echo 'Message: ' .$e->getMessage();
                }
            }
        }


        $objectData = [];
        foreach ($data as $item)
        {
            $formattedData = new DataProvider($item);

            //Filter2
            if($statusCode && strtolower($statusCode) != $formattedData->getStatus())
                continue;

            //Filter3
            if($currency && $currency != $formattedData->getCurrency())
                continue;

            //Filter4
            if($amountMin && $amountMin >= $formattedData->getAmount())
                continue;

            //Filter5
            if($amountMax && $amountMax <= $formattedData->getAmount())
                continue;

            array_push($objectData , $formattedData->toArray());
        }
        return ["success" => true , "data" => $objectData , "count" => count($objectData)];
    }
}
