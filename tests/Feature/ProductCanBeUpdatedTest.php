<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCanBeUpdatedTest extends TestCase
{
    use RefreshDatabase;
    public function test_update_product_in_cart()
    {
        $product = Product::factory()->create([
            'in_stock' => true,
            'min_qty' => 1
        ]);

        $this->postJson('/api/cart', [
            'product_id' => $product->id,
            'qty' => 1,
        ]);

        $response = $this->putJson('/api/cart/' . $product->id, [
            'qty' => 5
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }
}
