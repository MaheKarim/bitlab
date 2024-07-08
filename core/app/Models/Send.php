<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Send extends Model
{
    public function wallet(){
        return $this->belongsTo(UserWallet::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
