<?php

namespace App\Http\Controllers;

use App\Category;
use App\Incident;
use App\Project;
use App\ProjectUser;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id){
        $incident = Incident::findorfail($id);
        return view('incident.show',compact('incident'));
    }

    public function atender($id)
    {
        $incident = Incident::findorfail($id);
        return view('incident.atender', compact('incident'));
    }

    public function updateAcciones($id, Request $request)
    {
        $request->validate([
            'accion' => 'required|string|min:10|max:255',
            'fecha_accion' => ['date'],
        ]);
        $user = auth()->user();
        $incidente = Incident::find($id);

        $incidente->accion = $request->input('accion');
        $incidente->accion_date = $request->input('fecha_accion');
        $incidente->support_id = $user->id;
        $incidente->save();

        return Redirect(route('report.ver',$incidente->id))->with('notification', 'Acción registrada con éxito');
    }

    public function cerrarIncidente($id, Request $request)
    {
        $incidente = Incident::find($id);

        $incidente->active = 0;
        
        $incidente->save();

        return Redirect(route('report.ver', $incidente->id))->with('notification', 'Acción maracada como Resuelta');
    }

    public function create()
    {
        $project_sel_id = auth()->user()->selected_project_id;
        $categories = Category::where('project_id', $project_sel_id)->get();
        return view('incident.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'exclude_if:category_id,0|exists:categories,id',
            'severity' => 'required|in:M,N,A',
            'title' => 'required|min:10|max:200',
            'description' => 'required|min:20|max:255'
        ];

        $this->validate($request, $rules);
        
        $incident = new Incident();
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');
        
        $user = auth()->user();

        $incident->client_id = $user->id;
        $incident->project_id = $user->selected_project_id;
        $incident->level_id = Project::find($user->selected_project_id)->first_level_id;
        
        $incident->save();
        
        // $incident->project_id = $user->selected_project_id ?: null;
        // if ($user->is_support)
        //     $incident->support_id = $user->id;
    
        return back();
    }
}
