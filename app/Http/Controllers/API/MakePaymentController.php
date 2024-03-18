<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Stripe\Stripe;
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
            'quantity' => 'required|integer|min:1',
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
                $quantity = $request->input('quantity');
                $unitAmount = $request->input('unit_amount');
                $productName = $request->input('product_name');

               // $keyValue = Gateway::value('key');

        // Load Stripe library
        require_once(base_path('vendor/autoload.php'));

       $stripe_secret_key = Gateway::where('title', 'Stripe')->value('key');

        Stripe::setApiKey($stripe_secret_key);

        $checkout_session = Session::create([
            "mode" => "payment",
            "success_url" => route('admin.customer.list'),
            "cancel_url" =>  route('admin.customer.list'),
            "locale" => "auto",
            "billing_address_collection"=> "required",
            "currency"=>"inr",


            "line_items" => [
                [
                    "quantity" => $quantity,
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

    
}
