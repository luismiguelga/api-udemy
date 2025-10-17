<?php

namespace App\Enums;

enum Status: string
{
    case DRAFT = '1';
    case PUBLIC = '2';

    public function getLabel(): string
    {
        return match ($this) {
            Status::DRAFT => 'Borrador',
            Status::PUBLIC => 'Publico',
        };
    }
}
