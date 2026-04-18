<?php

namespace LaravelEnso\Enums\Tests\Features;

require_once __DIR__.'/../TestCase.php';

use LaravelEnso\Enums\Services\Enums as EnumService;
use LaravelEnso\Enums\Services\Source;
use LaravelEnso\Enums\State\Enums as EnumState;
use LaravelEnso\Enums\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class SourceAndStateTest extends TestCase
{
    #[Test]
    public function discovers_frontend_enums_from_source_folder(): void
    {
        $classes = (new Source(__DIR__.'/../Fixtures/FixtureVendorPackage'))->get()->all();

        $this->assertContains('FixtureVendor\\EnumsPackage\\Enums\\FixturePlainEnum', $classes);
        $this->assertContains('FixtureVendor\\EnumsPackage\\Enums\\FixtureMappableEnum', $classes);
    }

    #[Test]
    public function ignores_non_frontend_native_enums(): void
    {
        $classes = (new Source(__DIR__.'/../Fixtures/FixtureVendorPackage'))->get()->all();

        $this->assertNotContains('FixtureVendor\\EnumsPackage\\Enums\\NotFrontendEnum', $classes);
    }

    #[Test]
    public function maps_mappable_and_non_mappable_enums_for_frontend_state(): void
    {
        $this->installRuntimeFixturePackage();
        config()->set('enso.enums.vendors', ['laravel-enso-fixture']);

        $state = (new EnumService())->handle();

        $this->assertSame([
            1 => 'Draft',
            2 => 'Published',
        ], $state['fixturePlain']);

        $this->assertSame([
            1 => 'Mapped Draft',
            2 => 'Mapped Published',
        ], $state['fixtureMappable']);
    }

    #[Test]
    public function exposes_native_enums_under_the_enums_store_key(): void
    {
        $this->installRuntimeFixturePackage();
        config()->set('enso.enums.vendors', ['laravel-enso-fixture']);

        $state = (new EnumState())->state();

        $this->assertSame('enums', (new EnumState())->store());
        $this->assertSame([
            1 => 'Draft',
            2 => 'Published',
        ], $state['enums']['fixturePlain']);
        $this->assertSame([
            1 => 'Mapped Draft',
            2 => 'Mapped Published',
        ], $state['enums']['fixtureMappable']);
    }
}
