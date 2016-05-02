<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeTag extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    //
    public function type(){
        return $this->belongsTo("App\TagType", "tag_type_id");
    }
}
