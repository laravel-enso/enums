<?php

namespace LaravelEnso\Enums\Traits;

use Illuminate\Support\Collection;

trait Search
{
    public static function search(string $name): ?self
    {
        return Collection::wrap(self::cases())
            ->firstWhere(fn ($enum) => $enum->name === $name);
    }
}
