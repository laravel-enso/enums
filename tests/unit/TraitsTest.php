<?php

namespace LaravelEnso\Enums\Tests\Unit;

require_once __DIR__.'/../TestCase.php';

use LaravelEnso\Enums\Tests\Fixtures\MappableFrontendEnum;
use LaravelEnso\Enums\Tests\Fixtures\PlainFrontendEnum;
use LaravelEnso\Enums\Tests\Fixtures\RandomEnum;
use LaravelEnso\Enums\Tests\Fixtures\SearchableEnum;
use LaravelEnso\Enums\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TraitsTest extends TestCase
{
    #[Test]
    public function select_trait_returns_id_name_pairs_for_plain_enum(): void
    {
        $this->assertSame([
            ['id' => 1, 'name' => 'Draft'],
            ['id' => 2, 'name' => 'Published'],
        ], PlainFrontendEnum::select());
    }

    #[Test]
    public function select_trait_uses_map_for_mappable_enum(): void
    {
        $this->assertSame([
            ['id' => 1, 'name' => 'Mapped Draft'],
            ['id' => 2, 'name' => 'Mapped Published'],
        ], MappableFrontendEnum::select());
    }

    #[Test]
    public function search_trait_returns_matching_case_by_name(): void
    {
        $this->assertSame(SearchableEnum::Alpha, SearchableEnum::search('Alpha'));
    }

    #[Test]
    public function search_trait_returns_null_when_case_does_not_exist(): void
    {
        $this->assertNull(SearchableEnum::search('Missing'));
    }

    #[Test]
    public function random_trait_returns_existing_case(): void
    {
        $this->assertContains(RandomEnum::random(), RandomEnum::cases());
    }

    #[Test]
    public function random_trait_builds_select_payload_for_backed_enum(): void
    {
        $select = RandomEnum::select();

        $this->assertCount(2, $select);
        $this->assertEquals((object) ['id' => 1, 'name' => 'One'], $select[0]);
        $this->assertEquals((object) ['id' => 2, 'name' => 'Two'], $select[1]);
    }
}
