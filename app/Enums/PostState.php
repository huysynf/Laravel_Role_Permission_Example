<?php

namespace App\Enums;

enum PostState : string
{
    case Draft = 'draft';
    case Active = 'active';
}
