<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Services\Api\CartService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * CartController отвечает за операции с корзиной: просмотр, добавление,
 * обновление и удаление товаров.
*/
class CartController
{
    /**
     * CartService для работы с бизнес-логикой корзины.
     *
     * @param CartService $cartService
     */
    public function __construct(protected CartService $cartService) {}

    /**
     * Получить текущие товары в корзине.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection Коллекция ресурсов корзины
     */
    public function index(): AnonymousResourceCollection
    {
        return CartResource::collection($this->cartService->all());
    }

    /**
     * Добавить товар в корзину.
     *
     * @param StoreCartRequest $request Валидация входящих данных (product_id, qty)
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection Обновлённая коллекция ресурсов корзины
     */
    public function store(StoreCartRequest $request): AnonymousResourceCollection
    {
        $cart = $this->cartService->add(
            $request->input('product_id'),
            $request->input('qty')
        );

        return CartResource::collection($cart);
    }

    /**
     * Обновить количество товара в корзине.
     *
     * @param UpdateCartRequest $request Валидация нового количества (qty)
     * @param string $product_id UUID товара для обновления
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection Обновлённая коллекция ресурсов корзины
     */
    public function update(UpdateCartRequest $request, string $product_id): AnonymousResourceCollection
    {
        $cart = $this->cartService->update(
            $product_id,
            $request->input('qty')
        );

        return CartResource::collection($cart);
    }

    /**
     * Удалить товар из корзины.
     *
     * @param string $product_id UUID товара для удаления
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection Обновлённая коллекция ресурсов корзины
     */
    public function destroy(string $product_id): AnonymousResourceCollection
    {
        $cart = $this->cartService->delete($product_id);

        return CartResource::collection($cart);
    }
}
