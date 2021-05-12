<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Project;
use App\Category;
use App\Level;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::withTrashed()->paginate(5);
        return view('admin.projects.index',compact('projects'));
    }

    public function edit($id)
    {
        // $categorias = Category::orderBy('name')->paginate(5);
        // $levels = Level::orderBy('name')->paginate(5);
        $project = Project::find($id);
        $categorias = $project->categorias;
        $levels =  $project->levels;
        return view('admin.projects.edit', compact('project','categorias','levels'));
        
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description'=> 'required|string|max:255',
        ]);

        $project = Project::find($id);

        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->save();

        return Redirect(route('project.index'))->with('notification', 'El registro fue actualizado con éxito');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:projects'],
            'description' => ['required', 'string', 'max:255'],
            'fecha_inicio' => ['date'],
        ];

        $this->validate($request, $rules);
        Project::create($request->all());
        return back()->with('notification', 'El registro fue guardado con éxito');
    }

    public function delete($id)
    {
        $project = Project::find($id);
        $project->delete();
        return back()->with('notification', 'El registro fue eliminado con éxito');
    }
    public function restore($id)
    {
        // Project::find($id)->restore();
        Project::withTrashed()->find($id)->restore();
        return back()->with('notification', 'El registro fue restaurado con éxito');
    }


}
