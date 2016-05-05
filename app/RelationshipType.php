<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationshipType extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function inverse(){
        return $this->belongsTo("App\RelationshipType", "inverse_relationship_type_id");
    }
}
