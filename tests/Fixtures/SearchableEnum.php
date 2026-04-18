<?php

namespace LaravelEnso\Enums\Tests\Fixtures;

use LaravelEnso\Enums\Traits\Search;

enum SearchableEnum: string
{
    use Search;

    case Alpha = 'alpha';
    case Beta = 'beta';
}
