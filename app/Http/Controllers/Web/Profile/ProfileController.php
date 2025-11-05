<?php

namespace App\Http\Controllers\Web\Profile;

use App\Exceptions\ResponseException;
use App\Helpers\CollectionHelper;
use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = User::with(['profilePicture', 'roles'])
            ->findOrFail(Auth::id());

        return view('pages.profile.edit.index', compact([
            'user',
        ]));
    }

    /**
     * Update the authed user.
     */
    public function update(Request $request)
    {
        try {
            $user = User::with(['profilePicture'])->findOrFail(Auth::id());
            $data = CollectionHelper::getOrOld($request, $user);

            if($data) $data = $data->only([
                'name',
                'username',
                'email',
            ]);

            if($profilePicture = $request->file('profilePicture')) {
                if(!$profilePicture->isReadable())
                    throw new ResponseException('Profile picture not readable', 422);

                if($oldProfilePicture = $user->profilePicture) {
                    StorageHelper::deletePublic($oldProfilePicture->uri);
                    $oldProfilePicture->delete();
                }

                $profilePicture = $user->profilePicture()->create([
                    'uri' => StorageHelper::putPublic('/users/profilePictures', $profilePicture),
                ]);
            }

            $user->update($data->toArray());

            return back()
                ->with('success', 'Successfully updated profile');
        } catch(\Exception $err) {
            return back()
                ->withInput()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }
}
