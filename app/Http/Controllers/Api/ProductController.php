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
        $perPage = $request->input('per_page', 20);
        $products = $this->productService->getAllProducts($perPage);
        return ProductResource::collection($products);
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
