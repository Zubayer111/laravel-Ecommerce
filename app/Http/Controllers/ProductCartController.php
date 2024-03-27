<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;

class ProductCartController extends Controller
{
    public function createCartList(Request $request){
        try{
            $request->validate([
                "product_id" => "required|exists:products,id",
                "size" => "required",
                "color" => "required",
                "qty" => "required",
            ]);
            $usreId = $request->header("id");
            $productId = $request->input("product_id");
            $size = $request->input("size");
            $color = $request->input("color");
            $qty = $request->input("qty");
            $price = 0;
            
            $product = Product::where("id", "=",$productId)->first();
    
            if($product->discount == 1){
                $price = $product->discount_price; 
            }
            else{
                $price = $product->price;
            }
            $totalPrice = $price * $qty;
            $data = ProductCart::updateOrCreate(
                ["user_id"=>$usreId, "product_id"=>$productId],
                [
                    "user_id"=>$usreId, 
                    "product_id"=>$productId, 
                    "size"=>$size, 
                    "color"=>$color, 
                    "qty"=>$qty, 
                    "price"=>$totalPrice,
                ]
                );
                return ResponseHelper::output("success", "Product Added Successfully", 200);
        }
        catch(Exception $e){
            return ResponseHelper::output("Fail", $e->getMessage(), 200);
        }
    }

    public function cartList(Request $request){
        $usreId = $request->header("id");
        $data = ProductCart::where("user_id", $usreId)->with("product")->get();
        return ResponseHelper::output("success", $data, 200);
    }

    public function deletCartList(Request $request){
        $usreId = $request->header("id");
        $productId = $request->product_id;
        $data = ProductCart::where("user_id", $usreId)->where("product_id", $productId)->delete();
        return ResponseHelper::output("success", $data, 200);
    }
}
