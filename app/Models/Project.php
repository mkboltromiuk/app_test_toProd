<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'key'];

    protected static function boot()
    {
        parent::boot();

        // Automatyczne generowanie klucza API przy tworzeniu nowego projektu
        static::creating(function ($project) {
            $project->key = Str::random(32);
        });
    }
}
