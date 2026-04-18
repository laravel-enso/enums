<?php

namespace LaravelEnso\Enums\Tests\Fixtures;

use LaravelEnso\Enums\Services\Enum;

class DataBackedLegacyStatus extends Enum
{
    protected static function data(): array
    {
        return [
            10 => 'Ten',
            20 => 'Twenty',
        ];
    }
}
