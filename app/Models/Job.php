<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'salary_range',
        'job_type',
        'location',
        'status',
        'is_premium',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class );
    }
    // public function users()
    // {
    //     return $this->belongsTo(User::class );
    // }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
