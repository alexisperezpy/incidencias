<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Pagination\Paginator;

class ClientController extends Controller
{
    public function index()
    {
        $users = User::where('role', 2)->orderBy('name')->paginate(3);
        return view('admin.clients.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.clients.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            // 'clave' => 'sometimes|string|min:8'
        ]);

        $user = User::find($id);

        $user->name = $request->input('nombre');
        $password = $request->input('clave');
        if ($password)
            $user->password = bcrypt($request->input('clave'));

        $user->save();

        return Redirect(route('client.index'))->with('notification', 'El registro fue actualizado con éxito');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];

        // dd($request->all());
        $this->validate($request, $rules);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 2;
        $user->save();

        return back()->with('notification', 'El registro fue guardado con éxito');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('notification', 'El registro fue eliminado con éxito');
    }
}



  

