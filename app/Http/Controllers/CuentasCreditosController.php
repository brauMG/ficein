<?php


namespace App\Http\Controllers;

use App\Models\EstadosCreditos;
use App\Models\EstadosInversion;
use Illuminate\Http\File;
use App\Models\Facturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use const http\Client\Curl\AUTH_ANY;

class CuentasCreditosController extends Controller
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

    public function index() {

        $cuentas_creditos = EstadosCreditos::all();

        return view('pages.administrador.cuentas_credito.index', compact('cuentas_creditos'));
    }

    public function index_cliente() {
        $cuentas_creditos = EstadosCreditos::where('email', Auth::user()->email)->get();

        return view('pages.cliente.cuentas_credito.index', compact('cuentas_creditos'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/cuentas_credito/'.$date.'/');

        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode(';', $filename, 4);
                $email = $data[0];
                $day = $data[1];
                $month = $data[2];
                $year = $data[3];
                $file_pdf = $file;

                $record_exist = EstadosCreditos::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    EstadosCreditos::create([
                        'email' => $email,
                        'date' => $year . '-' . $month . '-' . $day,
                        'file_pdf' => $file_pdf,
                    ]);
                }
            }
        }

        return redirect('/administrador/cuentas_credito')->with('message', 'Estados de Cuenta de Créditos verificados correctamente.');
    }

    public function pdf_auth($file) {
        $file = EstadosCreditos::where('id', $file)->first();

        if(Auth::user()->email === $file->client->email || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}
