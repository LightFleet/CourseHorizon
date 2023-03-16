<?php

namespace App\Modules\Enrollment\Application\DTO;

class EnrollmentUpdateDTO
{
    public int $status;

    private function __construct()
    {
    }

    public static function fromRequestData(array $requestData): self
    {
        $self = new self;

        $self->status = $requestData['status'];

        return $self;
    }
}
