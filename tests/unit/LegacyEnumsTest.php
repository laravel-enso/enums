<?php

namespace LaravelEnso\Enums\Tests\Unit;

require_once __DIR__.'/../TestCase.php';

use Illuminate\Support\Facades\Facade;
use LaravelEnso\Enums\EnumServiceProvider;
use LaravelEnso\Enums\Facades\Enums as EnumsFacade;
use LaravelEnso\Enums\Services\LegacyEnums;
use LaravelEnso\Enums\Tests\Fixtures\LegacyStatus;
use LaravelEnso\Enums\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class LegacyEnumsTest extends TestCase
{
    #[Test]
    public function registers_legacy_enums(): void
    {
        $enums = new LegacyEnums();
        $enums->register(['statuses' => LegacyStatus::class]);

        $this->assertSame([
            'statuses' => [
                'draft'     => 'Draft',
                'published' => 'Published',
            ],
        ], $enums->all());
    }

    #[Test]
    public function removes_registered_legacy_enums(): void
    {
        $enums = new LegacyEnums();
        $enums->register(['statuses' => LegacyStatus::class]);
        $enums->remove('statuses');

        $this->assertSame([], $enums->all());
    }

    #[Test]
    public function keeps_pre_mapped_array_entries_unchanged(): void
    {
        $enums = new LegacyEnums();
        $enums->register([
            'mapped'   => ['foo' => 'bar'],
            'statuses' => LegacyStatus::class,
        ]);

        $this->assertSame([
            'mapped'   => ['foo' => 'bar'],
            'statuses' => [
                'draft'     => 'Draft',
                'published' => 'Published',
            ],
        ], $enums->all());
    }

    #[Test]
    public function enum_service_provider_registers_declared_legacy_enums(): void
    {
        $legacyEnums = new LegacyEnums();

        app()->instance('legacyEnums', $legacyEnums);
        Facade::clearResolvedInstance('legacyEnums');

        $provider = new class(app()) extends EnumServiceProvider {
            public $register = ['statuses' => LegacyStatus::class];
        };

        $provider->boot();

        $this->assertSame([
            'statuses' => [
                'draft'     => 'Draft',
                'published' => 'Published',
            ],
        ], EnumsFacade::all());
    }
}
