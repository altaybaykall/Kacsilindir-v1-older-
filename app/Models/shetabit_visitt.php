<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class shetabit_visitt extends Model
{
    use HasFactory;
    protected $table="shetabit_visits";


    public function scopeExpired(Builder $query)
    {
        return $query->where(DB::raw('created_at + INTERVAL 1 DAY'), '<', Carbon::now());
    }
}
