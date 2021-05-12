<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5'
        ]);

        Level::create($request->all());
        return back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5'
        ]);

        $nivel_id = $request->input('nivel_id');
        $level = Level::find($nivel_id);
        $level->name = $request->input('name');
        $level->save();

        return back();
    }

    public function delete($id)
    {
        $level = Level::find($id);
        $level->delete();
        return back();
    }

    public function byProject($id){
        return Level::where('project_id', $id)->get();
    }
}
