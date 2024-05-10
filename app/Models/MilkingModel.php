<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    static public function getTodayMilkingRec($animal_id, $todayDate){

        $return = self::WHERE('animal_id', $animal_id)
                        ->WHERE('milking_date','=', $todayDate)
                        ->first();

        return $return;
    }
}
