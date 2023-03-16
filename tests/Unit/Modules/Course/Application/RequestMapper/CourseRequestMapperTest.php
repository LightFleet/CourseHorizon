<?php

namespace Tests\Unit\Modules\Course\Application\RequestMapper;

use App\Modules\Course\Application\Exception\TitleIsRequiredAndShouldBeStringException;
use App\Modules\Course\Application\RequestMapper\CourseRequestMapper;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CourseRequestMapperTest extends TestCase
{
    /**
     * @test
     * @dataProvider courseCreationDataProvider
     */
    public function courseCreation(
        Request $request,
        ?string $expectedDtoTitle,
        ?\Exception $expectedException
    )
    {
        if ($expectedException) {
            self::expectException($expectedException::class);
        }

        $mapper = new CourseRequestMapper();

        self::assertEquals($mapper->courseCreation($request)->title, $expectedDtoTitle);
    }

    private function fakeWorkingRequest(): Request
    {
        return new class extends Request {
            public function only($keys)
            {
                return ['title' => 'Title'];
            }
            public function validate()
            {
                return true;
            }
        };
    }

    public function courseCreationDataProvider(): iterable
    {
        yield 'Course creation error' => [
            'request' => $this->createMock(Request::class),
            'expectedDtoTitle' => null,
            'expectedException' => new TitleIsRequiredAndShouldBeStringException()
        ];

        yield 'Course creation success' => [
            'request' => $this->fakeWorkingRequest(),
            'expectedDtoTitle' => 'Title',
            'expectedException' => null
        ];
    }

    /**
     * @test
     * @dataProvider courseUpdateDataProvider
     */
    public function courseUpdate(
        Request $request,
        ?string $expectedDtoTitle,
        ?\Exception $expectedException
    )
    {
        if ($expectedException) {
            self::expectException($expectedException::class);
        }

        $mapper = new CourseRequestMapper();

        self::assertEquals($mapper->courseUpdate($request)->title, $expectedDtoTitle);
    }

    public function courseUpdateDataProvider(): iterable
    {
        yield 'Course update error' => [
            'request' => $this->createMock(Request::class),
            'expectedDtoTitle' => null,
            'expectedException' => new TitleIsRequiredAndShouldBeStringException()
        ];

        yield 'Course update success' => [
            'request' => $this->fakeWorkingRequest(),
            'expectedDtoTitle' => 'Title',
            'expectedException' => null
        ];
    }
}
