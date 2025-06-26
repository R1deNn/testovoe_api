<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Services\Api\CartService;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService) {}

    public function index()
    {
        return CartResource::collection($this->cartService->all());
    }

    public function store(StoreCartRequest $request)
    {
        $cart = $this->cartService->add(
            $request->input('product_id'),
            $request->input('qty')
        );

        return CartResource::collection($cart);
    }

    public function update(UpdateCartRequest $request, string $product_id)
    {
        $qty = $request->input('qty');

        $cart = $this->cartService->update($product_id, $qty);

        return CartResource::collection($cart);
    }

    public function destroy(string $product_id)
    {
        $cart = $this->cartService->delete($product_id);

        return CartResource::collection($cart);
    }
}
