<?php


namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Mixed_;

class MyBaseController extends BaseController
{
    public function sendResponse(array $params = []): JsonResponse
    {
        $data = array_key_exists('data' , $params) ? $params['data'] : NULL;
        $error = array_key_exists('error' , $params) ? $params['error'] : NULL;

        $code = 200;
        $response = ['success' => true];
        if($error != NULL)
        {
            $response = ['success' => false , 'error' => $error];
            $code = 404;
        }
        if($data)
            $response['data'] = $data;

        return response()->json($response, $code);
    }

    protected function getRequestQueryParameter(Request $request, string $parameter, array $params = [])
    {
        $defaultValue = array_key_exists('defaultValue' , $params) ? $params['defaultValue'] : NULL;
        $foundValue = array_key_exists('foundValue' , $params) ? $params['foundValue'] : NULL;

        if($request->query->has($parameter) || $request->query->get($parameter) == 0)
            return $foundValue == NULL ? $request->query->get($parameter) : $foundValue ;
        else
            return $defaultValue;
    }
}
