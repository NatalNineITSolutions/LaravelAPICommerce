<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;


class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users']);

        // Check if a token already exists for this email
        $existingToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if ($existingToken) {
            // Token already exists, handle the situation accordingly
            return response()->json(['message' => 'Password reset link already sent'], 400);
        }

        // Generate a new token
        $token = Str::random(64);

        // Insert the token into the database
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Send the email with the token
        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return response()->json(['message' => 'Password reset link sent successfully']);
    }
}