<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function __construct(Product $product)
    {
        // $this->middleware('auth:api');
        $this->productService = new ProductService($product);
    }

    public function index()
    {
        $conditions = [
            'name,category' => $_GET['name'],
            'category' => $_GET['category'],
        ];

        $filter = [
            'sort' => $_GET['sort'],
            'per_page' => $_GET['per_page'],
        ];

        $products = $this->productService->paginate($filter, $conditions);
        return  ProductResource::collection($products);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'        => 'required',
            'category'    => 'required',
            'description' => 'required',
            'date_time'   => 'required|date_format:Y-m-d H:i',
        ]);

        $newProduct = Product::updateOrCreate(
            ['id' => $request->id ? $request->id : null],
            [
                'name'        => $request->name,
                'category'    => $request->category,
                'description' => $request->description,
                'date_time'   => $request->date_time,
            ]
        );

        return $newProduct->id;
    }

    public function show($id)
    {
        return Product::where('id', $id)->first();
    }

    public function destroy($id)
    {
        $deletedProduct = Product::where('id', $id)->delete();
        if ($deletedProduct) {
            return true;
        }
        return false;
    }
}
