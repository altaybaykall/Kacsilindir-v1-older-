<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRating extends Model
{
    use HasFactory;

    protected  $table = 'vehiclerating';

   public  function cars() {
    return  $this->belongsto(Cars::class);
}

}
