<?php

namespace Tests\Unit\Modules\Course\Application\Service;

use App\Modules\Course\Application\Assembler\CourseCreationAssembler;
use App\Modules\Course\Application\DTO\CourseCreationDTO;
use App\Modules\Course\Application\Exception\TitleIsRequiredAndShouldBeStringException;
use App\Modules\Course\Application\RequestMapper\CourseRequestMapper;
use App\Modules\Course\Application\Service\CourseCreator;
use App\Modules\Course\Domain\Entity\Course;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CourseCreatorTest extends TestCase
{
    private CourseCreator $creator;
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
        $this->assembler = $this->createMock(CourseCreationAssembler::class);

        $this->creator = new CourseCreator($this->mapper, $this->assembler);
    }

    /**
     * @test
     * @dataProvider createCourseDataProvider
     */
    public function createCourse(
        Request $request,
        callable $configureMocks,
        ?\Exception $expectedException
    )
    {
        $configureMocks($this->mapper, $this->assembler);

        if ($expectedException) {
            self::expectException($expectedException::class);
        }

        $this->creator->createCourse($request);
    }

    public function createCourseDataProvider(): iterable
    {
        yield 'Course created and saved' => [
            'request' => $this->createMock(Request::class),
            'configureMocks' => function (CourseRequestMapper $mapper,
                                          CourseCreationAssembler $assembler) {
                $mapper
                    ->expects(self::once())
                    ->method('courseCreation')
                    ->willReturn($this->createMock(CourseCreationDTO::class));

                $saveableCourse = $this->createMock(Course::class);
                $saveableCourse->method('save')->willReturn(true);

                $assembler
                    ->expects(self::once())
                    ->method('fromDTO')
                    ->willReturn($saveableCourse);
            },
            'expectedException' => null
        ];

        yield 'Course created but not saved' => [
            'request' => $this->createMock(Request::class),
            'configureMocks' => function (CourseRequestMapper $mapper,
                                          CourseCreationAssembler $assembler) {
                $mapper
                    ->expects(self::once())
                    ->method('courseCreation')
                    ->willReturn($this->createMock(CourseCreationDTO::class));

                $assembler
                    ->expects(self::once())
                    ->method('fromDTO')
                    ->willReturn($this->createMock(Course::class));
            },
            'expectedException' => new ModelSaveFailedException()
        ];
    }
}
