<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Rule\EndDateMustBeAfterStartDate;
use App\Rule\WorkerMustBeUnemployed;
use App\Services\EmploymentService;
use App\Services\WorkerService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmploymentController extends Controller
{

    private EmploymentService $employmentService;
    private WorkerService $workerService;

    public function __construct(EmploymentService $employmentService, WorkerService $workerService)
    {
        $this->employmentService = $employmentService;
        $this->workerService = $workerService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function ajaxStore(Request $request)
    {
        $this->validate($request, [
            'email'        => ['required', 'max:255', 'email', 'exists:workers', new WorkerMustBeUnemployed($this->workerService)],
            'company_name' => ['required', 'max:255'],
            'job_title'    => ['required'],
            'start_date'   => ['required', 'date_format:Y-m-d']
        ]);

        $emailAddress = $request->input('email');
        $employmentInfo = $request->except('email');

        return JsonResponse::success(
            ['id' => $this->employmentService->createEmploymentByEmail($emailAddress, $employmentInfo)->id]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function ajaxUpdate(Request $request)
    {
        $this->validate($request, [
            'id'       => ['required', 'exists:employments'],
            'end_date' => ['date_format:Y-m-d', new EndDateMustBeAfterStartDate($this->employmentService, $request->input('id'))]
        ]);

        $employmentId = $request->input('id');
        $employmentData = $request->except('id');

        return JsonResponse::success(
            ['id' => $this->employmentService->updateEmployment($employmentId, $employmentData)->id]
        );
    }


}
