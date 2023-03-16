<?php

namespace Tests\Unit\Modules\Enrollment\Application\Service;

use App\Modules\Enrollment\Application\Service\EnrollmentsFetcher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class EnrollmentsFetcherTest extends TestCase
{
    /**
     * @test
     */
    public function modifyQuery()
    {
        $fetcher = new EnrollmentsFetcher();

        $request = $this->createMock(Request::class);
        $request->expects(self::atLeastOnce())->method('has');

        $fetcher->modifyQuery(
            $this->createMock(Builder::class),
            $request
        );
    }
}
