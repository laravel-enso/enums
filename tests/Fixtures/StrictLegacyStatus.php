<?php

namespace LaravelEnso\Enums\Tests\Fixtures;

class StrictLegacyStatus extends LegacyStatus
{
    protected static bool $validatesKeys = true;
}
