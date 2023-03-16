<?php

namespace Tests\Unit\Modules\Course\Application\Service;

use App\Modules\Course\Application\Assembler\CourseCreationAssembler;
use App\Modules\Course\Application\Assembler\CourseUpdateAssembler;
use App\Modules\Course\Application\DTO\CourseUpdateDTO;
use App\Modules\Course\Application\RequestMapper\CourseRequestMapper;
use App\Modules\Course\Application\Service\CourseUpdater;
use App\Modules\Course\Domain\Entity\Course;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CourseUpdaterTest extends TestCase
{
    private CourseUpdater $updater;
    /**
     * @var CourseRequestMapper|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    private mixed $mapper;
    /**
     * @var CourseCreationAssembler|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    private mixed $assembler;

    protected function setUp(): void
    {
        $this->mapper = $this->createMock(CourseRequestMapper::class);
        $this->assembler = $this->createMock(CourseUpdateAssembler::class);

        $this->updater = new CourseUpdater($this->mapper, $this->assembler);
    }

    /**
     * @test
     * @dataProvider updateCourseDataProvider
     */
    public function updateCourse(
        Request $request,
        callable $configureMocks,
        ?\Exception $expectedException
    )
    {
        $configureMocks($this->mapper, $this->assembler);

        if ($expectedException) {
            self::expectException($expectedException::class);
        }

        $this->updater->updateCourse($request, $this->createMock(Course::class));
    }

    public function updateCourseDataProvider(): iterable
    {
        yield 'Course updated and saved' => [
            'request' => $this->createMock(Request::class),
            'configureMocks' => function (CourseRequestMapper $mapper,
                                          CourseUpdateAssembler $assembler) {
                $mapper
                    ->expects(self::once())
                    ->method('courseUpdate')
                    ->willReturn($this->createMock(CourseUpdateDTO::class));

                $saveableCourse = $this->createMock(Course::class);
                $saveableCourse->method('save')->willReturn(true);

                $assembler
                    ->expects(self::once())
                    ->method('toEntity')
                    ->willReturn($saveableCourse);
            },
            'expectedException' => null
        ];

        yield 'Course created but not saved' => [
            'request' => $this->createMock(Request::class),
            'configureMocks' => function (CourseRequestMapper $mapper,
                                          CourseUpdateAssembler $assembler) {
                $mapper
                    ->expects(self::once())
                    ->method('courseUpdate')
                    ->willReturn($this->createMock(CourseUpdateDTO::class));

                $assembler
                    ->expects(self::once())
                    ->method('toEntity')
                    ->willReturn($this->createMock(Course::class));
            },
            'expectedException' => new ModelSaveFailedException()
        ];
    }
}
