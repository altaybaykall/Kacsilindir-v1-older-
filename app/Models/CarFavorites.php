<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarFavorites extends Model
{
    use HasFactory;
    protected  $table='car_favorites';

    protected $fillable=['user_id','model_id'];

    public function favoritecar(){
        return $this->belongsTo(Cars::class,'model_id','model_id');
    }


}
