<?php

namespace LaravelEnso\Enums\Traits;

use Illuminate\Support\Collection;

trait Random
{
    public static function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }

    public static function select(): array
    {
        return Collection::wrap(self::cases())
            ->map(fn ($case) => (object) ['id' => $case->value, 'name' => $case->name])
            ->values()
            ->all();
    }
}
