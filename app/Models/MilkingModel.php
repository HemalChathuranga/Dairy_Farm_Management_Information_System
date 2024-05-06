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
}
