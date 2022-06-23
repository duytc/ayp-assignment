<?php

namespace App\Rule;

use App\Services\WorkerService;
use Illuminate\Contracts\Validation\Rule;

class WorkerMustBeUnemployed implements Rule
{
    private WorkerService $workerService;

    /**
     * @param WorkerService $workerService
     */
    public function __construct(WorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $worker = $this->workerService->findWorkerByEmail($value);

        return is_null($worker?->employments?->last()) || !is_null($worker?->employments?->last()['end_date']);
    }

    /**
     * @return string
     */
    public function message()
    {
        return __('Worker must be unemployed');
    }
}
