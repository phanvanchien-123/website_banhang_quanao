<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function fetch()
    {
        $notifications = Auth::user()->unreadNotifications;

        // Đánh dấu thông báo là đã đọc (nếu cần)
        $notifications->markAsRead();

        return response()->json($notifications);
    }
}
