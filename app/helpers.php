<?php

declare(strict_types=1);

function formatCpf(string $cpf)
{
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
}

function clearSpecialCaractersCpf(string $cpf)
{
    return preg_replace('/[^A-Za-z0-9 ]/', '', $cpf);
}
