<?php

namespace LaravelEnso\Enums\Traits;

use Illuminate\Support\Collection;

trait Select
{
    public static function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }

    public static function select(): array
    {
        return Collection::wrap(self::cases())
            ->map(fn ($enum) => [
                'id' => $enum->value,
                'name' => $enum->name,
            ])->values()
            ->toArray();
    }
}
