<?php

namespace App\Enums;

enum BookLoanStatusEnum: int
{
    case LATE = 1;
    case RETURNED = 2;
}
