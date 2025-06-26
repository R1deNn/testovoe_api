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
     * @param array $filters Массив с фильтрами
     * @return \Illuminate\Pagination\LengthAwarePaginator Пагинированный список продуктов
     */
    public function getAllProducts(array $filters = [], int $perPage): LengthAwarePaginator
    {
        $query = Product::query();

        if (!empty($filters['price_min'])) {
            $query->where('price', '>=', $filters['price_min']);
        }

        if (!empty($filters['price_max'])) {
            $query->where('price', '<=', $filters['price_max']);
        }

        return $query->paginate($perPage);
    }

    /**
     * Получить продукт по его ID.
     *
     * @param string $id UUID продукта
     *
     */
    public function getById(string $id)
    {
        return Product::findOrFail($id);
    }

}
