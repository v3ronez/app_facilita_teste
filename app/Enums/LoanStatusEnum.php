<?php

namespace App\Enums;

enum LoanStatusEnum: int
{
    case LATE = 1;
    case RETURNED = 2;
}
