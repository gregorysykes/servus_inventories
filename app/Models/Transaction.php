<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function detail_transactions(){
        return $this->hasMany('App\Models\DetailTransaction');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function packaging(){
        return $this->hasOne('App\Models\Packaging');
    }
}
