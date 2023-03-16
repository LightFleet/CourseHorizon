<?php

namespace Tests\Unit\Modules\Enrollment\Application\Service;

use App\Modules\Enrollment\Application\Assembler\EnrollmentUpdateAssembler;
use App\Modules\Enrollment\Application\DTO\EnrollmentUpdateDTO;
use App\Modules\Enrollment\Application\RequestMapper\EnrollmentRequestMapper;
use App\Modules\Enrollment\Application\Service\EnrollmentUpdater;
use App\Modules\Enrollment\Domain\Entity\Enrollment;
use App\SharedKernel\ModelSaveFailedException;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class EnrollmentUpdaterTest extends TestCase
{
    private EnrollmentUpdater $updater;
    /**
     * @var EnrollmentRequestMapper|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    private mixed $mapper;
    /**
     * @var EnrollmentUpdateAssembler|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    private mixed $assembler;

    protected function setUp(): void
    {
        $this->mapper = $this->createMock(EnrollmentRequestMapper::class);
        $this->assembler = $this->createMock(EnrollmentUpdateAssembler::class);

        $this->updater = new EnrollmentUpdater($this->mapper, $this->assembler);
    }

    /**
     * @test
     * @dataProvider updateEnrollmentDataProvider
     */
    public function updateEnrollment(
        Request $request,
        callable $configureMocks,
        ?\Exception $expectedException
    )
    {
        $configureMocks($this->mapper, $this->assembler);

        if ($expectedException) {
            self::expectException($expectedException::class);
        }

        $this->updater->updateEnrollment($request, $this->createMock(Enrollment::class));
    }

    public function updateEnrollmentDataProvider(): iterable
    {
        yield 'Enrollment updated and saved' => [
            'request' => $this->createMock(Request::class),
            'configureMocks' => function (EnrollmentRequestMapper $mapper,
                                          EnrollmentUpdateAssembler $assembler) {
                $mapper
                    ->expects(self::once())
                    ->method('enrollmentUpdate')
                    ->willReturn($this->createMock(EnrollmentUpdateDTO::class));

                $saveableEnrollment = $this->createMock(Enrollment::class);
                $saveableEnrollment->method('save')->willReturn(true);

                $assembler
                    ->expects(self::once())
                    ->method('toEntity')
                    ->willReturn($saveableEnrollment);
            },
            'expectedException' => null
        ];

        yield 'Enrollment created but not saved' => [
            'request' => $this->createMock(Request::class),
            'configureMocks' => function (EnrollmentRequestMapper $mapper,
                                          EnrollmentUpdateAssembler $assembler) {
                $mapper
                    ->expects(self::once())
                    ->method('enrollmentUpdate')
                    ->willReturn($this->createMock(EnrollmentUpdateDTO::class));

                $assembler
                    ->expects(self::once())
                    ->method('toEntity')
                    ->willReturn($this->createMock(Enrollment::class));
            },
            'expectedException' => new ModelSaveFailedException()
        ];
    }
}
