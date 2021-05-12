<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProjectUser;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    public function store(Request $request){

        $project_id = $request->input('project_id');
        $user_id = $request->input('user_id');
        $project_user = ProjectUser::where('project_id',$project_id)
                                    -> where('user_id',$user_id)->first();

        if ($project_user)
            return back()->with('noti','El usuario ya pertenece a este proyecto');

        $project_user = new ProjectUser();
        $project_user->project_id = $project_id;
        $project_user->user_id = $user_id;
        $project_user->level_id = $request->input('level_id');
        $project_user->save();
        return back();
    }

    public function delete($id)
    {
        $project_user = ProjectUser::find($id);
        $project_user->delete();
        return back()->with('notification', 'El registro fue eliminado con éxito');
    }

}
