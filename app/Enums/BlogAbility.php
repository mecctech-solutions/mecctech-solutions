<?php

namespace App\Enums;

enum BlogAbility: string
{
    case Read = 'blog:read';
    case Write = 'blog:write';
}
