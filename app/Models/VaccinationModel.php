<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VaccinationModel extends Model
{
    use HasFactory;

    protected $table = 'vaccinations';

    protected $fillable = [
        'animal_id',
        'vac_name',
        'vac_date',
        'vac_by',
        'next_vac_name',
        'next_vac_date',
        'status',
    ];

    static public function getDueRec(){

        $return = self::SELECT('vaccinations.*');
               
        $return = $return->WHERE('status','=', 'Incomplete');

                            //Search Filters applied on Milkings Table
                            if (!empty(Request::get('animal_id'))) {
                                $return = $return->WHERE('animal_id','LIKE', '%'.Request::get('animal_id').'%');
                            }

                            if (!empty(Request::get('start_date'))) {
                                $return = $return->WHERE('next_vac_date','>=', Request::get('start_date'));
                            }

                            if (!empty(Request::get('end_date'))) {
                                $return = $return->WHERE('next_vac_date','<=', Request::get('end_date'));
                            }
        
        $return = $return->ORDERBY('next_vac_date', 'asc')
                            ->paginate(10);

        return $return;

    }


    static public function getRecByID($id){

        return self::findOrFail($id);
    }

    

    static public function getAllVaccinationRec(){

        $return = self::SELECT('vaccinations.*');

                            //Search Filters applied on Milkings Table
                            if (!empty(Request::get('animal_id'))) {
                                $return = $return->WHERE('animal_id','LIKE', '%'.Request::get('animal_id').'%');
                            }

                            if (!empty(Request::get('start_date'))) {
                                $return = $return->WHERE('vac_date','>=', Request::get('start_date'));
                            }

                            if (!empty(Request::get('end_date'))) {
                                $return = $return->WHERE('vac_date','<=', Request::get('end_date'));
                            }
        
        $return = $return->ORDERBY('vac_date', 'desc')
                            ->paginate(10);

        return $return;

    }

    
}
