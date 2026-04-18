<?php

namespace LaravelEnso\Enums\Tests\Fixtures;

use LaravelEnso\Enums\Traits\Random;

enum RandomEnum: int
{
    use Random;

    case One = 1;
    case Two = 2;
}
