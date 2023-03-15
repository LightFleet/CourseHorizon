<?php

namespace App\Modules\Course\Application\Exception;

use App\Contracts\InvalidRequestException;

class TitleIsRequiredAndShouldBeStringException extends InvalidRequestException
{
}
