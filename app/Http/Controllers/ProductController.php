<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductSlider;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function wishPage(){
        return view('pages.wish-list-page');
    }

    public function cartPage(){
        return view('pages.cart-list-page');
    }
    public function Details(){
        return view('pages.details-page');
    }
    public function listProductByCatagory(Request $request){
        $data = Product::where("category_id", $request->id)->with("category","brand")->get();
        return ResponseHelper::output("success",$data,200);
    }
    public function listProductByRemark(Request $request){
        $data = Product::where("remark", $request->remark)->with("category", "brand")->get();
        return ResponseHelper::output("success",$data,200);
    }
    public function listProductByBrand(Request $request){
        $data = Product::where("brand_id", $request->id)->with("category", "brand")->get();
        return ResponseHelper::output("success",$data,200);
    }
    
    
    public function productListByKeyWord(Request $request){
        
    }
}
