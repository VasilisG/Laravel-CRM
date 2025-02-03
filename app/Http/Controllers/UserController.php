<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request){
        $users = [];
        if($request->has('search')){
            $queryValue = $request->input('search');
            $users = User::query();
            foreach(User::searchableFields() as $index => $attribute) {
                $users = $index == 0 
                ? $users->where($attribute, 'LIKE', '%' . $queryValue . '%')
                : $users->orWhere($attribute, 'LIKE', '%' . $queryValue . '%');
            }
            $users = $users->paginate(config('constants.PAGE_LIMIT'));
        }
        else {
            $users = User::paginate(config('constants.PAGE_LIMIT'));
        }
        return view('user.index', ['users' => $users]);
    }

    public function create(){
        return view('user.form', [
            'type' => 'create',
            'user' => null
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),
            [
                'name'                  => ['required', 'max:255'],
                'email'                 => ['required', 'unique:clients', 'email:filter', 'max:255'],
                'password'              => ['required', 'confirmed', Password::defaults()],
                'current-user-password' => ['required', 'sometimes', 'current_password']
            ]
        );

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput($request->all());
        }

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User successfully created.');
    }

    public function edit($id){

        $user = User::find($id);

        if(!$user) {
            return redirect()
            ->route('user.index')
            ->with('error', 'Could not find entity with ID: ' . $id);
        }

        return view('user.form', [
            'type' => 'update',
            'user' => $user
        ]);
    }

    public function update(Request $request, $id){

        $user = User::find($id);

        if($user) {

            $rules = [
                'name'                  => ['required', 'max:255'],
                'email'                 => ['required', 'unique:clients', 'email:filter', 'max:255'],
                'current-user-password' => ['required', 'sometimes', 'current_password']
            ];

            if($request->filled('password')) {
                $rules['password'] = ['required', 'confirmed', Password::defaults()];
            }

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()){
                return back()
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $updateData = [
                'name' => $request['name'],
                'email' => $request['email']
            ];

            if($request->filled('password')){
                $updateData['password'] = Hash::make($request['password']);
            }

            $user->update($updateData);

            return redirect()
                ->route('users.index')
                ->with('success', 'User successfully updated.');
        }

        else return redirect()
                ->route('users.index')
                ->with('error', 'Could not update user. User not found.');

    }

    public function destroy(Request $request, $id){

        $user = User::find($id);

        if($user) {

            $currentUser = Auth::user();

            $user->delete();

            if($id === $currentUser->id){

                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->route('login');
            }

            else return redirect()
                        ->route('users.index')
                        ->with('success', 'User successfully deleted.');
        }

        else return redirect()
                    ->route('users.index')
                    ->with('error', 'Could not delete user, User not found.');
    }
}
