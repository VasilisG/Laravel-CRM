<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index(Request $request){

        $clients = [];
        if($request->has('search')){
            $queryValue = $request->input('search');
            $clients = Client::query();
            foreach(Client::searchableFields() as $index => $attribute) {
                $clients = $index == 0 
                ? $clients->where($attribute, 'LIKE', '%' . $queryValue . '%')
                : $clients->orWhere($attribute, 'LIKE', '%' . $queryValue . '%');
            }
            $clients = $clients->paginate(config('constants.PAGE_LIMIT'));
        }
        else {
            $clients = Client::paginate(config('constants.PAGE_LIMIT'));
        }
        return view('client.index', ['clients' => $clients]);
    }

    public function create(){
        return view('client.form', [
            'type' => 'create',
            'client' => null
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),
            [
                'company' => ['required', 'unique:clients', 'max:255'],
                'vat'     => ['required', 'unique:clients', 'max:255'],
                'email'   => ['required', 'email:filter'],
                'phone'   => ['required', 'max:15']
            ]
        );

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput($request->all());
        }

        $active = $request->has('active') ? $request->get('active') : 0;
        if($active == 'on') $active = 1;
        if($active == 'off') $active = 0;

        Client::create([
            'company' => $request->get('company'),
            'vat'     => $request->get('vat'),
            'email'   => $request->get('email'),
            'phone'   => $request->get('phone'),
            'address' => $request->get('address'),
            'active'  => $active
        ]);

        return redirect()
        ->route('clients.index')
        ->with('success', 'Client successfully created.');
    }

    public function edit($id){

        $client = Client::find($id);

        if(!$client) {
            return redirect()
            ->route('clients.index')
            ->with('error', 'Could not find entity with ID: ' . $id);
        }

        return view('client.form', [
            'type' => 'update',
            'client' => $client
        ]);
    }

    public function update(Request $request, $id){

        $client = Client::find($id);

        if($client) {

            $validator = Validator::make($request->all(),
                [
                    'company' => ['required', 'max:255', Rule::unique('clients')->ignore($client)],
                    'vat'     => ['required', 'max:255', Rule::unique('clients')->ignore($client)],
                    'email'   => ['required', 'email:filter'],
                    'phone'   => ['required', 'max:15']
                ]
            );

            if($validator->fails()){
                return back()
                    ->withErrors($validator)
                    ->withInput($request->all());
            }

            $active = $request->has('active') ? $request->get('active') : 0;
            if($active == 'on') $active = 1;
            if($active == 'off') $active = 0;

            $client->update([
                'company' => $request->get('company'),
                'vat'     => $request->get('vat'),
                'email'   => $request->get('email'),
                'phone'   => $request->get('phone'),
                'address' => $request->get('address'),
                'active'  => $active
            ]);

            return redirect()
                ->route('clients.index')
                ->with('success', 'Client successfully updated.');
        }

        else return redirect()
            ->route('clients.index')
            ->with('error', 'Could not update client. Client not found.');
    }

    public function destroy($id){

        $client = Client::find($id);

        if($client) {

            $client->delete();

            return redirect()
                ->route('clients.index')
                ->with('success', 'Client successfully deleted.');
        }

        else return back()->with('error', 'Could not delete client.');
    }
}
