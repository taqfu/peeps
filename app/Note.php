<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function type_tags(){
        return $this->hasMany("App\TypeTag");
    }
    public function person_tags(){
        return $this->hasMany("App\PersonTag");
    }
}
