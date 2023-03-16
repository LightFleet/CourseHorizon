<?php

namespace App\Modules\Course\Application\RequestMapper;

use App\Contracts\InvalidRequestException;
use App\Modules\Course\Application\DTO\CourseCreationDTO;
use App\Modules\Course\Application\DTO\CourseUpdateDTO;
use App\Modules\Course\Application\Exception\TitleIsRequiredAndShouldBeStringException;
use Illuminate\Http\Request;

class CourseRequestMapper
{
    /**
     * @throws InvalidRequestException
     */
    public function courseCreation(Request $request): CourseCreationDTO
    {
        $this->validateRequest($request);

        $requestData = $request->only(['title']);

        return CourseCreationDTO::fromRequestData($requestData);
    }

    /**
     * @throws InvalidRequestException
     */
    public function courseUpdate(Request $request): CourseUpdateDTO
    {
        $this->validateRequest($request);

        $requestData = $request->only(['title']);

        return CourseUpdateDTO::fromRequestData($requestData);
    }

    /**
     * @throws InvalidRequestException
     */
    private function validateRequest(Request $request): void
    {
        if (!$request->validate([
            'title' => 'required|string'
        ])) {
            throw new TitleIsRequiredAndShouldBeStringException('Title is required and should be string exception');
        }
    }
}
