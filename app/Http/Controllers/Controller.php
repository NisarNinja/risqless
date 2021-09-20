<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Notification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($data = null,$return_flag = "true",$errors = [], $error_detail = ""){

        $data = $data ?? (object)array();

        $response=[];
        $response["header"]["return_flag"]=$return_flag;
        $response["header"]["error_detail"]=$error_detail;
        $response["header"]["errors"] = $errors;
        $response["data"]= $data;

        return $response;
    }

    public function getUserDevices($user){
        $users = [];
        if(!is_array($user)){
            $users[] = $user;
        }else{
            $users = $user;
        }

        return Device::whereIn('user_id',$users)->get()->pluck('device_id');
    }

    public function fcm($users,$title = "",$body = ""){

        if(!$users){
            return;
        }

        foreach ($users as $key => $user) {
            $n = new Notification;
            $n->title = $title;
            $n->body = $body;
            $n->user_id = $user;
            $n->save();
        }
        
        fcm()
        ->to($users)
        ->priority('high')
        ->timeToLive(0)
        ->data([
            'title' => $title,
            'body' => $body,
        ])
        ->notification([
            'title' => $title,
            'body' => $body,
        ])
        ->send();

    }
}
