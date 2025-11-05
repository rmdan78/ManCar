<?php

namespace App\Http\Controllers\Web\Auth;

use App\Exceptions\ResponseException;
use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    /**
     * Sign-in view Handler
     * * @return \Illuminate\View\View
     */
    public function index() :View
    {
        return view('pages.auth.signIn.index');
    }

    /**
     * Sign-in data store handler
     * * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) :RedirectResponse
    {
        try {
            $username   = $request->username;
            $password   = $request->password;

            $credentials_employee = ['employee_id' => $username, 'password' => $password];
            $credentials_username = ['username' => $username, 'password' => $password];

            if (!Auth::attempt($credentials_employee) && !Auth::attempt($credentials_username)) {
                throw new ResponseException('Account did not match', 404);
            }
            $user = Auth::user();
            $user->load('roles');
            
            session()->put('user', $user);
            $request->session()->regenerate();

            return redirect()->route('dashboard');

        } catch(ResponseException $err) {
            return back()
                ->withErrors(['error' => 'Kombinasi username/password salah.'])
                ->withInput($request->only('username')); 
        }
    }
}

