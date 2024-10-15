<?php
namespace App\Services;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;
class ProductService {
    protected $product;

    public function __construct(Product $product){
      $this->product = $product;
    }

    public function getList(){
      return $this->product->all();
    }

    public function create($product){
      try {
        return $this->product->create($product);
    } catch (Exception $exception) {
        Log::error($exception);
        return false;
    }
    }

    public function update(Product $product, $params)
    {
        try {
            return $product->update($params);
        } catch (Exception $exception) {
            Log::error($exception);
            return false;
        }
    }

}