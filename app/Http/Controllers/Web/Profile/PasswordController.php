<?php

namespace App\Http\Controllers\Web\Profile;

use App\Exceptions\ResponseException;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit(Request $request) {
        $user = session('user');

        return view('pages.profile.password.edit.index', compact(
            'user',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        try{
            $user = User::findOrFail(auth()->id());
            $oldPassword = $request->old_password;
            $newPassword = $request->new_password;

            if(!Hash::check($oldPassword, $user->password))
                throw new ResponseException('Old password didn\'t match');

            $user->update([
                'password'  => Hash::make($newPassword),
            ]);

            return back()
                ->with('success', 'Successfully changed password');
        } catch(\Exception $err) {
            return back()
                ->withInput()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }
}
