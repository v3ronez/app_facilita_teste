<?php

namespace App\Enums;

enum BookStatusEnum: string
{
    case AVAILABLE = 'disponível';
    case BORROWED = 'emprestado';
}
