<?php

namespace App\Enums;

enum LoanStatusEnum: string
{
    case OK = 'ok';
    case LATE = 'atrasado';
    case RETURNED = 'devolvido';
}
