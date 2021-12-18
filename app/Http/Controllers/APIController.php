<?php

namespace App\Http\Controllers;

use App\Helper\DataProvider;
use App\Helper\JsonDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIController extends MyBaseController
{
    public function transactions(Request $request): JsonResponse
    {
        $statusCode = $this->getRequestQueryParameter($request , "statusCode");
        $provider = $this->getRequestQueryParameter($request , "provider");
        $currency = $this->getRequestQueryParameter($request , "currency");
        $amountMin = $this->getRequestQueryParameter($request , "amountMin");
        $amountMax = $this->getRequestQueryParameter($request , "amountMax");

        $params = ["provider" => $provider , "statusCode" => $statusCode , "currency" => $currency ,
           "amountMin" => $amountMin , "amountMax" => $amountMax];
        $result = app(JsonDatabase::class)::getDataFromJsonFiles($params);
        return $this->sendResponse($result);
    }
}
