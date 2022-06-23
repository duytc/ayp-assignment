<?php

namespace App\Http\Controllers;

use App\Helpers\JsonResponse;
use App\Services\WorkerService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WorkerController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function ajaxStore(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|unique:workers'
        ]);

        return JsonResponse::success(['id' => $this->workerService->store($request->all())->id]);
    }

    public function ajaxList(Request $request)
    {
        return JsonResponse::success(['workers' => $this->workerService->getAllWorker()]);
    }
}
