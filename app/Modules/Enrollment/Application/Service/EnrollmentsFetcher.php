<?php

namespace App\Modules\Enrollment\Application\Service;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EnrollmentsFetcher
{
    public function modifyQuery(Builder $query, Request $request): Builder
    {
        $this->applySorting($query, $request);
        $this->applyFilters($query, $request);

        return $query;
    }

    private function applySorting(Builder $query, Request $request): void
    {
        if ($request->has('sort_by') && $request->get('sort_by') !== null) {
            $sortField = $request->get('sort_by');

            if ($sortField === 'alphabetical') {
                $this->applyAlphabeticalOrdering($query);
                return;
            }

            $sortField = $request->get('sort_by');
            $query->orderBy($sortField);
        }
    }

    private function applyAlphabeticalOrdering(Builder $query): void
    {
        $query->select('enrollments.*')
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->orderBy('courses.title')
            ->orderBy('students.name');
    }

    private function applyFilters(Builder $query, Request $request)
    {
        if ($request->has('courseTitle') && $request->get('courseTitle') !== null) {
            $titleSearch = $request->get('courseTitle');
            $query->whereHas('course', function ($q) use ($titleSearch) {
                $q->where('title', 'LIKE', '%' . $titleSearch . '%');
            });
        }

        if ($request->has('studentName') && $request->get('studentName') !== null) {
            $studentSearch = $request->get('studentName');
            $query->whereHas('student', function ($q) use ($studentSearch) {
                $q->where('name', 'LIKE', '%' . $studentSearch . '%');
            });
        }

        if ($request->has('status') && $request->get('status') !== null) {
            $query->where('status', (int)$request->get('status'));
        }
    }
}
