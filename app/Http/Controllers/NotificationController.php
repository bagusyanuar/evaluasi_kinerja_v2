<?php

namespace App\Http\Controllers;

use App\Models\Accessor;
use App\Models\AccessorPPK;
use App\Models\ClaimNotification;
use App\Models\Notification;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //

    public function notif()
    {
        $notif = [];
        $limit = \request('limit');
        $score = \request('score');
        if (Auth::user()->roles[0] == 'accessor' || Auth::user()->roles[0] == 'accessorppk') {
            $notif = ClaimNotification::where('recipient_id', '=', Auth::id())->whereHas('notification', function ($q){
                $q->where('is_active', '=', true);
            })->latest('updated_at');
            if ($limit) {
                $notif = $notif->limit($limit);
            }
            if ($score) {
                $notif = $notif->whereHas(
                    'notification.score',
                    function ($q) use ($score) {
                        $q->where('text', '=', $score);
                    }
                );
            }
            $notif = $notif->get();
        } elseif (Auth::user()->roles[0] == 'vendor') {
            $data = Notification::where([['vendor_id', '=', Auth::id()], ['is_active', '=', true]])->latest();
            if ($limit) {
                $data = $data->limit($limit);
            }
            if ($score) {
                $data = $data->whereHas(
                    'score',
                    function ($q) use ($score) {
                        $q->where('text', '=', $score);
                    }
                );
            }
            $data = $data->get();
            foreach ($data as $key => $d) {
                $notif[$key] = $d;
                if ($d->type == 'accessor') {
                    $s = Accessor::where('user_id', '=', $d->sender_id)->first();
                    Arr::add($notif[$key]['sender'], 'data', $s);
                }
                if ($d->type == 'accessorppk') {
                    $s = AccessorPPK::where('user_id', '=', $d->sender_id)->first();
                    Arr::add($notif[$key]['sender'], 'data', $s);
                }
            }
        }

        return $notif;
    }

    public function notifUnread()
    {
        $notif = '';
        if (Auth::user()->roles[0] == 'accessor' || Auth::user()->roles[0] == 'accessorppk') {
            $notif = ClaimNotification::where('recipient_id', '=', Auth::id())->whereHas('notification', function ($q){
                $q->where('is_read', '=', false);
            })->count('*');
        } elseif (Auth::user()->roles[0] == 'vendor') {
            $notif = Notification::where([['vendor_id', '=', Auth::id()], ['is_read', '=', false]])->count('*');
        }

        return $notif;
    }

    public function detailNotification($type, $id)
    {
        if ($type == 'vendor') {
            $notification = ClaimNotification::with(['notification.score.subIndicator.indicator','notification.score.package'])->where('id', $id)->firstOrFail();
        } else {
            $notification = Notification::with(['sender.'.$type, 'vendor', 'score.subIndicator', 'claim'])->where('id', $id)->firstOrFail();
        }
        $notification->is_read = true;
        $notification->timestamps = false;
        $notification->save();

//        return $notification->toArray();
        return view('superuser.notification.notification-detail')->with(['data' => $notification, 'type' => $type]);
    }

    public function index()
    {
        return view('superuser.notification.all-notif');
    }
}
