<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Project;
use App\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function index()
    {        
        $users = User::where('role',1)->orderBy('name')->paginate(5);
        return view('admin.users.index',compact('users'));
    }

    public function edit($id)
    {

        $user = User::find($id);
        $projects = Project::all();
        $projects_users = ProjectUser::where('user_id',$user->id)->get();
        return view('admin.users.edit',compact('user','projects','projects_users'));
        
    }

    public function update($id, Request $request){
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            // 'clave' => 'sometimes|string|min:8'
            ]);

        $user = User::find($id);
       
        $user->name = $request->input('nombre');
        $password = $request->input('clave');
            if($password)
                $user->password=bcrypt($request->input('clave'));
        
        $user->save();

        return Redirect(route('user.index'))->with('notification', 'El registro fue actualizado con éxito');
    }
    
    public function store(Request $request){
        $rules= [
            'nombre'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'clave'=>['required', 'string', 'min:8'],
        ];

        // dd($request->all());
        $this->validate($request,$rules);
        
        $user = new User();
        $user->name = $request->input('nombre');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('clave'));
        $user->role = 1;
        $user->save();
        
        return back()->with('notification','El registro fue guardado con éxito');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return back()->with('notification', 'El registro fue eliminado con éxito');
    }
}
