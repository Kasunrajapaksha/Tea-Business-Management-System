<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        $user = Auth::user();
        $notifications = $user->notifications;
        return view('notification',[
            'notifications' => $notifications,
        ]);
    }

    public function markAsRead(){
        $user = Auth::user();
        $notification = $user->notifications->where('id', request('notification_id'));
        $notification->markAsRead();

        return redirect()->back();
    }

    public function markAllAsRead(){
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
