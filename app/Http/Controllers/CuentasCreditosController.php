<?php


namespace App\Http\Controllers;

use App\Models\EstadosCreditos;
use App\Models\EstadosInversion;
use App\Models\User;
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
        $cuentas_creditos = EstadosCreditos::where('rfc', Auth::user()->rfc)->get();

        return view('pages.cliente.cuentas_credito.index', compact('cuentas_creditos'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/cuentas_credito/'.$date.'/');

        $added_files = [];
        $i = 0;
        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode(';', $filename, 4);
                $rfc = $data[0];
                $day = $data[1];
                $month = $data[2];
                $year = $data[3];
                $file_pdf = $file;

                $record_exist = EstadosCreditos::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    $added_files [$i] = [
                        'rfc' => $rfc,
                        'date' => $year . '-' . $month . '-' . $day,
                        'file_pdf' => $file_pdf,
                    ];
                    $i++;
                }
            }
        }

        $null_rfcs = [];
        $i = 0;
        foreach ($added_files as $added_file) {
            $user = User::where('rfc', '=', $added_file['rfc'])->first();
            if ($user === null) {
                $null_rfcs[$i] = $added_file['rfc'];
                $i++;
            }
            else {
                EstadosCreditos::create([
                    'rfc' => $added_file['rfc'],
                    'date' => $added_file['date'],
                    'file_pdf' => $added_file['file_pdf']
                ]);
            }
        }

        if ($i > 0) {
            $message_rfcs = '';
            foreach ($null_rfcs as $null_rfc) {
                $message_rfcs = $null_rfc.', '.$message_rfcs;
            }
            return redirect('/administrador/constancia_inversion')->with('warning-message',
                'Los siguientes RFC no fueron encontrados en la base de datos, por lo que no existen usuarios a los que asignar los documentos: '
                .$message_rfcs.
                ' el resto de Estados de Cuenta de Créditos fueron verificados correctamente.'
            );
        }
        else {
            return redirect('/administrador/cuentas_credito')->with('message', 'Estados de Cuenta de Créditos verificados correctamente.');
        }
    }

    public function pdf_auth($file) {
        $file = EstadosCreditos::where('id', $file)->first();

        if(Auth::user()->rfc === $file->client->rfc || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}
