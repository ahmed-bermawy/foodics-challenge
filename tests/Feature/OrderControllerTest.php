<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;


class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function test_successful_order_creation()
    {
        $branch = Branch::factory()->create();
        $product = Product::factory()->create();

        $response = $this->postJson('/api/orders', [
            'name' => 'Test Order',
            'branch_id' => $branch->id,
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'price' => 100.00,
                ],
            ],
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'branch' => [
                    'id',
                    'name',
                ],
                'items' => [
                    '*' => [
                        'id',
                        'product_id',
                        'quantity',
                        'price',
                        'created_at',
                    ],
                ],
                'total_amount',
                'created_at',
            ]);

        $this->assertDatabaseHas('orders', ['name' => 'Test Order']);
    }

    public function test_order_creation_with_missing_required_fields()
    {
        $response = $this->postJson('/api/orders', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'branch_id', 'items']);
    }

    public function test_order_creation_with_invalid_branch_id()
    {
        $product = Product::factory()->create();

        $response = $this->postJson('/api/orders', [
            'name' => 'Test Order',
            'branch_id' => 999, // Invalid branch ID
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'price' => 100.00,
                ],
            ],
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['branch_id']);
    }

    public function test_order_creation_with_invalid_items()
    {
        $branch = Branch::factory()->create();

        $response = $this->postJson('/api/orders', [
            'name' => 'Test Order',
            'branch_id' => $branch->id,
            'items' => [
                [
                    'product_id' => 999, // Invalid product ID
                    'quantity' => 2,
                    'price' => 100.00,
                ],
            ],
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['items.0.product_id']);
    }

    public function test_order_creation_with_exceeding_rate_limit()
    {
        $branch = Branch::factory()->create();
        $product = Product::factory()->create();

        for ($i = 0; $i < 60; $i++) {
            RateLimiter::hit("branch-throttle|{$branch->id}");
        }

        $response = $this->postJson('/api/orders', [
            'name' => 'Test Order',
            'branch_id' => $branch->id,
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'price' => 100.00,
                ],
            ],
        ]);

        $response->assertStatus(429)
            ->assertJson(['message' => 'Too many requests']);
    }
}