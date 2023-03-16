<?php

namespace App\Modules\Course\Application\DTO;

class CourseUpdateDTO
{
    public string $title;

    private function __construct()
    {
    }

    public static function fromRequestData(array $requestData): self
    {
        $self = new self;

        $self->title = $requestData['title'];

        return $self;
    }
}
