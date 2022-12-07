<?php

namespace LaravelEnso\Enums\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Enums
{
    public function handle(): array
    {
        return $this->enums()
            ->mapWithKeys(fn ($enum) => [
                $enum::registerBy() => $this->map($enum),
            ])->toArray();
    }

    private function enums(): Collection
    {
        return Collection::wrap(Config::get('enso.enums.vendors'))
            ->map(fn ($vendor) => base_path("vendor/{$vendor}"))
            ->map(fn ($vendor) => File::directories($vendor))
            ->flatten()
            ->push(base_path())
            ->mapInto(Source::class)
            ->map->get()
            ->filter->isNotEmpty()
            ->collapse();
    }

    private function map(string $enum): Collection
    {
        return Collection::wrap($enum::cases())
            ->pluck('name', 'value')
            ->map(fn ($value) => $this->label($value));
    }

    private function label(string $value): string
    {
        $string = Str::of($value);

        return $string->exactly($string->upper())
            ? $string->title()
            : $string->snake(' ')->title();
    }
}
