<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class contact extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['address', 'phone_number', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
