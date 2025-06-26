<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $productId = $this['product_id'];
        $qty = $this['qty'];
        $product = \App\Models\Product::find($productId);

        return [
            'product_id' => $productId,
            'qty' => $qty,
            'product' => $product ? new ProductResource($product) : null,
        ];
    }
}
