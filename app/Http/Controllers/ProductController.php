<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;


class ProductController extends Controller
{
    protected $ProductService;

    public function __construct(ProductService $ProductService)
    {
        $this->ProductService = $ProductService;
    }
    
    // 新增
    public function createProduct(Request $request)
    {
        $prodRespone = $this->ProductService->createProduct($request);
        
        return $prodRespone;
    }

    // 搜尋產品種類
    public function getProduct(Request $request)
    {
        $category_id = $request->category_id;
        
        $prodRespone = $this->ProductService->getProduct($category_id);
        
        return $prodRespone;

    }
    
    // 結帳
    public function checkout(Request $request)
    {
        $request = $request->all();
        
        $prodRespone = $this->ProductService->checkout($request);
        
        return $prodRespone;

    }

    // 訂單資訊
    public function orderList(Request $request)
    {
        $user_id = $request->user_id;

        $orderListRespone = $this->ProductService->orderList($user_id);
        
        return $orderListRespone;
    }
}