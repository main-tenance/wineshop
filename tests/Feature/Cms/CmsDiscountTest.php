<?php

namespace Tests\Feature\Cms;

use App\Http\Routes\Cms\CmsRoutes;
use App\Http\Routes\Cms\CmsRoutesProvider;
use App\Models\Discount;
use App\Models\Group;
use App\Services\Locale\LocaleService;
use Database\Factories\DiscountFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;
use function MongoDB\BSON\toJSON;

/**
 * Class CmsDiscountTest
 * @package Tests\Feature\Cms
 * @group cms
 * @group cmsDiscount
 */
class CmsDiscountTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexNotAuthenticated()
    {
        $this->get(CmsRoutesProvider::discountIndex())
            ->assertStatus(302)
            ->assertRedirect(route('login', [LocaleService::PARAMETER_LOCALE => App::getLocale()]));
    }

    public function testIndexNotAuthorized()
    {
        $this->actingAs($this->getUser())
            ->get(CmsRoutesProvider::discountIndex())
            ->assertStatus(403);
    }

    public function testIndexManagerAuthorized()
    {
        $this->actingAs($this->getManager())
            ->get(CmsRoutesProvider::discountIndex())
            ->assertStatus(200);
    }

    public function testStoreAdminAuthorized()
    {
        $data = $this->getData();
        $response = $this->actingAs($this->getAdmin())
            ->post(route(CmsRoutes::DISCOUNT_STORE), $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('groups', ['id' => $data['groups'][0]]);
        $this->assertDatabaseHas('discounts', ['name' => $data['name']]);
        $this->assertDatabaseHas('discount_group', [
            'group_id' => $data['groups'][0],
            'discount_id' => $response['id'],
        ]);
    }

    public function testStoreManagerNotAuthorized()
    {
        $data = $this->getData();
        $this->actingAs($this->getManager())
            ->post(route(CmsRoutes::DISCOUNT_STORE), $data)
            ->assertStatus(403);
    }

    public function testStoreWithoutGroups()
    {
        $data = $this->getData();
        unset($data['groups']);
        $this->actingAs($this->getAdmin())
            ->post(route(CmsRoutes::DISCOUNT_STORE), $data)
            ->assertSessionHasErrors(['groups']);
    }

    public function testUpdateConditions()
    {
        $discount = Discount::factory()->create();
        $group = Group::factory()->create();
        $this->actingAs($this->getAdmin())
            ->put(route(CmsRoutes::DISCOUNT_UPDATE, ['discount' => $discount->id]), [
                'name' => $discount->name,
                'groups' => [
                    $group->id,
                ],
                'conditions' => [
                    [
                        'category_id' => 342,
                    ],
                ]
            ])
            ->assertOk();
        $discount->refresh();
        $this->assertEquals([
                [
                    'category_id' => 342,
                ],
            ], json_decode($discount->conditions, true));
    }

    private function getData()
    {
        $data = app(DiscountFactory::class)->definition();
        $group = Group::factory()->create();
        $data['groups'] = [$group['id']];

        return $data;
    }
}
