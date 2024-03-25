<?php

namespace App\Http\Controllers\API;

use App\Mail\Websitemail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Stripe\Stripe;
use App\Models\Package;
use App\Models\Subscription;
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
            //'unit_amount' => 'required|integer|min:1',
            'product_name' => 'required|string',
            'duration' => ['required', 'string', Rule::in(['monthly', 'yearly'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $duration = $request->input('duration');

           if ($duration === 'monthly') {
               $price = 'monthly_price';
           } elseif ($duration === 'yearly') {
               $price = 'yearly_price'; 
            }
        $user = User::find($id);
        // Check if the user exists
        if ($user->name !== $request->input('user_name')) {
            return response()->json(['message' => 'Invalid user'], 422);
        }

        $productName = $request->input('product_name');

        // Load Stripe library
       require_once(base_path('vendor/autoload.php'));

       $stripe_secret_key = Gateway::where('title', 'Stripe')->value('key');
       $success_url = Package::where('name', $productName)->value('success_link');
       $cancel_url = Package::where('name', $productName)->value('cancel_link');
       $unitAmount = Package::where('name', $productName)->value($price)* 100;

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

        $this->storeSubscription($id,$productName,$duration);
        return response()->json(['checkout_url' => $checkout_session->url]);

        //4000003560000008 indian creditcard number to check stripe payment;
    }


    public function storeSubscription($id,$productName,$duration)
    {
        // Fetch user information based on the provided ID
        $user = User::findOrFail($id);
        $pack = Package::where('name', $productName)->firstOrFail();
        $endDate = ($duration === 'monthly') ? Carbon::now()->addDays(30) : Carbon::now()->addDays(365);

        // Create a new subscription record
        $subscription = new subscription();
        $subscription->user_id = $user->id;
        $subscription->plan_id = $pack->id;
        $subscription->duration = $duration;
        //$subscription->start_date = now(); // Assuming current date and time
        $subscription->start_date = Carbon::now();
        $subscription->end_date = $endDate;
        $subscription->save();

        Log::info('Store Subscription function executed ');

    }


public function paymentResponse(Request $request, $id)
{

   $email = user::where('id', $id)->value('email');
   Log::info('the email of the user is '.$email);


    $latestSubscription = Subscription::where('user_id', $id)
        ->latest('created_at')
        ->first();

    if ($latestSubscription) {
        $validator = Validator::make($request->all(), [
            'subscription_id' => 'required|string|unique:subscriptions,subscription_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $subscriptionId = $request->input('subscription_id');

        $latestSubscription->update([
            'status' => '1',
            'subscription_id' => $subscriptionId,
        ]);
        $this->sendmail($email);

       Log::info('subscription id saved for '.$email);

        //return $response->status();


    } else {
        Log::info('Non-Subscriber with ID: ' . $id . ' reached success page');
    }

}

    public function sendmail($email)
    {    
        $subject = 'Subscription Confirmation';
       $view = view('emails.welcome_email');
       $message = 'Please click on the following link in order to verify as subscriber:<br><br>';
        


        $message .= $view;

       \Mail::to($email)->send(new Websitemail($subject,$message));

    }
 



}
