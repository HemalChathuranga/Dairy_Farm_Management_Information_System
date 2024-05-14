<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PregnancyModel extends Model
{
    use HasFactory;

    protected $table = 'pregnancies';

    protected $fillable = [
        'animal_id',
        'preg_date',
        'pregnancy_occ',
        'estimated_delivery_date',
        'actual_delivery_date',
        'pregnancy_status',
        'created_by',
        'updated_by',
    ];
    

    static public function getRecByID($id){

        return self::findOrFail($id);
    }

    static public function getDueRec(){

        $return = self::SELECT('pregnancies.*');
               
        $return = $return->WHERE('pregnancy_status','=', 'Pregnant');

                            //Search Filters applied on Milkings Table
                            if (!empty(Request::get('animal_id'))) {
                                $return = $return->WHERE('animal_id','LIKE', '%'.Request::get('animal_id').'%');
                            }

                            if (!empty(Request::get('start_date'))) {
                                $return = $return->WHERE('estimated_delivery_date','>=', Request::get('start_date'));
                            }

                            if (!empty(Request::get('end_date'))) {
                                $return = $return->WHERE('estimated_delivery_date','<=', Request::get('end_date'));
                            }
        
        $return = $return->ORDERBY('estimated_delivery_date', 'asc')
                            ->paginate(10);

        return $return;

    }


    static public function getAllPregnancyRec() {

        $return = self::SELECT('pregnancies.*');

                            //Search Filters applied on Milkings Table
                            if (!empty(Request::get('animal_id'))) {
                                $return = $return->WHERE('animal_id','LIKE', '%'.Request::get('animal_id').'%');
                            }

                            if (!empty(Request::get('start_date'))) {
                                $return = $return->WHERE('preg_date','>=', Request::get('start_date'));
                            }

                            if (!empty(Request::get('end_date'))) {
                                $return = $return->WHERE('preg_date','<=', Request::get('end_date'));
                            }

                            if (!empty(Request::get('pregnant_status'))) {
                                $return = $return->WHERE('pregnancy_status','=', Request::get('pregnant_status'));
                            }

                            if (!empty(Request::get('del_start_date'))) {
                                $return = $return->WHERE('actual_delivery_date','>=', Request::get('del_start_date'));
                            }

                            if (!empty(Request::get('del_end_date'))) {
                                $return = $return->WHERE('actual_delivery_date','<=', Request::get('del_end_date'));
                            }
        
        $return = $return->ORDERBY('preg_date', 'desc')
                            ->paginate(10);

        return $return;

    }

    
    static public function getDelDueCount($firstDayofWeek, $lastDayofWeek){

        $return = self::SELECT('pregnancies.*')
                        ->WHERE('pregnancy_status','=', 'Pregnant')
                        ->WHERE('estimated_delivery_date','>=', $firstDayofWeek)
                        ->WHERE('estimated_delivery_date','<=', $lastDayofWeek);

        $return = $return->count();

        return $return;
    }

}
