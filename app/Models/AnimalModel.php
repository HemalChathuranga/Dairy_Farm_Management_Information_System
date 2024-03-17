<?php

namespace App\Models;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnimalModel extends Model
{
    use HasFactory;

    protected $table = 'animals';


    //Fetch Animal records
    static public function getAnimalRec(){

        $return = self::SELECT('animals.*');

                        //Search Filters applied on Animal Table
                        if (!empty(Request::get('animal_id'))) {
                            $return = $return->WHERE('animal_id','LIKE', '%'.Request::get('animal_id').'%');
                        }

                        if (!empty(Request::get('breed'))) {
                            $return = $return->WHERE('breed','=', Request::get('breed'));
                        }

                        if (!empty(Request::get('pregnant_status'))) {
                            $return = $return->WHERE('pregnant_status','=', Request::get('pregnant_status'));
                        }

                        if (!empty(Request::get('milking_status'))) {
                            $return = $return->WHERE('milking_status','=', Request::get('milking_status'));
                        }

                        if (!empty(Request::get('status'))) {
                            $return = $return->WHERE('status','=', Request::get('status'));
                        }

        $return = $return->ORDERBY('id', 'asc')
                        ->paginate(5);

        return $return;
    }

    static public function getRecByID($id){

        return self::findOrFail($id);
    }

}
