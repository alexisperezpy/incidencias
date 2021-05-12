<?php

namespace App\Http\Controllers;

use App\Category;
use App\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        $project_sel_id = auth()->user()->selected_project_id;
        $categories = Category::where('project_id', $project_sel_id)->get();
        return view('incident.report', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'sometimes|exists:categories,id',
            'severity' => 'required|in:M,N,A',
            'title' => 'required|min:10',
            'description' => 'required|min:20'
        ];

        $this->validate($request, $rules);
        $user = auth()->user();

        $incident = new Incident();
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->project_id = $user->selected_project_id ?: null;
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');
        $incident->client_id = $user->id;
        if ($user->is_support)
            $incident->support_id = $user->id;
            
        $incident->save();

        return back();
    }
}
