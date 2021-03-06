<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Characteristic;
use App\Person;
use DB;

class CharacteristicController extends Controller
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
        $characteristic = new Characteristic; 
        $characteristic->person_id = $request->person_id;
        $characteristic->simple_id = $request->simple_id;
        $characteristic->value_type = $request->value_type;
        switch ($request->value_type){
            case "string":
                $characteristic->string = trim($request->string_value);
                break;
            case "date":
                $characteristic->date = $request->date_value;
                break;
            case "number":
                $characteristic->number = $request->number_value;
                break;
        }
        $characteristic->save();
        if ($request->simple_id==2){
            $current_person = Person::where("id", $request->person_id)->first();
            if (empty($current_person->name)){
                $person_model = Person::find($request->person_id);
                $person_model->name = $request->string_value;
                $person_model->save();
            } 
        }
        //return redirect("/profile/$request->person_id");
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person_id = DB::table('characteristics')->where("id", $id)->value('person_id');
        Characteristic::where("id", $id)->delete(); 
        return redirect("/profile/$person_id/characteristics");
    }
}
