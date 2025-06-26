<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Api\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Api\ApiResourceTrait;

/*
 * ProductController отвечает за вывод товаров / товара
*/
class ProductController extends Controller
{
    use ApiResourceTrait;
    public function __construct(protected ProductService $productService)
    {
    }

    public function index(Request $request)
    {
        $filters = $request->only(['price_min', 'price_max']);
        $perPage = $request->input('per_page', 15);

        $products = $this->productService->getAllProducts($filters, $perPage);

        return ProductResource::collection($products)
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        try {
            $product = $this->productService->getById($id);
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse("Товар не найден", 404);
        }
    }
}
