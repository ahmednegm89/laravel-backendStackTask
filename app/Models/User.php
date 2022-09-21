<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * filable array to avoid mass assignment
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'access_token'
    ];

    /**
     * protected array to avoid protect password data
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * realtional function between user and projects
     *
     * @return void
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    /**
     * realtional function between user and tasks
     *
     * @return void
     */
    public function tasks()
    {
        return $this->hasMany(task::class);
    }
}
