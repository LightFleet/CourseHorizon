<?php

namespace Tests\Unit\Modules\Enrollment\Application\DataTransformer;

use App\Modules\Course\Application\Assembler\CourseCreationAssembler;
use App\Modules\Course\Application\DTO\CourseCreationDTO;
use App\Modules\Course\Application\Exception\TitleIsRequiredAndShouldBeStringException;
use App\Modules\Course\Application\RequestMapper\CourseRequestMapper;
use App\Modules\Course\Application\Service\CourseCreator;
use App\Modules\Course\Domain\Entity\Course;
use App\Modules\Enrollment\Application\DataTransformer\EnrollmentsDataTransformer;
use App\Modules\Enrollment\Domain\Entity\Enrollment;
use App\Modules\Student\Domain\Entity\Student;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class EnrollmentsDataTransformerTest extends TestCase
{
    /**
     * @test
     * @dataProvider transformDataProvider
     */
    public function transform(
        Paginator $enrollments,
        array $expectedTransformedArray
    )
    {
        $dataTransformer = new EnrollmentsDataTransformer();

        self::assertEquals($dataTransformer->transform($enrollments), $expectedTransformedArray);
    }

    public function transformDataProvider(): iterable
    {
        $date = new \DateTimeImmutable();

        $enrollments = $this->createMock(Paginator::class);
        $enrollments->method('items')->willReturn($this->craftEnrollmentsItems($date));

        yield 'Successful transformation' => [
            'enrollments' => $enrollments,
            'expectedTransformedArray' => [
                [
                    'id' => 1,
                    'status' => 'Completed',
                    'created_at' => $date->format('Y-m-d H:i:s'),
                    'completed_at' => $date->format('Y-m-d H:i:s'),
                    'course_title' => 'vuejs',
                    'student_name' => 'Alisa'
                ],
                [
                    'id' => 1,
                    'status' => 'Completed',
                    'created_at' => $date->format('Y-m-d H:i:s'),
                    'completed_at' => $date->format('Y-m-d H:i:s'),
                    'course_title' => 'vuejs',
                    'student_name' => 'Alisa'
                ]
            ]
        ];
    }

    private function craftEnrollmentsItems(\DateTimeImmutable $date): array
    {
        $enrollment = new class ($date) extends Enrollment {
            public function __construct(private \DateTimeImmutable $date, array $attributes = [])
            {
                parent::__construct($attributes);
            }

            public function getCreatedAt(): \DateTimeImmutable
            {
                return $this->date;
            }

            public function getUpdatedAt(): \DateTimeImmutable
            {
                return $this->date;
            }
        };

        $enrollment->id = 1;
        $enrollment->status = 1;
        $enrollment->course = new Course();
        $enrollment->student = new Student();

        $enrollment->course->title = 'vuejs';
        $enrollment->student->name = 'Alisa';

        return [clone $enrollment, clone $enrollment];
    }
}
