<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Mail\ResetPass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

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
            'name' => 'required|max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|max:255',
            'rfc' => 'required|max:255|unique:users,rfc',
        ]);

        $password = bcrypt(Str::random(35));

        $user_data = User::create([
            'name' => $attributes['name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'email_verified_at' => now(),
            'rfc' => $attributes['rfc'],
            'password' => Hash::make($password),
            'type' => 1,
        ]);

//        Activar esta linea para el envio de correos
//        Mail::to($user_data['email'])->queue(new ResetPass($user_data['rfc']));


//        Password::sendResetLink($request->only(['email']));

        return redirect('/administrador/usuarios')->with('message', 'Usuario añadido correctamente');
    }

    public function store_admin(Request $request)
    {
        $attributes = request()->validate([
            'name_admin' => 'required|max:255',
            'last_name_admin' => 'max:255',
            'email_admin' => 'required|email|max:255|unique:users,email',
            'rfc_admin' => 'required|max:255|unique:users,rfc',
            'password_admin' => 'required|min:8|max:255',
        ]);

        User::create([
            'name' => $attributes['name_admin'],
            'last_name' => $attributes['last_name_admin'],
            'email' => $attributes['email_admin'],
            'email_verified_at' => now(),
            'password' => Hash::make($request->input('password_admin')),
            'type' => 0,
            'rfc' => $attributes['rfc_admin'],
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
            'last_name' => 'max:255',
            'email' => 'required|max:255|email',
            'rfc' => ['required', 'max:255', Rule::unique('users', 'rfc')->ignore($id, 'id')]
        ]);

        User::where('id', $id)->update([
            'name' => $attributes['name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'rfc' => $attributes['rfc']
        ]);

        return redirect('/administrador/usuarios')->with('message', 'Administrador añadido correctamente');
    }

    public function prepare($id)
    {
        $user= User::where('id', $id)->get()->toArray();
        $user = $user[0];
        return view('pages.administrador.usuarios.prepare', compact('user'));
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();

        return redirect('/administrador/usuarios')->with('message', 'Usuario eliminado correctamente');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        $campaign_id = $request->campaign;
        $created_by_id = Auth::user()->id;
        $assigned_user_id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        Excel::import(new UsersImport($campaign_id, $created_by_id, $assigned_user_id, $company_id), $file);
        return back()->with('flash_message', 'Importación de contactos realizada');
    }
}
