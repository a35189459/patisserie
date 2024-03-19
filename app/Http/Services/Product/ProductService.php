<?php

namespace App\Http\Services\Product;

use App\Http\Repositories\Product\ProductRepo;

class ProductService
{
    
    protected $ProductRepo;

    // 在建構函式中注入服務和儲存庫
    public function __construct(ProductRepo $ProductRepo)
    {
        $this->ProductRepo = $ProductRepo;
    }

    // 新增產品
    public function createProduct($request)
    {
        $prodRespone = $this->ProductRepo->createProduct($request);

        return $prodRespone;
    }

    // 查詢品項
    public function getProduct($category_id)
    {
        $prodRespone = $this->ProductRepo->getProduct($category_id);

        return $prodRespone;
    }
    
    // 結帳
    public function checkout($request)
    {
        $prodRespone = $this->ProductRepo->checkout($request);

        return $prodRespone;
    }

    // 訂單資訊
    public function orderList($user_id)
    {
        $orderListRespone = $this->ProductRepo->orderList($user_id);
        
        $order_items_collection = collect($orderListRespone);

        // 按照訂單ID進行分組並整理訂單資訊
        $result = $order_items_collection->groupBy('order_id')->map(function ($item) {
            return [
                'order_id' => $item->first()['order_id'],
                'order_items' => $item->all(),
            ];
        })->values();

        return $result;
    }
}