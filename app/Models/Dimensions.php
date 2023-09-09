<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimensions extends Model
{
    use HasFactory;
    protected $table ="dimensions";
    public $timestamps = false;
    public $primaryKey = 'dimension_id';
    protected $fillable=[
        'width',
        'height',
        'lenght',
        'weight',
        'body_type',
        'door_num',
        'seat_num',
        'trunk_cap'];
    public function getCarDimension(){
        return $this->belongsTo(Cars::class,'model_id','id');
    }




}
