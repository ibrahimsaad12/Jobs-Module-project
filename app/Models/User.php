<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo',
        'bio',
        'location',
        'resume',
        'companyname',
        'companywebsite',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    // public function jobs(){
    //     return $this->hasMany(Job::class);
    // }
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_user'); // Specify the pivot table name
    }
    public function applications(){
        return $this->hasMany(Application::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function skills(){
        return $this->belongsToMany(Skill::class);

    }

}
