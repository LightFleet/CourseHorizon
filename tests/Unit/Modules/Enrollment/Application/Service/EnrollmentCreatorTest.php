<?php

namespace Tests\Unit\Modules\Enrollment\Application\Service;

use App\Modules\Enrollment\Application\Assembler\EnrollmentCreationAssembler;
use App\Modules\Enrollment\Application\DTO\EnrollmentCreationDTO;
use App\Modules\Enrollment\Application\RequestMapper\EnrollmentRequestMapper;
use App\Modules\Enrollment\Application\Service\EnrollmentCreator;
use App\Modules\Enrollment\Domain\Entity\Enrollment;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class EnrollmentCreatorTest extends TestCase
{
    private EnrollmentCreator $creator;
    private mixed $mapper;
    private mixed $assembler;

    protected function setUp(): void
    {
        $this->mapper = $this->createMock(EnrollmentRequestMapper::class);
        $this->assembler = $this->createMock(EnrollmentCreationAssembler::class);

        $this->creator = new EnrollmentCreator($this->mapper, $this->assembler);
    }

    /**
     * @test
     * @dataProvider createEnrollmentDataProvider
     */
    public function createEnrollment(
        Request $request,
        callable $configureMocks,
        ?\Exception $expectedException
    )
    {
        $configureMocks($this->mapper, $this->assembler);

        if ($expectedException) {
            self::expectException($expectedException::class);
        }

        $this->creator->createEnrollment($request);
    }

    public function createEnrollmentDataProvider(): iterable
    {
        yield 'Enrollment created and saved' => [
            'request' => $this->createMock(Request::class),
            'configureMocks' => function (EnrollmentRequestMapper $mapper,
                                          EnrollmentCreationAssembler $assembler) {
                $mapper
                    ->expects(self::once())
                    ->method('enrollmentCreation')
                    ->willReturn($this->createMock(EnrollmentCreationDTO::class));

                $saveableEnrollment = $this->createMock(Enrollment::class);
                $saveableEnrollment->method('save')->willReturn(true);

                $assembler
                    ->expects(self::once())
                    ->method('fromDTO')
                    ->willReturn($saveableEnrollment);
            },
            'expectedException' => null
        ];

        yield 'Enrollment created but not saved' => [
            'request' => $this->createMock(Request::class),
            'configureMocks' => function (EnrollmentRequestMapper $mapper,
                                          EnrollmentCreationAssembler $assembler) {
                $mapper
                    ->expects(self::once())
                    ->method('enrollmentCreation')
                    ->willReturn($this->createMock(EnrollmentCreationDTO::class));

                $assembler
                    ->expects(self::once())
                    ->method('fromDTO')
                    ->willReturn($this->createMock(Enrollment::class));
            },
            'expectedException' => new ModelSaveFailedException()
        ];
    }
}
