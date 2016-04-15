<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Characteristic extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function type (){
        return $this->belongsTo('App\SimpleType', 'simple_id');

    }
}
