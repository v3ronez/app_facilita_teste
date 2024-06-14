<?php

namespace App\Enums;

enum BookStatusEnum: int
{
    case AVAILABLE = 1;
    case BORROWED = 2;
}
