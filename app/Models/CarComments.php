<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarComments extends Model
{
    use HasFactory;

    protected $table="cars_comments";

    protected $primaryKey="comment_id";

    protected $fillable=['user_id','comment','model_id'];

    public function GetCarComments(){
        return $this->belongsTo(Cars::class,'model_id','model_id');
    }

    public function commentvby() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
