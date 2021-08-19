<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public function process(){
        return $this->belongsTo('App\Models\Process');
    }
    public function detail_transaction(){
        return $this->belongsTo('App\Models\DetailTransaction');
    }
    public function state(){
        return $this->belongsTo('App\Models\State');
    }
}
