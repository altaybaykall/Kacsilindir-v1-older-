<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsComments extends Model
{
    use HasFactory;

    protected $table="news_comments";
    protected  $primaryKey="comment_id";
    protected $fillable=['comment','user_id','news_id'];

    public function commentto() {
        return $this->belongsTo(News::class,'news_id','id');
    }

    public function commentby() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
