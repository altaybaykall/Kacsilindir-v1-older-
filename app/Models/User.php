<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Shetabit\Visitor\Traits\Visitor;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Visitor;
    protected $table="users";

protected $guarded= 'type';
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'avatar',
        'status',


    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

protected function  avatar(): Attribute
{
    return Attribute::make(get: function ($value) {
        return $value ? '/storage/avatars/' . $value : '/images/profileiconblack.png';


    });
}


   /* protected function type(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["user", "admin", "manager"][$value],
        );
    }
*/
 public function GetNewsComments() {
     return $this->hasMany(NewsComments::class,'user_id','id');
 }

    public function GetSelfCarsComments() {
        return $this->hasMany(CarComments::class,'user_id','id');
    }




}
