<?php

namespace App\Http\Controllers\Web\Auth;

use App\Exceptions\ResponseException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignOutController extends Controller
{
    /**
     * Sign-out the specified account.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        try {
            Auth::logout();

            return redirect()->route('signIn');
        }catch(ResponseException $error) {
            return back();
        }
    }
}
