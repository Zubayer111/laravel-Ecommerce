<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;

class ProductDetailController extends Controller
{
    public function productDetailById(Request $request){
        $data = ProductDetail::where("product_id", $request->id)->with("product","product.category", "product.brand")->get();
        return ResponseHelper::output("success",$data,200);
    }
}
