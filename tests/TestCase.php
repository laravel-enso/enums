<?php

namespace LaravelEnso\Enums\Tests;

use Illuminate\Support\Facades\File;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadFixtures();
    }

    protected function tearDown(): void
    {
        $this->removeRuntimeFixturePackage();

        parent::tearDown();
    }

    protected function loadFixtures(): void
    {
        foreach (File::allFiles(__DIR__.'/Fixtures') as $file) {
            if ($file->getExtension() === 'php') {
                require_once $file->getRealPath();
            }
        }
    }

    protected function installRuntimeFixturePackage(): string
    {
        $source = __DIR__.'/Fixtures/FixtureVendorPackage';
        $destination = base_path('vendor/laravel-enso-fixture/enums-package');

        File::deleteDirectory(dirname($destination));
        File::copyDirectory($source, $destination);

        return $destination;
    }

    protected function removeRuntimeFixturePackage(): void
    {
        File::deleteDirectory(base_path('vendor/laravel-enso-fixture'));
    }
}
