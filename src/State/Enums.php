<?php

namespace LaravelEnso\Enums\State;

use LaravelEnso\Core\Contracts\ProvidesState;
use LaravelEnso\Enums\Facades\Enums as LegacyFacade;
use LaravelEnso\Enums\Services\Enums as Service;

class Enums implements ProvidesState
{
    public function store(): string
    {
        return 'enums';
    }

    public function state(): array
    {
        $enums = array_merge((new Service())->handle(), LegacyFacade::all());

        return ['enums' => $enums];
    }
}
