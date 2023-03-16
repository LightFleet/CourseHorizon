<?php

namespace Tests\Unit\Modules\Course\Application\Assembler;

use App\Modules\Course\Application\Assembler\CourseCreationAssembler;
use App\Modules\Course\Application\DTO\CourseCreationDTO;
use PHPUnit\Framework\TestCase;

class CourseCreationAssemblerTest extends TestCase
{
    public function testFromDTO()
    {
        $assembler = new CourseCreationAssembler();
        $title = 'Title';

        $dto = CourseCreationDTO::fromRequestData(['title' => $title]);

        self::assertSame($assembler->fromDTO($dto)->getTitle(), $title);
    }
}
