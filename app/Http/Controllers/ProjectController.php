<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request){
        $projects = [];
        if($request->has('search')){
            $queryValue = $request->input('search');
            $projects = Project::query();
            foreach(Project::searchableFields() as $index => $attribute) {
                $projects = $index == 0 
                ? $projects->where($attribute, 'LIKE', '%' . $queryValue . '%')
                : $projects->orWhere($attribute, 'LIKE', '%' . $queryValue . '%');
            }
            $projects = $projects->paginate(config('constants.PAGE_LIMIT'));
        }
        else {
            $projects = Project::paginate(config('constants.PAGE_LIMIT'));
        }
        return view('project.index', ['projects' => $projects]);
    }

    public function create(){

        $clients = Client::pluck('company', 'id')->all();

        return view('project.form', [
            'type' => 'create',
            'project' => null,
            'clients' => $clients
        ]);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),
            [
                'title'  => ['required', 'max:255'],
                'status' => ['required']
            ]
        );

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput($request->all());
        }

        $title       = $request->get('title');
        $description = $request->get('description') ?? '';
        $deadline    = $request->get('deadline') ?? Carbon::now()->format('d M Y');
        $status      = $request->get('status');
        $cost        = $request->get('cost') ?? 0;

        $clientID = $request->get('client');

        $client = Client::find($clientID);

        if(!$client) {
            return back()
            ->with('error', 'Could not find client with ID: ' . $clientID);
        }

        $savedProject = Project::create([
            'title'       => $title,
            'description' => $description,
            'deadline'    => $deadline,
            'status'      => $status,
            'cost'        => $cost,
        ]);

        $savedProject->client()->associate($client);
        $savedProject->save();

        return redirect()
        ->route('projects.index')
        ->with('success', 'Project successfully created for client: ' . $client->company);
    }

    public function edit($id){

        $project = Project::find($id);

        $clients = Client::pluck('company', 'id')->all();

        if(!$project) {
            return redirect()
            ->route('projects.index')
            ->with('error', 'Could not find entity with ID: ' . $id);
        }

        return view('project.form', [
            'type' => 'update',
            'project' => $project,
            'clients' => $clients
        ]);

    }

    public function update(Request $request, $id){

        $project = Project::find($id);

        if($project) {

            $validator = Validator::make($request->all(),
                [
                    'title'  => ['required', 'max:255'],
                    'status' => ['required']
                ]
            );

            if($validator->fails()){
                return back()
                ->withErrors($validator)
                ->withInput($request->all());
            }

            $title       = $request->get('title');
            $description = $request->get('description') ?? '';
            $deadline    = $request->get('deadline') ?? Carbon::now()->format('d M Y');
            $status      = $request->get('status');
            $cost        = $request->get('cost') ?? 0;

            $clientID = $request->get('client');

            $client = Client::find($clientID);

            if(!$client) {
                return back()
                ->with('error', 'Could not find client with ID: ' . $clientID);
            }

            $project->update([
                'title'       => $title,
                'description' => $description,
                'deadline'    => $deadline,
                'status'      => $status,
                'cost'        => $cost,
            ]);

            $project->client()->associate($client);
            $project->save();

            return redirect()
                ->route('projects.index')
                ->with('success', 'Project successfully updated.');

        }

        else return redirect()
            ->route('projects.index')
            ->with('error', 'Could not update project. Project not found.');

    }

    public function destroy($id){

        $project = Project::find($id);

        if($project) {

            $project->delete();

            return redirect()
                ->route('projects.index')
                ->with('success', 'Project successfully deleted.');
        }

        else return back()->with('error', 'Could not delete project.');
    }
}
