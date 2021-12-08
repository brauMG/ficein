<?php


namespace App\Http\Controllers;

use App\Models\EstadosInversion;
use Illuminate\Http\File;
use App\Models\Facturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use const http\Client\Curl\AUTH_ANY;

class CuentasInversionesController extends Controller
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

        $cuentas_inversiones = EstadosInversion::all();

        return view('pages.administrador.cuentas_inversion.index', compact('cuentas_inversiones'));
    }

    public function index_cliente() {
        $cuentas_inversiones = EstadosInversion::where('id_client', Auth::user()->id_client)->get();

        return view('pages.cliente.cuentas_inversion.index', compact('cuentas_inversiones'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/cuentas_inversion/'.$date.'/');

        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode('_', $filename, 5);
                $id_client = $data[0];
                $currency = $data[1];
                $day = $data[2];
                $month = $data[3];
                $year = $data[4];
                $file_pdf = $file;

                $record_exist = EstadosInversion::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    EstadosInversion::create([
                        'id_client' => $id_client,
                        'currency' => $currency,
                        'date' => $year . '-' . $month . '-' . $day,
                        'file_pdf' => $file_pdf,
                    ]);
                }
            }
        }

        return redirect('/administrador/cuentas_inversion')->with('message', 'Estados de Cuenta de Inversiones verificados correctamente.');
    }

    public function pdf_auth($file) {
        $file = EstadosInversion::where('id', $file)->first();

        if(Auth::user()->id_client === $file->client->id_client || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}
