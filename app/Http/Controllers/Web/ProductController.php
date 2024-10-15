<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Product;
use App\Http\Requests\Web\Product\CreateRequest;
use App\Http\Requests\Web\Product\UpdateRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function index(){
        $products = $this->productService->getList();
        return view('products.list', ['products'=> $products]);
    }

    public function show(Product $product){
        return view('products.show', ['product'=> $product]);
    }

    //get page create product
    public function create(){
        return view('products.create');
    }

    //insert product
    public function store(CreateRequest $createRequest){
       $validatedData = $createRequest->validated();
       $result = $this->productService->create($validatedData);

       if ($result) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
        }

        return response()->api_error('create error');
    }

    //get page edit product
    public function edit(Product $product){
        return view('products.edit', ['product' => $product]);
    }

    //update product
    public function update(UpdateRequest $updateRequest, Product $product){
        $validatedData = $updateRequest->validated();
        $result = $this->productService->update($product, $validatedData);
 
        if ($result) {
             return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
         }
 
         return response()->api_error('create error');
     }

     //delete product
     public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Error deleting product');
        }
    }
}
