<?php

namespace App\Http\Controllers;

use App\Models\task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Task controller class
 */
class TaskController extends Controller
{
    /**
     * store task function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'user_id' => 'required|string',
        ]);

        task::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
        ]);

        return back();
    }

    /**
     * return edit view function
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $users = User::where('is_admin', '=', 0)->get();
        $task = task::findorfail($id);
        return view('tasks.edit', compact('task', 'users'));
    }

    /**
     * update project function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'user_id' => 'required|string',
        ]);

        $task = task::findorfail($id);
        $task->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);

        return redirect(route('projects.show', $request->project_id));
    }
    /**
     * return task submit view function
     *
     * @param [type] $id
     * @return void
     */
    public function submit($id)
    {
        $task = task::findorfail($id);
        return view('tasks.submit', compact('task'));
    }

    /**
     * Handle task submit function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function handleSubmit(Request $request, $id)
    {
        $request->validate([
            'details' => 'required|string',
        ]);

        $task = task::findorfail($id);
        $task->details = $request->details;
        $task->save();
        return redirect(route('projects.index'));
    }
}
