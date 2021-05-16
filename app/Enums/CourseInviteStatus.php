<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CourseInviteStatus extends Enum
{
    const Pending = 0;
    const Accepted = 1;
    const Expired = 2;
}
