<?php

namespace App\Modules\Course\Application\Service;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CourseFetcher
{
    public function modifyQuery(Builder $query, Request $request): Builder
    {
        $this->applySorting($query, $request);
        $this->applyFilters($query, $request);

        return $query;
    }

    private function applySorting(Builder $query, Request $request)
    {
        if ($request->has('sort_by')) {
            $sortField = $request->get('sort_by');
            $sortOrder = $request->get('sort_order', 'asc');
            $query->orderBy($sortField, $sortOrder);
        }
    }

    private function applyFilters(Builder $query, Request $request)
    {
        // Filtering by course title
        if ($request->has('course_title')) {
            $query->where('title', 'LIKE', '%' . $request->get('course_title') . '%');
        }

        // Filtering by user name or email
        if ($request->has('user_search')) {
            $userSearch = $request->get('user_search');
            $query->whereHas('users', function ($q) use ($userSearch) {
                $q->where('name', 'LIKE', '%' . $userSearch . '%')
                    ->orWhere('email', 'LIKE', '%' . $userSearch . '%');
            });
        }

        // Filtering by enrollment status
        if ($request->has('status')) {
            $query->whereHas('enrollments', function ($q) use ($request) {
                $q->where('status', $request->get('status'));
            });
        }

    }
}
