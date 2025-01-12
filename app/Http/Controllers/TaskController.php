<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(Request $request){
        $tasks = [];
        if($request->has('search')){
            $queryValue = $request->input('search');
            $tasks = Task::query();
            foreach(Task::searchableFields() as $index => $attribute) {
                $tasks = $index == 0 
                ? $tasks->where($attribute, 'LIKE', '%' . $queryValue . '%')
                : $tasks->orWhere($attribute, 'LIKE', '%' . $queryValue . '%');
            }
            $tasks = $tasks->paginate(config('constants.PAGE_LIMIT'));
        }
        else {
            $tasks = Task::paginate(config('constants.PAGE_LIMIT'));
        }
        return view('task.index', ['tasks' => $tasks]);
    }

    public function create(){

        $projects = Project::pluck('title', 'id')->all();

        return view('task.form', [
            'type' => 'create',
            'task' => null,
            'projects' => $projects
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

        $projectID = $request->get('project');

        $project = Project::find($projectID);

        if(!$project) {
            return back()
            ->with('error', 'Could not find project with ID: ' . $projectID);
        }

        $savedTask = Task::create([
            'title'       => $title,
            'description' => $description,
            'deadline'    => $deadline,
            'status'      => $status,
            'cost'        => $cost,
        ]);

        $savedTask->project()->associate($project);
        $savedTask->save();

        return redirect()
        ->route('tasks.index')
        ->with('success', 'Project successfully created for project: ' . $project->title);

    }

    public function edit($id){

        $task = Task::find($id);

        $projects = Project::pluck('title', 'id')->all();

        if(!$task) {
            return redirect()
            ->route('task.index')
            ->with('error', 'Could not find entity with ID: ' . $id);
        }

        return view('task.form', [
            'type' => 'update',
            'task' => $task,
            'projects' => $projects
        ]);
    }

    public function update(Request $request, $id){

        $task = Task::find($id);

        if($task) {

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

            $projectID = $request->get('project');

            $project = Project::find($projectID);

            if(!$project) {
                return back()
                ->with('error', 'Could not find project with ID: ' . $projectID);
            }

            $task->update([
                'title'       => $title,
                'description' => $description,
                'deadline'    => $deadline,
                'status'      => $status,
                'cost'        => $cost,
            ]);

            $task->project()->associate($project);
            $task->save();

            return redirect()
                ->route('tasks.index')
                ->with('success', 'Task successfully updated.');

        }

        else return redirect()
            ->route('tasks.index')
            ->with('error', 'Could not update task. Task not found.');

    }

    public function destroy($id){

        $task = Task::find($id);

        if($task) {

            $task->delete();

            return redirect()
                ->route('tasks.index')
                ->with('success', 'Task successfully deleted.');
        }

        else return back()->with('error', 'Could not delete task.');
    }
}
