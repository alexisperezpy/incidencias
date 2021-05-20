<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Incident;
use App\ProjectUser;
use App\User;


class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function getLogin(){
        return view('login2');
        // return view('login');
    
    }

    public function index()
    {
        $user = auth()->user();
        
        if ($user->is_admin){
            $myIncidents = Incident::where('project_id', $user->selected_project_id)
                ->where('support_id', $user->id)->get();
            //dd($myIncidents);

            $pending_incidents = Incident::where('support_id', null)
                                            ->where('project_id',$user->selected_project_id)->paginate(4);
            // dd($pending_incidents);
            $incidentsByMe = Incident::where('client_id', $user->id)->where('project_id', $user->selected_project_id)->get();

            return view('dashboard', compact('myIncidents', 'pending_incidents', 'incidentsByMe'));
        }

        if ($user->is_support){
            $myIncidents = Incident::where('project_id', $user->selected_project_id)
                                        ->where('support_id', $user->id)->get();
            //dd($myIncidents);

            $projectUser = ProjectUser::where('project_id', $user->selected_project_id)
                                        ->where('user_id', $user->id)->first();

            
            $pending_incidents = Incident::where('level_id', $projectUser->level_id)
                                        ->where('support_id', null)->paginate(4);

            $incidentsByMe = Incident::where('client_id', $user->id)->where('project_id', $user->selected_project_id)->get();

            return view('dashboard', compact('myIncidents', 'pending_incidents', 'incidentsByMe'));
        }

        if ($user->is_client){
            $incidentsByMe = Incident::where('client_id', $user->id)->where('project_id',$user->selected_project_id)->get();

            return view('dashboard', compact('incidentsByMe'));
        }
    }

    public function selectProject($id){
        $userLoginId = auth()->user()->id;
        $user = User::find($userLoginId);
        $user->selected_project_id = $id;
        $user->save();

        return back();
    }
}
