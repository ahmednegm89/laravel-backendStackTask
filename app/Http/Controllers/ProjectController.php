<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\project;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Project Controller class
 */
class ProjectController extends Controller
{
    /**
     * return view and all needed data for it function
     *
     * @return void
     */
    public function index()
    {
        $tasks = task::where('user_id', Auth::user()->id)->get();
        $projects = project::all();
        return view('projects.index', compact('projects', 'tasks'));
    }
    /**
     * show specified project by id function
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        $tasks = task::where('project_id', $id)->get();
        $users = User::where('is_admin', '=', 0)->get();
        $project = project::findorfail($id);
        return view('projects.show', compact('project', 'users', 'tasks'));
    }

    /**
     * return create view function
     *
     * @return void
     */
    public function create()
    {
        return view('projects.create');
    }
    /**
     * store project function
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'desc' => 'required|string',
        ]);

        project::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'user_id' => Auth::user()->id,
        ]);

        return redirect(route('projects.index'));
    }

    /**
     * return edit project view function
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $project = project::findorfail($id);
        return view('projects.edit', compact('project'));
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
            'desc' => 'required|string',
        ]);
        $project = project::findorfail($id);

        $project->update([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);
        return redirect(route('projects.show', $id));
    }
    /**
     * delete specified project by id function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $project = project::findorfail($id);
        $project->delete();
        return redirect(route('projects.index'));
    }
}
