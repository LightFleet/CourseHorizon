<?php

namespace App\Modules\Enrollment\Domain\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static self IN_PROGRESS()
 * @method static self COMPLETED()
 */
class Status extends Enum
{
    const IN_PROGRESS = 'in_progress';
    const COMPLETED = 'completed';
}
