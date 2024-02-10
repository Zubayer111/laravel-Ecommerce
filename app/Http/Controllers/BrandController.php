<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function brandList(){
        $data = Brand::all();
        return ResponseHelper::output("success", $data,200);
    }
}
