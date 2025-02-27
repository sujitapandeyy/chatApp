<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'receiver_id', 'message'];

    // Relationship: Sender
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: Receiver
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
