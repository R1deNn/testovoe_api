<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProductFromCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_product_from_cart()
    {
        $product = Product::factory()->create([
            'in_stock' => true,
            'min_qty' => 1
        ]);

        $this->postJson('/api/cart', [
            'product_id' => $product->id,
            'qty' => 1,
        ]);

        $response = $this->deleteJson('/api/cart/' . $product->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }
}
