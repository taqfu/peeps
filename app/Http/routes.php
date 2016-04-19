<?php
use \App\Characteristic;
use \App\DB;
use \App\Note;
use \App\Person;
use \App\Group;
use \App\GroupType;
use \App\SimpleType;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::get('/{sort?}', ['as'=>'listings', function ($sort=null) { 
        if ($sort==="alphabetically"){
            $order_by = "name";
        } else if ($sort==="numerically"){
            $order_by = "id";
        } else {
            $order_by = "created_at";
        }
        return view('listings', [
            "sort" => $order_by,
            "people" => Person::orderBy($order_by, "asc")->get(),
            "groups" => Group :: orderBy("created_at", "asc")->geT(),
            "group_types" => GroupType :: orderBy("name", "asc")->get(),
        ]);
    }]);

    Route::get('/profile/{person_id}', function ($person_id){
        return view ('profile.summary', [
            "person_id" => $person_id,
            "people"=> Person::where("id", $person_id)->get(),
            "characteristics" => Characteristic::where('person_id', $person_id)->where("simple_id", 2)->get()
        ]);
    });

    Route::get('/profile/{person_id}/characteristics', function ($person_id){
        return view ('profile.characteristics', [
            "person_id" => $person_id,
            "simple_types" => SimpleType::orderBy("name", "asc")->get(),
            "characteristics" => Characteristic::where('person_id', $person_id)->orderBy("simple_id", "asc")->get()
        ]);
    });
    
    Route::get('/profile/{person_id}/notes', function ($person_id){
        return view ('profile.notes', [
            "person_id" => $person_id,
            "people"=> Person::where("id", $person_id)->get(),
            "notes"=> Note::where("person_id", $person_id)->orderBy("created_at", "desc")->get()
        ]);
    });

    Route::resource('/note', 'NoteController');
    Route::resource('person', 'PersonController');
    Route::resource('/type/simple', 'SimpleTypeController');
    Route::resource('/characteristic', 'CharacteristicController');
    Route::resource('group', 'GroupController');
    Route::resource('groupType', 'GroupTypeController');
