<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Economy extends Model
{
    use HasFactory;

    protected $table ="economy";
    public $timestamps = false;
    public $primaryKey = 'economy_id';
    protected $fillable=['economy_id',
        'fuel_cons_ic',
        'fuel_cons_oc',
        'fuel_cons_avg',
        'fuel_tank',
        'range',
        'emission'];
    public function getCarEconomy(){
        return $this->hasOne(Cars::class,'model_id','economy_id');
    }
    public  function getEconomyEngine() {
        return $this->hasOne(Engines::class,'engine_id','economy_id');
    }

}
