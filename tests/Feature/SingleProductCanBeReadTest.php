<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SingleProductCanBeReadTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/products/' . $product->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }
}
