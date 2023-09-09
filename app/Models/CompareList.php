<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompareList extends Model
{
    use HasFactory;

    protected  $table='compare_list';

    protected $fillable=['user_id','model_id'];


    public function compareby() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function carcompare(){
        return $this->belongsTo(Cars::class,'model_id','model_id');
    }

}
