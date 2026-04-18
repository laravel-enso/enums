<?php

namespace LaravelEnso\Enums\Tests\Unit;

require_once __DIR__.'/../TestCase.php';

use Illuminate\Support\Facades\Lang;
use LaravelEnso\Enums\Exceptions\Enum as EnumException;
use LaravelEnso\Enums\Tests\Fixtures\DataBackedLegacyStatus;
use LaravelEnso\Enums\Tests\Fixtures\LegacyStatus;
use LaravelEnso\Enums\Tests\Fixtures\LocalizedLegacyStatus;
use LaravelEnso\Enums\Tests\Fixtures\StrictLegacyStatus;
use LaravelEnso\Enums\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class LegacyEnumTest extends TestCase
{
    #[Test]
    public function returns_public_constants_only(): void
    {
        $this->assertSame([
            'draft' => 'Draft',
            'published' => 'Published',
        ], LegacyStatus::constants());
    }

    #[Test]
    public function gets_value_by_key(): void
    {
        $this->assertSame('Draft', LegacyStatus::get('draft'));
        $this->assertTrue(LegacyStatus::has('published'));
        $this->assertFalse(LegacyStatus::has('missing'));
    }

    #[Test]
    public function throws_for_missing_key_when_validation_is_enabled(): void
    {
        $this->expectException(EnumException::class);
        $this->expectExceptionMessage('Key not found');

        StrictLegacyStatus::get('missing');
    }

    #[Test]
    public function returns_keys_values_json_array_object_and_collection(): void
    {
        $this->assertSame(['draft', 'published'], LegacyStatus::keys()->all());
        $this->assertSame(['Draft', 'Published'], LegacyStatus::values()->all());
        $this->assertSame(['draft' => 'Draft', 'published' => 'Published'], LegacyStatus::array());
        $this->assertSame(['draft' => 'Draft', 'published' => 'Published'], LegacyStatus::all());
        $this->assertSame('{"draft":"Draft","published":"Published"}', LegacyStatus::json());
        $this->assertEquals((object) ['draft' => 'Draft', 'published' => 'Published'], LegacyStatus::object());
        $this->assertSame(['draft' => 'Draft', 'published' => 'Published'], LegacyStatus::collection()->all());
    }

    #[Test]
    public function builds_select_payload(): void
    {
        $select = LegacyStatus::select()->all();

        $this->assertCount(2, $select);
        $this->assertEquals((object) ['id' => 'draft', 'name' => 'Draft'], $select[0]);
        $this->assertEquals((object) ['id' => 'published', 'name' => 'Published'], $select[1]);
    }

    #[Test]
    public function respects_localisation_toggle(): void
    {
        Lang::addLines(['enums.pending' => 'Pending'], app()->getLocale());

        LocalizedLegacyStatus::localisation();
        $this->assertSame('Pending', LocalizedLegacyStatus::get('pending'));

        LocalizedLegacyStatus::localisation(false);
        $this->assertSame('enums.pending', LocalizedLegacyStatus::get('pending'));

        LocalizedLegacyStatus::localisation();
    }

    #[Test]
    public function prefers_data_method_over_constants(): void
    {
        $this->assertSame([
            10 => 'Ten',
            20 => 'Twenty',
        ], DataBackedLegacyStatus::all());
    }
}
