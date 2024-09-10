<?php

namespace LaravelEnso\Enums\Traits;

use Illuminate\Support\Collection;
use LaravelEnso\Enums\Contracts\Mappable;
use ReflectionEnum;

trait Search
{
    public static function search(mixed $label): self
    {
        $matches = fn ($enum) => (new ReflectionEnum(self::class))
            ->implementsInterface(Mappable::class)
            ? $enum->map() === $label
            : $enum->value === $label;

        return Collection::wrap(self::cases())->firstWhere($matches);
    }
}
