<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'photo_path', 'is_profile_picture', 'is_approved', 'privacy', 'order'
    ];

    protected $casts = [
        'is_profile_picture' => 'boolean',
        'is_approved' => 'boolean',
        'order' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
