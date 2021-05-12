<?php

namespace App\Http\Controllers;

use App\Incident;
use App\ProjectUser;
use Illuminate\Support\Facades\Auth;
use App\User;


class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function getlogin(){
        return view('login');
    
    }
    public function index()
    {
        $user = auth()->user();
        $myIncidents = Incident::where('project_id', $user->selected_project_id)
                                ->where('support_id', $user->id)->get();

        $projectUser = ProjectUser::where('project_id', $user->selected_project_id)
                                    ->where('user_id', $user->id)->first();

        $pending_incidents = Incident::where('support_id', null)
                                        ->where('level_id', $projectUser->level_id)->get();
        
        
        return view('dashboard', compact('myIncidents', 'pending_incidents'));

    }

    public function selectProject($id){
        $userLoginId = auth()->user()->id;
        $user = User::find($userLoginId);
        $user->selected_project_id = $id;
        $user->save();

        return back();
    }
}
