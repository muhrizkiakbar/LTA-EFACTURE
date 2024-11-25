<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request) {
        $filters = array_merge([
            'sort' => 'desc',
            'size' => '20',
        ], $request->only([
            'trashed',
            'search',
            'sort',
            'date',
            'status'
        ]));
        $task = Task::filter($filters)->paginate($request->size ?? 20);

        return Inertia::render('Task/Index', [
            'task' => $task,
            'filters' => $filters
        ]);
    }
}
