<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    /**
     * filable array to avoid mass assignment
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'user_id',
    ];
    /**
     * realtional function between project and tasks
     *
     * @return void
     */
    public function tasks()
    {
        return $this->hasMany(task::class);
    }
    /**
     * realtional function between project and user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
