<?php

namespace LaravelEnso\Enums\Tests\Fixtures;

use LaravelEnso\Enums\Services\Enum;

class LocalizedLegacyStatus extends Enum
{
    protected static function data(): array
    {
        return [
            'pending' => 'enums.pending',
        ];
    }
}
