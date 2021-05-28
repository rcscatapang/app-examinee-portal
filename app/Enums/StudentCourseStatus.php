<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StudentCourseStatus extends Enum
{
    const Pending = 0;
    const Active = 1;
    const Inactive = 2;
}
