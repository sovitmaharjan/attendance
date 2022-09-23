<?php

namespace App\Methods;

use Illuminate\Support\Facades\Auth;

trait AdminMethods {
    public function view($path, $obj = [])
    {
        $user = Auth::user();
        return view($path, array_merge($obj, [
            'user' => $user,
        ]));
    }

    public function sendDbError($errorMessage)
    {
        return response()->json(['db_error' => $errorMessage]);
    }

    public function successMsgAndRedirect($msg, $redirectRoute)
    {
        return response()->json(['msg' => $msg, 'redirectRoute' => route($redirectRoute)]);
    }
}
