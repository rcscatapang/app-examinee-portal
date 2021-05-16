<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ExamStatus extends Enum
{
    const Draft = 0;
    const Published = 1;
    const Completed = 2;
}
