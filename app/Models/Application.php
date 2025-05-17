<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    protected $fillable = [
        'job_id',
        'user_id',
        'cover_letter',
        'resume',
        'status',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
