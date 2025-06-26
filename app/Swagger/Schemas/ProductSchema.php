<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="ProductResource",
 *     type="object",
 *     title="Product",
 *     @OA\Property(property="id", type="string", format="uuid"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="sku", type="string"),
 *     @OA\Property(property="price", type="number", format="float"),
 *     @OA\Property(property="in_stock", type="boolean"),
 *     @OA\Property(property="min_qty", type="integer"),
 *     @OA\Property(property="weight", type="number", format="float"),
 *     @OA\Property(property="volume", type="number", format="float")
 * )
 */
class ProductSchema
{
    // Пустой класс — аннотация важна
}
