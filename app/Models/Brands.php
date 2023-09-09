<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $table ="brands";
    protected $appends = ['logoraw'];
    public $fillable= ['id','brand','logo','content'];

    public function getLogoRawAttribute()
    {
        return $this->attributes['logo'];
    }


    protected function  logo(): Attribute {
        return  Attribute::make(get: function ($value) {
            return $value ? '/storage/brandlogos/' .$value : '/images/600.jpg';


        });
    }
    public function cars()
    {
        return $this->hasMany(Cars::class, 'brand_name', 'brand');
    }

    public function getCarCountAttribute()
    {
        return $this->GetCars()->count();
    }

}
