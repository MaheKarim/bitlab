<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class Send extends Model
{
    use GlobalStatus;
    public function wallet(){
        return $this->belongsTo(UserWallet::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Scope
    public function scopeSendFailed($query)
    {
        return $query->where('status', Status::FAILED);
    }

    public function scopeSendPending($query)
    {
        return $query->where('status', Status::PENDING);
    }
}
