<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class InAppPurchaseController extends Controller
{
    /**
     * { function_description }
     */
    public function statusUpdate(Request $request){

        $log = new Log;
        $log->type = 'STATUS_CHANGE';
        $log->log  = json_encode($request->all());
        $log->save();
    }
}
