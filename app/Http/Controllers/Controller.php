<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function JsonResponse($parameter)
    {
        return response()->json([
            'messages' => $parameter["messages"],
            'data' => $parameter["data"],
            'status' => ($parameter["code"] ==200)? "true": "false",
            'code' => $parameter["code"]
        ], 200);
		
    }
}
