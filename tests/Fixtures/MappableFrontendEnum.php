<?php

namespace LaravelEnso\Enums\Tests\Fixtures;

use LaravelEnso\Enums\Contracts\Frontend;
use LaravelEnso\Enums\Contracts\Mappable;
use LaravelEnso\Enums\Traits\Select;

enum MappableFrontendEnum: int implements Frontend, Mappable
{
    use Select;

    case Draft = 1;
    case Published = 2;

    public static function registerBy(): string
    {
        return 'mappableFrontend';
    }

    public function map(): mixed
    {
        return match ($this) {
            self::Draft => 'Mapped Draft',
            self::Published => 'Mapped Published',
        };
    }
}
