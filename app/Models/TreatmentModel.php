<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TreatmentModel extends Model
{
    use HasFactory;

    protected $table = 'treatments';

    protected $fillable = [
        'animal_id',
        'inspect_date',
        'illness',
        'inspect_by',
        'treatment',
        'treat_by',
        'treat_date',
        'milking_status',
        'treatment_status',
    ];


    static public function getRecByID($id){

        return self::findOrFail($id);
    }

    

    static public function getPendRec(){

        $return = self::SELECT('treatments.*');
               
        $return = $return->WHERE('treatment_status','=', 'Pending');

                            //Search Filters applied on Milkings Table
                            if (!empty(Request::get('animal_id'))) {
                                $return = $return->WHERE('animal_id','LIKE', '%'.Request::get('animal_id').'%');
                            }

                            if (!empty(Request::get('start_date'))) {
                                $return = $return->WHERE('inspect_date','>=', Request::get('start_date'));
                            }

                            if (!empty(Request::get('end_date'))) {
                                $return = $return->WHERE('inspect_date','<=', Request::get('end_date'));
                            }
        
        $return = $return->ORDERBY('inspect_date', 'asc')
                            ->paginate(10);

        return $return;

    }


    static public function getAllTreatmentRec() {

        $return = self::SELECT('treatments.*');

                            //Search Filters applied on Milkings Table
                            if (!empty(Request::get('animal_id'))) {
                                $return = $return->WHERE('animal_id','LIKE', '%'.Request::get('animal_id').'%');
                            }

                            if (!empty(Request::get('start_date'))) {
                                $return = $return->WHERE('inspect_date','>=', Request::get('start_date'));
                            }

                            if (!empty(Request::get('end_date'))) {
                                $return = $return->WHERE('inspect_date','<=', Request::get('end_date'));
                            }

                            if (!empty(Request::get('treatment_status'))) {
                                $return = $return->WHERE('treatment_status','=', Request::get('treatment_status'));
                            }

                            if (!empty(Request::get('treat_start_date'))) {
                                $return = $return->WHERE('treat_date','>=', Request::get('treat_start_date'));
                            }

                            if (!empty(Request::get('treat_end_date'))) {
                                $return = $return->WHERE('treat_date','<=', Request::get('treat_end_date'));
                            }
        
        $return = $return->ORDERBY('inspect_date', 'desc')
                            ->paginate(10);

        return $return;

    }

    

    static public function getPendingTreatCount(){

        $return = self::SELECT('treatments.*')
                        ->WHERE('treatment_status','=', 'Pending');

        $return = $return->count();

        return $return;

    }


}
