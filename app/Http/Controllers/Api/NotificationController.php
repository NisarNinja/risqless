<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * get user notifications
     *
     * @param      \Illuminate\Http\Request  $request  The request
     */
    public function index(Request $request){

        $notifications = Notification::where('user_id', $request->query('user_id') ?? $request->user_id )->latest()->limit(20)->get()->transform(function($noti){
            return [
                'title' => $noti['title'],
                'body' => $noti['body'],
                'user_id' => $noti['user_id'],
                'created_at' => $noti['created_at'],
            ];
        });
        return $this->response($notifications);
        // $notifications0
    }
}
