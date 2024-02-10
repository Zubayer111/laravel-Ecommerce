<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Helper\SSLCommerz;
use App\Models\CustomerProfile;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\ProductCart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoiceCreate(Request $request){
        DB::beginTransaction();
        try{
            $userId = $request->header("id");
            $userEmail = $request->header("email");
            
            $tran_id = uniqid();
            $delivery_status = "Pending";
            $payment_status = "Pending";
            
            $profile = CustomerProfile::where("user_id", $userId)->first();
            $cus_details = "Name:$profile->cus_name,Address:$profile->cus_add,City:$profile->cus_city,Phone:$profile->cus_phone";
            $ship_details = "Name:$profile->ship_name,Address:$profile->ship_add,City:$profile->ship_city,Phone:$profile->ship_phone";

            $total = 0;
            $cartList = ProductCart::where("user_id", $userId)->get();
            foreach($cartList as $cartItem){
                $total = $total+$cartItem->price;
            }

            $vat = ($total*3)/100;
            $payable = $vat+$total;

            $invoice = Invoice::create([
                "total" => $total,
                "vat" => $vat,
                "payable" => $payable,
                "cus_details" => $cus_details,
                "ship_details" => $ship_details,
                "tran_id"=>$tran_id,
                "delivery_status" => $delivery_status,
                "payment_status" => $payment_status,
                "user_id" => $userId,
            ]);
            
            $invoiceId = $invoice->id;
            
            foreach($cartList as $EachProduct){
                InvoiceProduct::create([
                    "invoice_id" => $invoiceId,
                    "product_id" => $EachProduct["product_id"],
                    "user_id" => $userId,
                    "qty" => $EachProduct["qty"],
                    "sale_price" => $EachProduct["price"],
                ]);
            }
            
            $paymentMethod = SSLCommerz::InitiatePayment($profile,$payable,$tran_id,$userEmail);
            DB::commit();
            return ResponseHelper::output("success", ["paymentMethod" => $paymentMethod, "payable" => $payable, "vat" => $vat, "total" => $total], 200);
        }
        catch(Exception $e){
            DB::rollBack();
            return ResponseHelper::output("Fail",$e,200);
        }
    }

    public function invoiceList(Request $request){
        $userId = $request->header("id");
        $invoiceList = Invoice::where("user_id", $userId)->get();
        return ResponseHelper::output("success", $invoiceList, 200);
    }

    public function invoiceDetail(Request $request){
        $userId=$request->header("id");
        $invoiceId=$request->invoice_id;
        return InvoiceProduct::where(["user_id"=>$userId,"invoice_id"=>$invoiceId])->with("product")->get();
    }

    public function paymentSuccess(Request $request){
        SSLCommerz::InitiateSuccess($request->query("tran_id"));
        return redirect("/profile");
    }

    public function paymentFail(Request $request){
        return SSLCommerz::InitiateFail($request->query("tran_id"));
        return redirect("/profile");
    }

    public function paymentIPN(Request $request){
        return SSLCommerz::InitiateIPN($request->input("tran_id"),$request->input("status"),$request->input("val_id"));
    }

    function paymentCancel(Request $request){
        SSLCommerz::InitiateCancel($request->query("tran_id"));
        return redirect("/profile");
    }
}
