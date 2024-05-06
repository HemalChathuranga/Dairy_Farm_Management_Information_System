<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkingTempModel extends Model
{
    use HasFactory;

    protected $table = 'milking_queue_temp';

    protected $fillable = [
        'animal_id',
        'milking_date',
        'time',
    ];

    static public function getRecByID($id){

        return self::findOrFail($id);
    }

}
