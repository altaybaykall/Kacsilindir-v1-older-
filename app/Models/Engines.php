<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engines extends Model
{
    use HasFactory;

protected $table ="engines";

    public $timestamps = false;
    public $primaryKey = 'engine_id';
    protected $fillable=['engine_id',
        'engine_size',
        'cylinders',
        'transmission',
        'horse_power',
        'torque',
        'hundred_sec',
        'fuel_type',
        'drivetrain','top_speed'];
 public function getCarEngine(){
     return $this->hasOne(Cars::class,'model_id','engine_id');
 }
}

