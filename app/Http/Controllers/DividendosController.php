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

class DividendosController extends Controller
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

        $dividendos = Dividendos::all();

        return view('pages.administrador.dividendos.index', compact('dividendos'));
    }

    public function index_cliente() {
        $dividendos = Dividendos::where('id_client', Auth::user()->id_client)->get();

        return view('pages.cliente.dividendos.index', compact('dividendos'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/dividendos/'.$date.'/');

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

                $record_exist = Dividendos::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    Dividendos::create([
                        'id_client' => $id_client,
                        'date' => $year . '-' . $month . '-' . $day,
                        'file_pdf' => $file_pdf,
                    ]);
                }
            }
        }

        return redirect('/administrador/dividendos')->with('message', 'Dividendos verificados correctamente.');
    }

    public function pdf_auth($file) {
        $file = Dividendos::where('id', $file)->first();

        if(Auth::user()->id_client === $file->client->id_client || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}
