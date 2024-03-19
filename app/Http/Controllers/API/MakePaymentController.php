<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Stripe\Stripe;
use App\Models\Package;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Gateway;


class MakePaymentController extends Controller
{
    public function makePayment(Request $request, $id)
    {
        // Validate the incoming user name 
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string',
            'unit_amount' => 'required|integer|min:1',
            'product_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
                // Retrieve data from the request
                $unitAmount = $request->input('unit_amount') * 100;
                $productName = $request->input('product_name');

               // $keyValue = Gateway::value('key');

        // Load Stripe library
        require_once(base_path('vendor/autoload.php'));

       $stripe_secret_key = Gateway::where('title', 'Stripe')->value('key');
       $success_url = Package::where('name', $productName)->value('success_link');
       $cancel_url = Package::where('name', $productName)->value('cancel_link');

       Stripe::setApiKey($stripe_secret_key);

        $checkout_session = Session::create([
            "mode" => "payment",
            "success_url" => $success_url,
            "cancel_url" =>  $cancel_url,
            "locale" => "auto",
            "billing_address_collection"=> "required",
            "currency"=>"inr",


            "line_items" => [
                [
                    "quantity" => '1',
                    "price_data" => [
                        "currency" => "inr",
                        "unit_amount" => $unitAmount,
                        "product_data" => [
                            "name" => $productName
                        ]
                    ]
                ],
            ]
        ]);
        return response()->json(['checkout_url' => $checkout_session->url]);

        //4000003560000008 indian creditcard number to check stripe payment;
    }

    public function paymentSuccess(Request $request)
    {
        dd('Payment success method called.');

            // Fetch the package with id 18
            $package = Package::find(18);
        
            // Check if the package exists
            if (!$package) {
                return response()->json(['error' => 'Package not found'], 404);
            }
        
            // Log all data received from the request
            Log::info('Data received from the request:', $request->all());
            Log::info('Cancel Link is: ' . $request->input('cancel_link'));

            // Get the cancel URL from the package
            $cancelUrl = $package->cancel_url;
        
            // Return the cancel URL
            return $cancelUrl;
        
        
    
    }
}
