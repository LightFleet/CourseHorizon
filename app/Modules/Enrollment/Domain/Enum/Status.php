<?php

namespace App\Modules\Enrollment\Domain\Enum;

use JetBrains\PhpStorm\Pure;
use MyCLabs\Enum\Enum;

/**
 * @method static self IN_PROGRESS()
 * @method static self COMPLETED()
 */
class Status extends Enum
{
    public const IN_PROGRESS = 0;
    public const COMPLETED = 1;

    private const LABELS = [
        self::IN_PROGRESS => 'In Progress',
        self::COMPLETED => 'Completed',
    ];

    #[Pure]
    public function getLabel(): string
    {
        return self::LABELS[$this->getValue()];
    }

    #[Pure]
    public function isCompleted(): bool
    {
        return $this->getValue() === self::COMPLETED;
    }
}
