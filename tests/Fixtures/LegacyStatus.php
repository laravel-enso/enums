<?php

namespace LaravelEnso\Enums\Tests\Fixtures;

use LaravelEnso\Enums\Services\Enum;

class LegacyStatus extends Enum
{
    public const Draft = 'draft';
    public const Published = 'published';
    public const Invalid = ['invalid'];

    private const Hidden = 'hidden';
}
