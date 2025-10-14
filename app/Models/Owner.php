<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Owner extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['name', 'car_id'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
