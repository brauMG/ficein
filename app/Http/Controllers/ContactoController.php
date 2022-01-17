<?php


namespace App\Http\Controllers;


use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ContactoController extends Controller
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
        $contacto = Contacto::find(1);

        return view('pages.administrador.contacto.index', compact('contacto'));

    }

    public function modify()
    {
        $contacto = Contacto::find(1);

        return view('pages.administrador.contacto.modify', compact('contacto'));
    }

    public function update(Request $request)
    {
        Contacto::where('id', 1)->update([
            'texto' => $request['texto'],
            'numero_1' => $request['numero_1'],
            'numero_2' => $request['numero_2'],
            'numero_3' => $request['numero_3'],
            'correo_1' => $request['correo_1'],
            'correo_2' => $request['correo_2'],
            'correo_3' => $request['correo_3'],
        ]);

        return redirect('/administrador/contacto/modify')->with('message', 'Datos modificados correctamente');
    }
}
