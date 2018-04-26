<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\MaterialsNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function mark(Request $request,$notification)
    {
    	$notification = Auth::user()->notifications->where('id', $notification)->first();
        $notification->markAsRead();
        return back();
    }
    public function index(Request $request)
    {
    	$notifications = Auth::user()->notifications->where('type', 'App\Notifications\MaterialsNotifications');
    	return view('admin.notification.view', compact('notifications')); 
    }
}
