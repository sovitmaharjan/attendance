<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordMailRequest;
use App\Mail\ResetPasswordMail;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view("auth.forgot-password");
    }

    public function sendResetPasswordMail(ResetPasswordMailRequest $request)
    {
        DB::beginTransaction();
        try {
            DB::table("password_resets")->where(["email" => $request->email])->delete();
            $token = Str::random(64);
            DB::table("password_resets")->insert([
                "email" => $request->email,
                "token" => $token,
                "created_at" => now()
            ]);
            Mail::to($request->email)->send(new ResetPasswordMail($request->email, $token));
            DB::commit();
            return redirect("login")->with("success", "Reset password mail has been sent. Check your mail.");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }
}
