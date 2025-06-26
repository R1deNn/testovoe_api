<?php

namespace App\Services\Api;

use App\Exceptions\ApiException;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Session;
use App\Api\ApiResourceTrait;
/**
 * Сервис для работы с корзиной пользователя.
 *
 * Корзина хранится во время сессии (Session).
 */
class CartService
{
    use ApiResourceTrait;
    /**
     * Ключ для хранения корзины в сессии.
     *
     * @var string
     */
    protected string $sessionKey = 'cart';

    /**
     * Получить все товары из корзины.
     *
     * @return array Массив товаров в корзине, каждый элемент содержит:
     *               - product_id (string): UUID товара
     *               - qty (int): количество товара
     */
    public function all(): array
    {
        return Session::get($this->sessionKey, []);
    }

    /**
     * Добавить товар в корзину.
     *
     * Если товар уже есть, увеличивает количество.
     * Проверяет, что товар в наличии и количество >= минимального.
     *
     * @param string $productId UUID товара
     * @param int $qty Количество для добавления
     *
     * @return array Обновлённый массив корзины
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Если товар не найден
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException Если товар не в наличии или количество меньше минимального
     * @throws ApiException Обработчик ошибок
     */
    public function add(string $productId, int $qty): array
    {
        $product = Product::find($productId);

        if (!$product) {
            throw new ApiException('Товар не найден', 404);
        }

        if (!$product->in_stock) {
            throw new ApiException('Продукт не в наличии', 400);
        }

        if ($qty < $product->min_qty) {
            throw new ApiException("Количество меньше минимального {$product->min_qty}", 400);
        }

        $cart = $this->all();

        $index = collect($cart)->search(fn ($item) => $item['product_id'] === $productId);

        if ($index !== false) {
            $cart[$index]['qty'] += $qty;
        } else {
            $cart[] = ['product_id' => $productId, 'qty' => $qty];
        }

        Session::put($this->sessionKey, $cart);

        return $cart;
    }

    /**
     * Обновить количество товара в корзине.
     *
     * Проверяет, что количество >= минимального.
     *
     * @param string $productId UUID товара
     * @param int $qty Новое количество
     *
     * @return array Обновлённый массив корзины
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Если товар не найден
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException Если количество меньше минимального
     */
    public function update(string $productId, int $qty): array
    {
        $product = Product::findOrFail($productId);

        if ($qty < $product->min_qty) {
            throw new HttpResponseException(response()->json([
                'error' => "Количество меньше минимального ({$product->min_qty})"
            ], 400));
        }

        $cart = $this->all();

        foreach ($cart as &$item) {
            if ($item['product_id'] === $productId) {
                $item['qty'] = $qty;
            }
        }

        Session::put($this->sessionKey, $cart);

        return $cart;
    }

    /**
     * Удалить товар из корзины.
     *
     * @param string $productId UUID товара
     *
     * @return array Обновлённый массив корзины
     */
    public function delete(string $productId): array
    {
        $cart = collect($this->all())
            ->reject(fn ($item) => $item['product_id'] === $productId)
            ->values()
            ->toArray();

        Session::put($this->sessionKey, $cart);

        return $cart;
    }
}
