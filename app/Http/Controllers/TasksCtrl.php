<?php

namespace App\Http\Controllers;

use App\Task;
use Blade;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Response;

class TasksCtrl extends Controller
{

    function view ($locale = 'en') {
        App::setLocale($locale);

        return view('welcome');
    }

    function getTasks () {
        return Response::json(Task::all());
    }

    function addTask (Request $request) {
        $task = new Task();
        $task->name = $request->input('task');
        $task->save();

        return $this->getTasks();
    }

    function updateState ($id, $state) {
        $task = Task::find($id);
        $task->state = $state == 'true'? 1 : 0;
        $task->save();

    }

    function updateName ($id, $name){
        $task = Task::find($id);
        $task->name = $name;
        $task->save();
    }

    function delete () {
        Task::where('state', 1)->each(function ($i){
            $i->delete();
        });
    }
}
