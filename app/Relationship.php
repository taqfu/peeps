<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relationship extends Model
{
    use SoftDeletes;
    protected $dates =["deleted_at"];
    public function secondary () {
        return $this->belongsTo('App\Person', 'secondary_person_id');
    }
    public function type () {
        return $this->belongsTo('App\RelationshipType', 'relationship_type_id');
    }
}
