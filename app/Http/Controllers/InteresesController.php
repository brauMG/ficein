<?php

namespace App\Http\Controllers;

use App\Models\Dividendos;
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
use App\Models\Interes;

class InteresesController extends Controller
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

        $intereses = Interes::all();

        return view('pages.administrador.intereses.index', compact('intereses'));
    }

    public function index_cliente() {
        $intereses = Interes::where('id_client', Auth::user()->id_client)->get();

        return view('pages.cliente.intereses.index', compact('intereses'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/intereses/'.$date.'/');

        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode('_', $filename, 4);
                $id_client = $data[0];
                $day = $data[1];
                $month = $data[2];
                $year = $data[3];
                $file_pdf = $file;

                $record_exist = Interes::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    Interes::create([
                        'id_client' => $id_client,
                        'date' => $year . '-' . $month . '-' . $day,
                        'file_pdf' => $file_pdf,
                    ]);
                }
            }
        }

        return redirect('/administrador/intereses')->with('message', 'Intereses verificados correctamente.');
    }

    public function pdf_auth($file) {
        $file = Interes::where('id', $file)->first();

        if(Auth::user()->id_client === $file->client->id_client || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}
