<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;

class ProductReviewController extends Controller
{
    public function listReviewProduct(Request $request){
        $data = ProductReview::where("product_id",$request->id)
        ->with(["profile" => function($query){
            $query->select("id","cus_name");
        }])->get();
        return ResponseHelper::output("success",$data,200);
    }

    public function createProductReview(Request $request){
        $userId = $request->header("id");
        $profile = CustomerProfile::where("user_id", $userId)->first();
        if($profile){
            $request->merge(["customer_id" => $profile->id]);
            $data = ProductReview::updateOrCreate(
                ["customer_id" => $profile->id, "product_id" => $request->input("product_id")],
                $request->input()
            );
            return ResponseHelper::output("success",$data,200);
        }
        else{
            return ResponseHelper::output("Fail","Please Create Your Profile!",200);
        }
    }
}
