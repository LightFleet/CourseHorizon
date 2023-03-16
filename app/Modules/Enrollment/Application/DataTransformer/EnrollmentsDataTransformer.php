<?php

namespace App\Modules\Enrollment\Application\DataTransformer;

use App\Modules\Enrollment\Domain\Entity\Enrollment;
use Illuminate\Contracts\Pagination\Paginator;

class EnrollmentsDataTransformer
{
    public function transform(Paginator $enrollments): array
    {
        $data = [];

        foreach ($enrollments->items() as $enrollment) {
            /** @var Enrollment $enrollment */
            $data[] = [
                'id' => $enrollment->getId(),
                'status' => $enrollment->getStatus()->getLabel(),
                'created_at' => $enrollment->getCreatedAt()->format('Y-m-d H:i:s'),
                'completed_at' => $enrollment->isCompleted() ? $enrollment->getUpdatedAt()->format('Y-m-d H:i:s') : '-',
                'course_title' => $enrollment->course->title,
                'student_name' => $enrollment->student->name
            ];
        }

        return $data;
    }
}
