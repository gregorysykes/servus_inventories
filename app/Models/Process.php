<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;
    public function detail_transaction(){
        return $this->belongsTo('App\Models\DetailTransaction');
    }
    public function state(){
        return $this->belongsTo('App\Models\State');
    }
    public function team(){
        return $this->belongsTo('App\Models\Team');
    }
    public function rejects(){
        return $this->hasMany('App\Models\Reject');
    }
    public function detail_packagings(){
        return $this->hasMany('App\Models\DetailPackaging');
    }
    public function logs(){
        return $this->hasMany('App\Models\Log');
    }
}
