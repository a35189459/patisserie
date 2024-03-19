<?php

namespace App\Http\Repositories\Product;

use App\Models\Product;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\ProdCategories;
use Illuminate\Config\Repository;


class ProductRepo extends Repository
{
    // 新增產品
    public function createProduct($request)
    {
        // 檢查請求中是否提供了有效的 category_id
        $category = ProdCategories::find($request->category_id);
        if (!$category) {
            return response()->json(['message' => '無效的分類 ID'], 400);
        }
        
        $product = Product::create([
            'prod_name' => $request->prod_name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' =>$request->category_id,
            'image_url' => $request->image_url,
        ]);

        return response()->json(['message' => '新增成功', 'data' => $product], 201);
    }

    // 查詢品項
    public function getProduct($category_id)
    {
        $product = Product::where('category_id',$category_id)->get();
        
        return $product;
    }
    
    // 結帳
    public function checkout($request)
    {
        $orders = Orders::create([
            'user_id' => $request['user_id'],
            'user_name' => $request['user_name'],
            'user_phone' => $request['user_phone'],
            'user_email' => $request['user_email'],
            'payment_method' =>$request['payment_method'],
            'notes' => $request['notes'],
            'total_quantity' => $request['total_quantity'],
            'amount' => $request['amount'],
            'created_at' => now(),
        ]);
        $order_id = $orders->order_id;
        
        foreach ($request['items'] as $i) {
            $order_item = OrderItems::create([
                'order_id'=>$order_id,
                'product_id' => $i['id'],
                'product_name' => $i['name'],
                'price' => $i['price'],
                'quantity' => $i['quantity'],
                'total_price' => $i['totalPrice'],
            ]);
        }
        
        return response()->json(['message' => '訂單送出成功'], 201);
    }

    // 訂單資訊
    public function orderList($user_id)
    {
        $orders = Orders::where('user_id', $user_id)->get();
        $order_id = [];
        foreach($orders as $order){
            $order_id[] = $order->order_id;
        }
        
        $order_items = OrderItems::whereIn('order_id', $order_id)->orderBy('order_id','desc')->get();
        
        return $order_items;
    }
}