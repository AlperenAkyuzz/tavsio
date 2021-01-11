<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // State Turkey
    public $state = 215;

    //==================================================================================================================
    // Private metod
    //==================================================================================================================

    /***
     * @param string $errorCode
     * @param string|array $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(string $errorCode, $message, int $statusCode = 200, $responseData = []){
        return response()->json(['status' => $errorCode, 'message' => $message, 'response' => $responseData],$statusCode);
    }

}
