<?php

namespace App\Http\Controllers;

use App\Models\ProductWishe;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;

class ProductWisheController extends Controller
{
    public function productWishList(Request $request){
        $userId=$request->header("id");
        $data= ProductWishe::where("user_id",$userId)->with("product")->get();
        return ResponseHelper::output("success",$data,200);
    }

    public function createWishList(Request $request){
        $userId = $request->header("id");
        $data = ProductWishe::updateOrCreate(
            ["user_id" => $userId, "product_id" => $request->product_id],
            //["user_id" => $userId, "product_id" => $request->product_id],
        );
        return ResponseHelper::output("success",$data,200);
    }

    public function removeWishList(Request $request){
        $userId = $request->header("id");
        $data = ProductWishe::where(["user_id" => $userId, "product_id" => $request->product_id])->delete();
        return ResponseHelper::output("success", $data, 200);
    }
    
}
