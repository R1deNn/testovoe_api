<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Services\Api\CartService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Cart",
 *     description="Работа с корзиной"
 * )
 */
class CartController extends Controller
{
    /** @var CartService */
    protected CartService $cartService;

    /**
     * @OA\Get(
     *     path="/api/cart",
     *     summary="Получить содержимое корзины",
     *     tags={"Cart"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="OK")
     * )
     */
    public function index()
    {
        return CartResource::collection($this->cartService->all());
    }

    /**
     * @OA\Post(
     *     path="/api/cart",
     *     summary="Добавить товар в корзину",
     *     tags={"Cart"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_id", "qty"},
     *             @OA\Property(property="product_id", type="string"),
     *             @OA\Property(property="qty", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="OK")
     * )
     */
    public function store(StoreCartRequest $request)
    {
        $cart = $this->cartService->add(
            $request->input('product_id'),
            $request->input('qty')
        );

        return CartResource::collection($cart);
    }

    /**
     * @OA\Put(
     *     path="/api/cart/{product_id}",
     *     summary="Обновить количество товара в корзине",
     *     tags={"Cart"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="product_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"qty"},
     *             @OA\Property(property="qty", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="OK")
     * )
     */
    public function update(UpdateCartRequest $request, string $product_id)
    {
        $cart = $this->cartService->update(
            $product_id,
            $request->input('qty')
        );

        return CartResource::collection($cart);
    }

    /**
     * @OA\Delete(
     *     path="/api/cart/{product_id}",
     *     summary="Удалить товар из корзины",
     *     tags={"Cart"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="product_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="OK")
     * )
     */
    public function destroy(string $product_id)
    {
        $cart = $this->cartService->delete($product_id);

        return CartResource::collection($cart);
    }

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
}
