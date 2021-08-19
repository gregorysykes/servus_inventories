<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPackaging extends Model
{
    use HasFactory;
    public function packaging(){
        return $this->belongsTo('App\Models\Packaging');
    }
    public function process(){
        return $this->belongsTo('App\Models\Process');
    }
}
