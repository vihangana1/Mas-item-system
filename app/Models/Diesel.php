<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diesel extends Model
{
    use HasFactory;

    protected $fillable = [
        'diesel_fill_date',
        'main_storage_tank_level',
        'main_storage_tank_liters',

        'boiler_day_tank_level',
        'boiler_day_tank_liters',
        'generator_1_liters',
        'generator_2_liters',
        'generator_3_liters',
        'deisel_total_liters',
        'admin_username',
        'admin_password',
    ];

    protected $casts = [
        'main_storage_tank_level' => 'integer',
        'main_storage_tank_liters' => 'integer',
        'boiler_day_tank_level' => 'integer',
        'boiler_day_tank_liters' => 'integer',
        'generator_1_liters' => 'integer',
        'generator_2_liters' => 'integer',
        'generator_3_liters' => 'integer',
        'deisel_total_liters' => 'integer',
    ];
}
