<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\Api\ProductService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="Работа с товарами"
 * )
 */
class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Получить список товаров",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Номер страницы для пагинации",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список товаров",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ProductResource"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 15);
        $products = $this->productService->getAllProducts((int)$perPage);

        return ProductResource::collection($products);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Получить данные одного товара",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="UUID товара",
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Данные товара",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Товар не найден"
     *     )
     * )
     */
    public function show(string $id)
    {
        $product = $this->productService->getById($id);

        return new ProductResource($product);
    }
}
