<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $table = 'workers';

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    public function employments()
    {
        return $this->hasMany(Employment::class);
    }

}
