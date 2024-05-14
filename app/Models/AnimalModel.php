<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnimalModel extends Model
{
    use HasFactory;

    protected $table = 'animals';

    // protected $fillable = [
    //     'animal_id',
    //     'birth_date',
    //     'breed',
    //     'gender',
    //     'stall_number',
    //     'weight_at_birth',
    //     'height_at_birth',
    //     'buy_date',
    //     'buy_price',
    //     'notes',
    //     'father_id',
    //     'mother_id',
    //     'pregnant_status',
    //     'pregnancy_occ',
    //     'next_pregnancy_appox_date',
    //     'milking_status',
    //     'created_by',
    //     'updated_by',
    //     'status',
    //     'qr_code'
    // ];



    public function getAgeAttribute(){

        return Carbon::parse($this->birth_date)->age;
    }

    //Fetch Animal records
    static public function getAnimalRec(){

        $return = self::SELECT('animals.*');

                        //Search Filters applied on Animal Table
                        if (!empty(Request::get('animal_type'))) {

                            if (Request::get('animal_type') == 'cow') {
                                $return = $return->WHERE('gender','=', 'Female')
                                                    ->WHERE('pregnancy_occ','>', 0);
                            }

                            if (Request::get('animal_type') == 'heifer') {
                                $return = $return->WHERE('gender','=', 'Female')
                                                    ->WHERE('pregnancy_occ','=', 0);
                            }

                            if (Request::get('animal_type') == 'bull') {
                                $return = $return->WHERE('gender','=', 'Male');
                            }

                            if (Request::get('animal_type') == 'bull_calf') {
                                $return = $return->WHERE('gender','=', 'Male');
                            }

                        }

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


    //Fetch Animal record for Animal Info
    static public function getRecByAniID($animal_id){

        $return = self::WHERE('animal_id', $animal_id)->first();

        return $return;
    }


    static public function getFullAnimalCount(){

        $return = self::SELECT('animals.*')
                        ->WHERE('status','=','Active');

        $return = $return->count();

        return $return;
    }

    static public function getAnimalCount($gender){

        $return = self::SELECT('animals.*')
                        ->WHERE('status','=','Active')
                        ->WHERE('gender','=',$gender);

        $return = $return->count();

        return $return;
    }


    static public function getMilkingAnimalCount(){

        $return = self::SELECT('animals.*')
                        ->WHERE('status','=','Active')
                        ->WHERE('gender','=','Female')
                        ->WHERE('milking_status','=','Milking');

        $return = $return->count();

        return $return;
    }

    static public function getStallCount(){

        $return = self::SELECT('stall_number')
                        ->distinct()
                        ->get()
                        ->count();
                        
        return $return;
    }

    static public function getNonMilkingAnimalCount(){

        $return = self::SELECT('animals.*')
                        ->WHERE('status','=','Active')
                        ->WHERE('gender','=','Female')
                        ->WHERE('milking_status','=','Non-Milking');

        $return = $return->count();

        return $return;

    }

    
    static public function getPregAnimalCount(){

        $return = self::SELECT('animals.*')
                        ->WHERE('status','=','Active')
                        ->WHERE('gender','=','Female')
                        ->WHERE('pregnant_status','=','Yes');

        $return = $return->count();

        return $return;

    }

    
    static public function getNewBirhtCount($firstDayofWeek){

        $return = self::SELECT('animals.animal_id')
                        ->WHERE('status','=','Active')
                        ->WHERE('birth_date','>=',$firstDayofWeek);

        $return = $return->count();

        return $return;
    }

}
