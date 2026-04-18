<?php

namespace FixtureVendor\EnumsPackage\Enums;

use LaravelEnso\Enums\Contracts\Frontend;

enum FixturePlainEnum: int implements Frontend
{
    case Draft = 1;
    case Published = 2;

    public static function registerBy(): string
    {
        return 'fixturePlain';
    }
}
