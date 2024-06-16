<?php

namespace App\Enums;

enum LoanStatusEnum: string
{
    case LATE = 'Atrasado';
    case RETURNED = 'Devolvido';
}
