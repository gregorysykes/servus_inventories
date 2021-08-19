<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    use HasFactory;
    public function detail_packagings(){
        return $this->hasMany('App\Models\DetailPackaging');
    }
    public function transaction(){
        return $this->belongsTo('App\Models\Transaction');
    }
}
