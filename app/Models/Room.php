<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function admin() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function attendee() {
        return $this->belongsToMany(User::class,'room_user');
    }
   
}
