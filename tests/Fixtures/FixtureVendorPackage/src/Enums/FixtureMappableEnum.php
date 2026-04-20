<?php

namespace FixtureVendor\EnumsPackage\Enums;

use LaravelEnso\Enums\Contracts\Frontend;
use LaravelEnso\Enums\Contracts\Mappable;

enum FixtureMappableEnum: int implements Frontend, Mappable
{
    case Draft = 1;
    case Published = 2;

    public static function registerBy(): string
    {
        return 'fixtureMappable';
    }

    public function map(): mixed
    {
        return match ($this) {
            self::Draft     => 'Mapped Draft',
            self::Published => 'Mapped Published',
        };
    }
}
