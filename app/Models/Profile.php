<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'profile_for', 'height', 'weight', 'marital_status', 'children',
        'body_type', 'complexion', 'physical_status', 'mother_tongue', 'religion',
        'caste', 'sub_caste', 'gothra', 'education', 'education_detail', 'occupation',
        'occupation_detail', 'annual_income', 'country', 'state', 'city', 'address',
        'father_name', 'father_occupation', 'mother_name', 'mother_occupation',
        'brothers', 'sisters', 'family_type', 'family_status', 'family_values',
        'about_me', 'about_family', 'hobbies', 'interests', 'profile_picture',
        'profile_verified', 'profile_status'
    ];

    protected $casts = [
        'profile_verified' => 'boolean',
        'height' => 'integer',
        'weight' => 'integer',
        'children' => 'integer',
        'brothers' => 'integer',
        'sisters' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
