<?php

namespace App\Services\Api;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class ProductService
{
    /**
     * Получить все продукты с пагинацией.
     *
     * @param int $perPage Количество элементов на странице
     * @return \Illuminate\Pagination\LengthAwarePaginator Пагинированный список продуктов
     */
    public function getAllProducts(int $perPage): LengthAwarePaginator
    {
        return Product::query()->paginate($perPage);
    }

    /**
     * Получить продукт по его ID.
     *
     * @param string $id UUID продукта
     * @return \Illuminate\Http\JsonResponse Найденный продукт
     *
     */
    public function getById(string $id)
    {
        return Product::findOrFail($id);
    }

}
