<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSlider;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;

class ProductSliderController extends Controller
{
    public function listProductSlder(){
        $data = ProductSlider::all();
        return ResponseHelper::output("success",$data,200);
    }
}
