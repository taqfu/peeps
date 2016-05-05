<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Relationship;
use App\RelationshipType;
class RelationshipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $relationship_type = new RelationshipType;
        $relationship_type->name = $request->newRelationshipTypeName;
        $relationship_type->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $relationship_type = RelationshipType::find($id);
        $inverse_relationship_type = RelationshipType::find($request->inverseRelationshipTypeID);
        $relationship_type->inverse_relationship_type_id = $inverse_relationship_type->id;
        $inverse_relationship_type->inverse_relationship_type_id = $relationship_type->id;
        $inverse_relationship_type->save();
        $relationship_type->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Relationship::where("relationship_type_id", $id)->delete();
        RelationshipType::where("id", $id)->delete();
        return back();
        //
    }
}
