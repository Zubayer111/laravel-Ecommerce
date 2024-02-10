<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryPage(){
        return view("pages.product-by-category");
    }
    public function categoryList(){
        $data = Category::all();
        return ResponseHelper::output("success",$data,200);
    }
}
