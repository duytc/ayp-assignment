<?php

namespace App\Rule;

use App\Services\EmploymentService;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class EndDateMustBeAfterStartDate implements Rule
{
    private EmploymentService $employmentService;
    private $employmentId;

    /**
     * @param EmploymentService $employmentService
     * @param $employmentId
     */
    public function __construct(EmploymentService $employmentService, $employmentId)
    {
        $this->employmentService = $employmentService;
        $this->employmentId = $employmentId;
    }

    /**
     * @param $attribute
     * @param $value
     * @return bool|void
     */
    public function passes($attribute, $value)
    {
        $startDate = $this->employmentService->findEmployment($this->employmentId)->start_date;

        return (Carbon::createFromFormat('Y-m-d', $value) > $startDate);
    }

    /**
     * @return string
     */
    public function message()
    {
        return __('End date must be after start date');
    }
}
