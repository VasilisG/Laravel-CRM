<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    public function update(){

    }

    public function destroy(){

    }
}
