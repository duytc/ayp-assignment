<?php

namespace App\Services;

use App\Models\Employment;

class EmploymentService
{
    private WorkerService $workerService;

    public function __construct(WorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    /**
     * @param $workerEmail
     * @param array $employmentInfo
     * @return mixed
     */
    public function createEmploymentByEmail($workerEmail, array $employmentInfo)
    {
        $worker = $this->workerService->findWorkerByEmail($workerEmail);
        $employmentInfo['worker_id'] = $worker->id;

        return Employment::create($employmentInfo);
    }


    /**
     * @param $employmentId
     * @param $employmentData
     * @return mixed
     */
    public function updateEmployment($employmentId, $employmentData)
    {
        $employment = Employment::find($employmentId);

        $employment->company_name = $employmentData['company_name'] ?? $employment->company_name;
        $employment->job_title = $employmentData['job_title'] ?? $employment->job_title;
        $employment->start_date = $employmentData['start_date'] ?? $employment->start_date;
        $employment->end_date = $employmentData['end_date'] ?? $employment->end_date;

        $employment->save();

        return $employment;
    }

    public function findEmployment($employmentId)
    {
        return Employment::find($employmentId);
    }
}
