<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'experience', 'salary', 'location', 
        'extra_info', 'company_name', 'company_logo', 'skills'
    ];

    protected $casts = [
        'skills' => 'array', // Make sure skills is cast to an array
    ];

    public function getSkillsNamesAttribute()
    {
        // Get the skill names based on the skill IDs stored in the skills column
        return Skill::whereIn('id', $this->skills)->pluck('name')->toArray();
    }
}


