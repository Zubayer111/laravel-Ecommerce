<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Mail\OtpMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function LoginPage(){
        return view('pages.login-page');
    }

    public function VerifyPage(){
        return view('pages.verify-page');
    }
    public function userLogin(Request $request){
        try{
            $userEmail = $request->email;
            $otp = rand(100000,999999);
            $details = ['code' => $otp];
            Mail::to($userEmail)->send(new OtpMail($details));
            User::updateOrCreate(["email"=>$userEmail],["email"=>$userEmail, "otp"=>$otp]);
            return ResponseHelper::output("success","A 6 Digit OTP has been send to your email address",200);
        }
        catch(Exception $e){
            return ResponseHelper::output("Fail", $e,200);
        }
    }

    public function verifyLogin(Request $request){
       $userEmail = $request->email;
       $otp = $request->otp;
       $user = User::where("email", $userEmail)->where("otp", $otp)->first();

       if($user){
        User::where("email", $userEmail)->where("otp", $otp)->update(["otp"=>0]);
        $token = JWTToken::CreateToken($userEmail,$user->id);
        return ResponseHelper::output("success", "", 200)->cookie("Token", $token,60*24*30);
       }
       else{
        return ResponseHelper::output("Fail", null, 4001);
       }
    }

    public function userLogOut(){
        return redirect('/')->cookie('Token','',-1);
    }
    
    
}
