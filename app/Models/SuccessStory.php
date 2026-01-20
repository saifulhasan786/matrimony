<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'groom_id', 'bride_id', 'title', 'story', 'wedding_photo',
        'wedding_date', 'is_approved', 'is_featured'
    ];

    protected $casts = [
        'wedding_date' => 'date',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function groom()
    {
        return $this->belongsTo(User::class, 'groom_id');
    }

    public function bride()
    {
        return $this->belongsTo(User::class, 'bride_id');
    }
}
