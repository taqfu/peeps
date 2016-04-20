<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function main_ref(){
        return $this->belongsTo('App\Person', 'ancillary');
    }
}
