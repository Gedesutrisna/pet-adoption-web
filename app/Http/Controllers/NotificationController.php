<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function read(Notification $notification)
    {
        $notification->update(['read_at' => now()]);
        return back();
    }
}
