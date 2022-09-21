<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\project;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * api projects class
 */
class ApiProjectController extends Controller
{
    /**
     * index function that get all projects data
     *  
     * @return void
     */
    public function index()
    {
        $projects = project::all();
        return response()->json($projects);
    }
    /**
     * get specified project by id function
     *
     * @param [type] $id -> project id
     * @return void
     */
    public function show($id)
    {
        $project = project::findorfail($id);
        return response()->json($project);
    }
    /**
     * store project data function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
            'user_id' => 'required|string',
        ]);

        $project = project::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'user_id' => $request->user_id,
        ]);

        return response()->json($project);
    }
    /**
     * update project data function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
        ]);
        $project = project::findorfail($id);

        $project->update([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);
        return response()->json($project);
    }
    /**
     * delete specified project function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $project = project::findorfail($id);
        $project->delete();
        $msg = 'project deleted successfully';
        return response()->json($msg);
    }
}
