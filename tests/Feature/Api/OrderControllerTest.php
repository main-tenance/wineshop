<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Routes\Api\ApiRoutesProvider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;
use Tests\Generators\OrderGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;

/**
 * @group api-order
 */
class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * @var User
     */
    private $client;
    private array $data;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->client = Client::factory()->create();
        Passport::actingAsClient(
            $this->client,
            ['see-orders']
        );
//        $mock = $this->partialMock(OrderController::class, function (MockInterface $mock) {
//            $mock->shouldReceive('getClient')->andReturn($this->client->id)->once();
//        });
    }

    /**
     * @group api-order1
     */
    public function testIndex()
    {
        $this->markTestSkipped();
        $response = $this->getJson(ApiRoutesProvider::orderIndex());
        $response->assertOk()
            ->assertJsonPath('data.count', 0);
        $order = OrderGenerator::create(1, ['client_id' => $this->client->id]);
        $response = $this->getJson(ApiRoutesProvider::orderIndex());
        $response->assertOk();
    }
}
