<?php


namespace App\Http\Controllers;

use App\Models\ContanciaInversion;
use App\Models\EstadosInversion;
use Illuminate\Http\File;
use App\Models\Facturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use const http\Client\Curl\AUTH_ANY;

class ConstanciasInversionesController extends Controller
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

        $constancias_inversiones = ContanciaInversion::all();

        return view('pages.administrador.constancias_inversion.index', compact('constancias_inversiones'));
    }

    public function index_cliente() {
        $constancias_inversiones = ContanciaInversion::where('id_client', Auth::user()->id_client)->get();

        return view('pages.cliente.constancias_inversion.index', compact('constancias_inversiones'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/constancias_inversion/'.$date.'/');

        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode('_', $filename, 6);
                $id_client = $data[0];
                $operation_number = $data[1];
                if ($data[2] === 'R') {
                    $type = 'Renovación ';
                }
                if ($data[2] === 'D') {
                    $type = 'Depósito  ';
                }
                $day = $data[3];
                $month = $data[4];
                $year = $data[5];
                $file_pdf = $file;

                $record_exist = ContanciaInversion::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    ContanciaInversion::create([
                        'id_client' => $id_client,
                        'operation_number' => $operation_number,
                        'type' => $type,
                        'date' => $year . '-' . $month . '-' . $day,
                        'file_pdf' => $file_pdf,
                    ]);
                }
            }
        }

        return redirect('/administrador/constancia_inversion')->with('message', 'Constancias de Inversión verificadas correctamente.');
    }

    public function pdf_auth($file) {
        $file = ContanciaInversion::where('id', $file)->first();

        if(Auth::user()->id_client === $file->client->id_client || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}