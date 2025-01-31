<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the many-to-many relationship
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}


