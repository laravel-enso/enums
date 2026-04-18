<?php

namespace LaravelEnso\Enums\Tests\Fixtures;

use LaravelEnso\Enums\Contracts\Frontend;
use LaravelEnso\Enums\Traits\Select;

enum PlainFrontendEnum: int implements Frontend
{
    use Select;

    case Draft = 1;
    case Published = 2;

    public static function registerBy(): string
    {
        return 'plainFrontend';
    }
}
