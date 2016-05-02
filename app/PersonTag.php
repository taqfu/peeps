<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonTag extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    //
    public function person(){
        return $this->belongsTo("App\Person");
    }
}
