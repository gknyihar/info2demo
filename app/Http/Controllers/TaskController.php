<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user): View
    {
        $status = [
            'new' => ['title' => 'Új', 'class' => 'text-primary'],
            'in_progress' => ['title' => 'Folyamatban', 'class' => 'text-warning'],
            'done' => ['title' => 'Kész', 'class' => 'text-secondary']
        ];

        $tasks = $user->tasks()
            ->orderByRaw("FIELD(status, 'new', 'in_progress', 'done'), id")
            ->get();

        return view('tasks', compact('tasks', 'user', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ], [], [
            'title' => 'cím',
            'description' => 'leírás'
        ]);

        $task = new Task($request->input());
        $user->tasks()->save($task);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): View
    {
        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ], [], [
            'title' => 'cím',
            'description' => 'leírás'
        ]);

        $task->update($request->input());
        $task->save();

        return redirect()->route('tasks.index', $task->user);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->back();
    }
}
