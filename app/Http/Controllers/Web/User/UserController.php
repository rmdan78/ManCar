<?php

namespace App\Http\Controllers\Web\User;

use App\Exceptions\ResponseException;
use App\Helpers\{CollectionHelper, StorageHelper, UsernameHelper};
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\{IndexRequest, CreateRequest, EditRequest};
use App\Models\User\{Role, User};
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Hash};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexRequest $request)
    {
        $search = $request->search;
        $users = User::with(['roles'])
            ->when(boolval($search), fn($query) => (
                $query->where('name', 'LIKE', "%$search%")
            ))
            ->withTrashed()
            ->get();

        return view('pages.users.index', compact([
            'users'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateRequest $request)
    {
        $roles = Role::oldest()->get();

        return view('pages.users.create.index', compact([
            'roles',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try{
            $profilePicture = $request->file('profilePicture');
            $role = Role::findOrFail($request->role_id);

            $user = User::create([
                'name'          => $request->name,
                'employee_id'   => $request->employee_id,
                'username'      => UsernameHelper::fromEmail($request->email),
                'email'         => $request->email,
                'password'      => Hash::make('password'),
            ]);

            $user->roles()->attach($role->id);

            if($profilePicture = $request->file('profilePicture')) {
                if(!$profilePicture->isReadable())
                    throw new ErrorException('Profile Picture is unreadable', 422);

                $user->profilePicture()->create([
                    'uri' => StorageHelper::putPublic('/users/profilePictures', $profilePicture),
                ]);
            }

            return back()
                ->with('success', 'Successfully created user');
        }catch(\Exception $err) {
            return back()
                ->withInput()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditRequest $request, string $userId)
    {
        $user = User::with(['profilePicture', 'roles'])->withTrashed()->findOrFail($userId);
        $roles = Role::oldest()->get();

        return view('pages.users.edit.index', compact([
            'user',
            'roles',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $userId)
    {
        try {
            $user = User::with(['profilePicture'])->withTrashed()->findOrFail($userId);
            $data = CollectionHelper::getOrOld($request, $user);
            $role = Role::findOrFail($request->role_id);

            if($data) $data = $data->only([
                'name',
                'employee_id',
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
            $user->roles()->sync($role->id);

            return back()
                ->with('success', 'Successfully edited user');
        } catch(\Exception $err) {
            return back()
                ->withInput()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param string $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $userId)
    {
        try{
            $user = User::findOrFail($userId);
            $user->delete();

            return back();
        }catch(\Exception $err) {
            return back()
                ->withErrors(['error' => $err->getMessage()]);
        }
    }


    /**
     * Disables the specified list resource from storage.
     */
    public function disables(Request $request)
    {
        try {
            $userIds = $request->userIds;
            $users = User::whereIn('id', $userIds)->get();

            $users->each(function($user) {
                DB::beginTransaction();

                $user->update([
                    'deleted_at' => now(),
                ]);

                DB::commit();
            });

            return back()
                ->with('success', 'Successfully disabled users');
        } catch(\Exception $err) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => $err->getMessage()])
                ->withInput();
        }
    }


    /**
     * Recovers the specified list resource from storage.
     */
    public function recovers(Request $request)
    {
        try {
            $userIds = $request->userIds;
            $users = User::whereIn('id', $userIds)
                ->withTrashed()
                ->get();

            $users->each(function($user) {
                DB::beginTransaction();

                $user->update([
                    'deleted_at' => null,
                ]);

                DB::commit();
            });

            return back()
                ->with('success', 'Successfully disabled users');
        } catch(\Exception $err) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => $err->getMessage()])
                ->withInput();
        }
    }
}
