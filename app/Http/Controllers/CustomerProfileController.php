<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function profilePage(){
        return view('pages.profile-page');
    }

    public function CreateProfile(Request $request){
        $userId = $request->header("id");
        $request->merge(["user_id" => $userId]);
        $data = CustomerProfile::updateOrCreate(
            ["user_id" => $userId],
            $request->input()
        );
        return ResponseHelper::output("success",$data,200);
    }

    public function ReadProfile(Request $request){
        $userID = $request->header("id");
        $data = CustomerProfile::where("user_id", $userID)->with("user")->get();
        return ResponseHelper::output("success",$data,200);
    }
}
