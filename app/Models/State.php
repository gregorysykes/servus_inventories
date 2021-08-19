<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    public function processes(){
        return $this->hasMany('App\Models\Process');
    }
    public function log(){
        return $this->hasOne('App\Models\Log');
    }
    public function rejects(){
        return $this->hasMany('App\Models\Reject');
    }
}
