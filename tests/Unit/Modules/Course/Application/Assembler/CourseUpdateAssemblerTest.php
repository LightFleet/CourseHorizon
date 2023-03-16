<?php

namespace Tests\Unit\Modules\Course\Application\Assembler;

use App\Modules\Course\Application\Assembler\CourseUpdateAssembler;
use App\Modules\Course\Application\DTO\CourseUpdateDTO;
use App\Modules\Course\Domain\Entity\Course;
use PHPUnit\Framework\TestCase;

class CourseUpdateAssemblerTest extends TestCase
{
    public function testToEntity()
    {
        $assembler = new CourseUpdateAssembler();
        $title = 'Title';

        $dto = CourseUpdateDTO::fromRequestData(['title' => $title]);

        self::assertSame(
            $assembler->toEntity($dto, new Course())->getTitle(),
            $title
        );
    }
}
