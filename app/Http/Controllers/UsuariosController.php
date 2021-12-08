<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UsuariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::where('type', 1)->get();

        return view('pages.administrador.usuarios.index', compact('users'));

    }

    public function create()
    {
        return view('pages.administrador.usuarios.add');
    }

    public function store_client(Request $request)
    {
        $attributes = request()->validate([
            'id_client' => 'required|unique:users,id_client',
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        $password = bcrypt(Str::random(35));

        User::create([
            'id_client' => $attributes['id_client'],
            'name' => $attributes['name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'type' => 1,
        ]);

        return redirect('/administrador/usuarios')->with('message', 'Administrador añadido correctamente');
    }

    public function store_admin(Request $request)
    {
        $attributes = request()->validate([
            'name_admin' => 'required|max:255',
            'last_name_admin' => 'required|max:255',
            'email_admin' => 'required|email|max:255|unique:users,email',
            'password_admin' => 'required|min:8|max:255',
        ]);

        User::create([
            'name' => $attributes['name_admin'],
            'last_name' => $attributes['last_name_admin'],
            'email' => $attributes['email_admin'],
            'email_verified_at' => now(),
            'password' => Hash::make($request->input('password_admin')),
            'type' => 0,
        ]);

        return redirect('/administrador/usuarios')->with('message', 'Administrador añadido correctamente');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        return view('pages.administrador.usuarios.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id, 'id')],
        ]);

        User::where('id', $id)->update([
            'name' => $attributes['name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
        ]);

        return redirect('/administrador/usuarios')->with('message', 'Administrador añadido correctamente');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();

        return redirect('/administrador/usuarios')->with('message', 'Usuario eliminado correctamente');
    }
}
