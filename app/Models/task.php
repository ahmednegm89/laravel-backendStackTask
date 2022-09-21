<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
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
        'project_id',
        'user_id',
    ];

    /**
     * realtional function between task and user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * realtional function between task and project
     *
     * @return void
     */
    public function project()
    {
        return $this->belongsTo(project::class);
    }
}
