<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $table = 'employments';

    protected $fillable = [
        'worker_id',
        'company_name',
        'job_title',
        'start_date',
        'end_date'
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

}
