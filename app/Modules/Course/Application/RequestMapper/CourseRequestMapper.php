<?php

namespace App\Modules\Course\Application\RequestMapper;

use App\Contracts\InvalidRequestException;
use App\Modules\Course\Application\DTO\CourseCreationDTO;
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

        return CourseCreationDTO::fromRequestData($request);
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
