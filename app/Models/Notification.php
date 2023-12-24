<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';

    protected $with = ['sender','vendor','score'];

    public function score()
    {
        return $this->belongsTo(Score::class, 'score_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function claim(){
        return $this->hasOne(ClaimNotification::class, 'notification_id');
    }
}
