<?php

namespace Tests\Feature\Cms;

use App\Http\Routes\Web\WebRoutesProvider;
use App\Http\Routes\Cms\CmsRoutes;
use App\Http\Routes\Cms\CmsRoutesProvider;
use App\Models\Code;
use App\Models\Creator;
use Database\Factories\CreatorFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class CmsCreatorTest
 * @package Tests\Feature\Cms
 * @group cms
 * @group cmsCreator
 */
class CmsCreatorTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexNotAuthenticated()
    {
        $this->get(route('cms.creator.index'))
            ->assertStatus(302)
            ->assertRedirect(WebRoutesProvider::login());
    }

    public function testIndexNotAuthorized()
    {
        $this->actingAs($this->getUser())
            ->get(CmsRoutesProvider::creatorIndex())
            ->assertStatus(403);
    }

    public function testIndexManagerAuthorized()
    {
        $this->actingAs($this->getManager())
            ->get(CmsRoutesProvider::creatorIndex())
            ->assertStatus(200);
    }

    public function testStoreManagerAuthorized()
    {
        $data = $this->getData();
        $this->actingAs($this->getManager())
            ->post(route(CmsRoutes::CREATOR_STORE), $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('creators', ['code' => $data['code']]);
    }

    public function testStoreResponseStructure()
    {
        $data = $this->getData();
        $this->actingAs($this->getManager())
            ->post(route(CmsRoutes::CREATOR_STORE), $data)
            ->assertStatus(200)
            ->assertJsonStructure(['ok', 'id']);
    }

    public function testEdit()
    {
        $code = Code::factory()->create();
        $creator = Creator::factory()->create(['code' => $code->code]);
        $this->assertDatabaseHas('creators', ['code' => $creator->code]);
        $this->actingAs($this->getManager())
            ->get(route(CmsRoutes::CREATOR_EDIT, [
                'creator' => $creator->id,
            ]))
            ->assertStatus(200)
            ->assertSee($creator->name);
    }

    public function testDestroy()
    {
        $code = Code::factory()->create();
        $creator = Creator::factory()->create(['code' => $code->code]);
        $this->assertDatabaseHas('creators', ['code' => $creator->code]);
        $this->actingAs($this->getManager())
            ->delete(route(CmsRoutes::CREATOR_DESTROY, [
                'creator' => $creator->id,
            ]))
            ->assertOk();
        $this->assertDatabaseMissing('creators', ['code' => $creator->code]);
    }

    private function getData()
    {
        return app(CreatorFactory::class)->definition();
    }
}
