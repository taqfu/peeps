<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ToDo;
use DB;

class ToDoController extends Controller
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
        $to_do = new ToDo;
        $to_do->name = $request->newToDo;
        $to_do->people_id = $request->person_id;
        $to_do->save();
        return redirect ("/profile/$request->person_id/todo");
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
        $to_do = ToDo::find($id);
        if ((boolean)$request->status){
           $to_do->completed_at = date('Y-m-d H:i:s'); 
        } else if (!(boolean)$request->status){
            $to_do->completed_at = NULL;
        }
        $to_do->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person_id = DB::table('to_dos')->where("id", $id)->value('people_id');
        ToDo::where("id", $id)->delete(); 
        return redirect("/profile/$person_id/todo");
    }
}
