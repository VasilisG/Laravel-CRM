<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke() {

        $clients = $this->getClientsData();
        $projects = $this->getEntityData('projects');
        $tasks = $this->getEntityData('tasks');

        $projectsAtRisk = $this->getEntityAtRisk(Project::class);
        $tasksAtRisk = $this->getEntityAtRisk(Task::class);

        return view('dashboard', [
            'clients' => $clients,
            'projects' => $projects,
            'tasks' => $tasks,
            'projects_at_risk' => $projectsAtRisk,
            'tasks_at_risk' => $tasksAtRisk
        ]);
    }

    private function getClientsData(){
        $clients = DB::table('clients')
            ->selectRaw('count(id) as clientCount')
            ->groupBy('active')
            ->get();
        
        return [
            'total' => [
                'label' => 'Totals',
                'value' => $clients->sum(function($elem){return $elem->clientCount;}),
                'style' => 'text-center flex-none flex justify-center w-[30px]'
            ],
            'items' => [
                [
                    'label' => 'Active',
                    'value' => $clients[0]->clientCount,
                    'style' => 'bg-sky-100 text-sky-600 text-center flex-none flex justify-center w-[30px]',
                ],
                [
                    'label' => 'Inactive',
                    'value' => $clients[1]->clientCount,
                    'style' => 'bg-rose-100 text-rose-600 text-center flex-none flex justify-center w-[30px]',
                ]
            ]
        ];
    }

    private function getEntityData($table) {
        $entities = DB::table($table)
        ->selectRaw('count(status) as statusCount, status')
        ->groupBy('status')
        ->get();

        return [
            'total' => [
                'label' => 'Totals',
                'value' => $entities->sum(function($elem){return $elem->statusCount;}),
                'style' => 'text-center flex-none flex justify-center w-[30px]'
            ],
            'items' => [
                [
                    'label' => 'Finished',
                    'value' => $entities->filter(function($elem){return $elem->status == 'production';})->sum(function($elem){return $elem->statusCount;}),
                    'style' => 'bg-sky-100 text-sky-600 text-center flex-none flex justify-center w-[30px]',
                ],
                [
                    'label' => 'Ongoing',
                    'value' => $entities->filter(function($elem){return $elem->status != 'production';})->sum(function($elem){return $elem->statusCount;}),
                    'style' => 'bg-rose-100 text-rose-600 text-center flex-none flex justify-center w-[30px]',
                ]
            ]
        ];
    }

    private function getEntityAtRisk($model) {
        $entityAtRisk = $model::select(['id', 'title', 'deadline'])
        ->where('deadline', '<=', Carbon::now()->addDays(30)->toDateTimeString())
        ->offset(0)
        ->limit(10)
        ->get();

        return $entityAtRisk;
    }
}
