<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'from_user_id',
        'to_user_id', 
        'message',
        'isAdmin',
        'seen'
    ];

    protected $casts = [
        'seen' => 'boolean',
        'isAdmin' => 'boolean'
    ];

    /**
     * Get the user that sent the message
     */
    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Get the user that receives the message
     */
    public function to_user()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
