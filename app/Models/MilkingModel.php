<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MilkingModel extends Model
{
    use HasFactory;

    protected $table = 'milkings';

    protected $fillable = [
        'milking_date',
        'animal_id',
        'morning_vol',
        'mor_added_by',
        'mor_updated_by',
        'mor_updated_date',
        'evening_vol',
        'eve_added_by',
        'eve_updated_by',
        'eve_updated_date',
    ];

    //Fetch current date Milking record if available
    static public function getTodayMilkingRec($animal_id, $todayDate){

        $return = self::WHERE('animal_id', $animal_id)
                        ->WHERE('milking_date','=', $todayDate)
                        ->first();

        return $return;
    }

    static public function getRecByID($id){

        return self::findOrFail($id);
    }

    //Fetch all the Milking records with filters
    static public function getMilkingRecords(){

        $return = self::SELECT('milkings.*');

                        //Search Filters applied on Milkings Table
                        if (!empty(Request::get('animal_id'))) {
                            $return = $return->WHERE('animal_id','LIKE', '%'.Request::get('animal_id').'%');
                        }

                        if (!empty(Request::get('start_date'))) {
                            $return = $return->WHERE('milking_date','>=', Request::get('start_date'));
                        }

                        if (!empty(Request::get('end_date'))) {
                            $return = $return->WHERE('milking_date','<=', Request::get('end_date'));
                        }
                        
        
        $return = $return->ORDERBY('milking_date', 'desc')
                            ->paginate(10);

        return $return;

    }


    //Dashboard Information feeders
    

    static public function getMorMilkVol($startDate){

        $return = self::SELECT('morning_vol')
                        ->WHERE('milking_date','>=', $startDate)
                        ->get()
                        ->sum('morning_vol');
                        
        return $return;
    }

    static public function getEveMilkVol($startDate){

        $return = self::SELECT('evening_vol')
                        ->WHERE('milking_date','>=', $startDate)
                        ->get()
                        ->sum('evening_vol');
                        
        return $return;
    }


    static public function getMorMilkVolforDay($date){

        $return = self::SELECT('morning_vol')
                        ->WHERE('milking_date','=', $date)
                        ->get()
                        ->sum('morning_vol');
                        
        return $return;
    }

    static public function getEveMilkVolforDay($date){

        $return = self::SELECT('evening_vol')
                        ->WHERE('milking_date','=', $date)
                        ->get()
                        ->sum('evening_vol');
                        
        return $return;
    }

}
