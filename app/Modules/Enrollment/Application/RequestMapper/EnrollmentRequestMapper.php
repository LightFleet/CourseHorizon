<?php

namespace App\Modules\Enrollment\Application\RequestMapper;

use App\Contracts\InvalidRequestException;
use App\Modules\Course\Application\Exception\TitleIsRequiredAndShouldBeStringException;
use App\Modules\Enrollment\Application\DTO\EnrollmentCreationDTO;
use App\Modules\Enrollment\Application\DTO\EnrollmentUpdateDTO;
use Illuminate\Http\Request;

class EnrollmentRequestMapper
{
    /**
     * @throws InvalidRequestException
     */
    public function enrollmentCreation(Request $request): EnrollmentCreationDTO
    {
        $this->validateCreationRequest($request);

        $requestData = $request->only(['course_id', 'student_id']);

        return EnrollmentCreationDTO::fromRequestData($requestData);
    }

    /**
     * @throws InvalidRequestException
     */
    public function enrollmentUpdate(Request $request): EnrollmentUpdateDTO
    {
        $this->validateUpdateRequest($request);

        $requestData = $request->only(['status']);

        return EnrollmentUpdateDTO::fromRequestData($requestData);
    }

    private function validateCreationRequest(Request $request): void
    {
        if (!$request->validate([
            'student_id' => 'required|integer'
        ])) {
            throw new \RuntimeException('student_id is required and should be int.');
        }
        if (!$request->validate([
            'course_id' => 'required|integer'
        ])) {
            throw new \RuntimeException('course_id is required and should be int.');
        }
    }

    private function validateUpdateRequest(Request $request): void
    {
        if (!$request->validate([
            'status' => 'required|integer'
        ])) {
            throw new \RuntimeException('status is required and should be int.');
        }
    }
}
