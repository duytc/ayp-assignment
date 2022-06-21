<?php

namespace App\Services;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Collection;

class WorkerService
{
    /**
     * @param array $worker
     * @return mixed
     */
    public function store(array $worker)
    {
        return Worker::create($worker);
    }

    /**
     * @param $emailAddress
     * @return mixed
     */
    public function findWorkerByEmail($emailAddress)
    {
        return Worker::where('email', $emailAddress)->first();
    }

    /**
     * @return Collection
     */
    public function getAllWorker()
    {
        return Worker::with('employments')->get();
    }

}
