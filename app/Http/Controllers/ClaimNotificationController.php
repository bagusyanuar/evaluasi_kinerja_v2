<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\ClaimNotification;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ClaimNotificationController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function store()
    {
        try {
            $notification = Notification::with(['score.subIndicator'])->find($this->postField('id'));
            if (!$notification) {
                return response()->json(['msg' => 'Notifikasi Tidak Di Temukan...'], 202);
            }
            $claimId = $this->postField('claim_id');
            $files = \request()->file('file');
            if (!$claimId) {
                $senderId = Auth::id();
                $claim = new ClaimNotification();

                if ($files) {
                    $extension = $files->getClientOriginalExtension();
                    $name = $this->uuidGenerator() . '.' . $extension;
                    $stringImg = '/files/' . $name;
                    $this->uploadImage('file', $name, 'filesUpload');
                    $claim->file = $stringImg;
                }

                $claim->title = 'Pesan Sanggahan';
                $claim->description = 'Pesan Sanggahan Terhadap Penilaian Indicator ' . $notification->score->subIndicator->name . '.';
                $claim->text = $this->postField('text');
                $claim->sender_id = $senderId;
                $claim->recipient_id = $notification->sender_id;
                $claim->notification_id = $notification->id;
                $claim->save();
                return response()->json(['msg' => 'success'], 200);
            } else {
                $claim = ClaimNotification::find($claimId);

                if ($files) {
                    $extension = $files->getClientOriginalExtension();
                    $name = $this->uuidGenerator() . '.' . $extension;
                    $stringImg = '/files/' . $name;
                    $this->uploadImage('file', $name, 'filesUpload');
                    $claim->file = $stringImg;
                }
                $claim->text = $this->postField('text');
                $claim->save();
                return response()->json(['msg' => 'success'], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'], 500);
        }
    }

    public function getCountClaim()
    {
        try {
            $claim = ClaimNotification::where('recipient_id', Auth::id())->get();
            $count = count($claim);
            return response()->json(['msg' => 'success', 'data' => $count], 200);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Terjadi Kesalahan Server..'.$e->getMessage()], 500);
        }
    }
}
