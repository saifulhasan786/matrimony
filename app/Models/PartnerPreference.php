<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'age_from', 'age_to', 'height_from', 'height_to',
        'marital_status', 'religion', 'caste', 'mother_tongue', 'country',
        'state', 'city', 'education', 'occupation', 'annual_income_from',
        'annual_income_to', 'body_type', 'complexion', 'diet', 'smoking',
        'drinking', 'description'
    ];

    protected $casts = [
        'age_from' => 'integer',
        'age_to' => 'integer',
        'height_from' => 'integer',
        'height_to' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
