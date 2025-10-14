<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Machanic extends Model
{
    use HasFactory, Notifiable;
   public $fillable = ['name', 'phone'];

   public function carOwner()
   {
       return $this->hasManyThrough(Owner::class, Car::class);
   }
   public function cars(): HasMany
   {
       return $this->hasMany(Car::class);
   }
}
