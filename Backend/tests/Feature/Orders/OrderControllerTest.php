<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_list_orders_success()
    {
        $this->actingAs($this->user, 'api');

        $response = $this->getJson('/api/orders');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'status', 'created_at']
            ]);
    }


    public function test_create_order_success()
    {
        $this->actingAs($this->user, 'api');

        $payload = [
            'client_name' => 'Ana Martínez',
            'items' => [
                [
                    'description' => 'Ceviche de pescado',
                    'quantity' => 2,
                    'unit_price' => 50
                ],
                [
                    'description' => 'Chicha morada',
                    'quantity' => 3,
                    'unit_price' => 8
                ]
            ]
        ];

        $response = $this->postJson('/api/orders', $payload);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'orderId',
                'clientName',
                'status',
            ]);
    }

    public function test_advance_order_success()
    {
        $this->actingAs($this->user, 'api');

        $order = Order::factory()->create();

        $response = $this->postJson("/api/orders/{$order->id}/advance");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function test_get_order_success()
    {
        $this->actingAs($this->user, 'api');

        $order = Order::factory()->create();

        $response = $this->getJson("/api/orders/{$order->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $order->id,
            ]);
    }
}
