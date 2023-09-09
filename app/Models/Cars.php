<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shetabit\Visitor\Traits\Visitor;
class Cars extends Model
{
    use HasFactory,Visitor;
    protected $table="cars";

    public $primaryKey ="model_id";
    protected $fillable=['brand_name',
        'model_name',
        'production_year',
        'model_spec',
        'picture',
        'model_id'];

    protected function  picture(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? '/storage/carimages/' . $value : 'images/600.jpg';


        });
    }
    public function getModels(){
        return $this->belongsTo(Brands::class,'brand','brand_name');
    }
    public function getEngine(){
        return $this->hasOne(Engines::class,'engine_id','model_id');
    }
    public function getEconomy(){
        return $this->hasOne(Economy::class,'economy_id','model_id');
    }
    public function getDimension(){
        return $this->hasOne(Dimensions::class,'dimension_id','model_id');
    }
     public function getComments(){
         return $this->hasMany(CarComments::class,'model_id','model_id');
      }
     public function getbrand() {
        return $this->hasOne(Brands::class,'brand','brand_name');
     }

    public function rating() {
        return $this->hasMany(CarRating::class,'model_id','model_id');
    }


    public  function getRatingCalcAttribute() {
        $ratingQuery = $this->rating();
        $ratingSum = $ratingQuery->sum('rate');
        $ratingCount = $ratingQuery->count();

        return $ratingCount > 0 ? $ratingSum / $ratingCount : 0;
    }

}
