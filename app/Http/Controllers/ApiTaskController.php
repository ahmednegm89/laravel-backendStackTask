<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use App\Models\User;

/**
 * Api for task class
 */
class ApiTaskController extends Controller
{
    /**
     * index function that get all tasks data 
     *
     * @return void
     */
    public function index()
    {
        $tasks = task::all();
        return response()->json($tasks);
    }
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

        $task =  task::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'project_id' => $request->project_id,
        ]);

        return response()->json($task);
    }
    /**
     * update task function
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

        return response()->json($task);
    }
    /**
     * submiting task function
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
        return response()->json($task);
    }
}
