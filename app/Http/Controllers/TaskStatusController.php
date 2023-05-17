<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{

    /**
     * Set task status to in progress
     */
    public function statusInProgress(Task $task): RedirectResponse
    {
        $task->saveStatus(TaskStatus::IN_PROGRESS);

        return redirect()->back();
    }

    /**
     * Set task status to done
     */
    public function statusDone(Task $task): RedirectResponse
    {
        $task->saveStatus(TaskStatus::DONE);

        return redirect()->back();
    }
}
