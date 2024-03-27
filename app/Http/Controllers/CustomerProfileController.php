<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;

class CustomerProfileController extends Controller
{
    public function profilePage(){
        return view('pages.profile-page');
    }

    public function CreateProfile(Request $request){
        try{
            $request->validate([
                'cus_name' => 'required|string',
                'cus_add' => 'required|string',
                'cus_city' => 'required|string',
                'cus_state' => 'required|string',
                'cus_postcode' => 'required|string',
                'cus_country' => 'required|string',
                'cus_phone' => 'required|string',
                'cus_fax' => 'nullable|string',
                'ship_name' => 'required|string',
                'ship_add' => 'required|string',
                'ship_city' => 'required|string',
                'ship_state' => 'required|string',
                'ship_postcode' => 'required|string',
                'ship_country' => 'required|string',
                'ship_phone' => 'required|string',
            ]);
            $userId = $request->header("id");
            $request->merge(["user_id" => $userId]);
            CustomerProfile::updateOrCreate(
                ["user_id" => $userId],
                $request->input()
            );
            return ResponseHelper::output("success","Profile Created Successfully",200);
        }
        catch(Exception $e){
            return ResponseHelper::output("Fail",$e->getMessage(),200);
        }
    }

    public function ReadProfile(Request $request){
        $userID = $request->header("id");
        $data = CustomerProfile::where("user_id", $userID)->with("user")->first();
        return ResponseHelper::output("success",$data,200);
    }
}
