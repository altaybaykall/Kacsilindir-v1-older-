<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class News extends Model
{
    use Searchable;
    use HasFactory;


    protected $table="news";
    protected  $fillable=['content','title','author_id','brand','image','reads'];


  public function ToSearchableArray() {
      return [
          'title'=> $this->title,
          'content'=>$this->content
      ];
  }

    public function comments() {
        return $this->hasMany(NewsComments::class,'news_id','id');
    }

    protected function  image(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? '/storage/news/' . $value : '/images/600.jpg';


        });
   }

    public function getauthor() {
        return $this->belongsTo(User::class,'author_id','id');
    }
    public function getCommentCountAttribute()
    {
        return $this->GetComments()->count();
    }


}



