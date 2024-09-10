<?php

namespace LaravelEnso\Enums\Traits;

use Illuminate\Support\Collection;

trait Search
{
    public static function search($value)
    {
        return Collection::wrap(self::cases())
            ->firstWhere(fn ($enum) => $enum->name === $value);
    }
}
