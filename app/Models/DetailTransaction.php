<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;
    public function transaction(){
        return $this->belongsTo('App\Models\Transaction');
    }
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
    public function processes(){
        return $this->hasMany('App\Models\Process');
    }
    public function logs(){
        return $this->hasMany('App\Models\Log');
    }
    public function rejects(){
        return $this->hasMany('App\Models\Reject');
    }
}
