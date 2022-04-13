<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\File;
use App\Models\Facturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use const http\Client\Curl\AUTH_ANY;

class FacturasController extends Controller
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

        $facturas = Facturacion::all();

        return view('pages.administrador.facturas.index', compact('facturas'));
    }

    public function index_cliente() {

        $facturas = Facturacion::where('rfc', Auth::user()->rfc)->get();

        return view('pages.cliente.facturas.index', compact('facturas'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/facturas/'.$date.'/');

        $added_files = [];
        $i = 0;
        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode(';', $filename, 5);
                $rfc = $data[0];
                $contract_name = $data[1];
                $day = $data[2];
                $month = $data[3];
                $year = $data[4];
                $file_pdf = $file;
                if(Storage::disk('myDisk')->exists('/facturas/'.$date.'/'.$filename.'.xml')) {
                    $file_xml = 'facturas/'.$date.'/'.$filename.'.xml';
                }
                else {
                    return redirect('/administrador/facturas')->with('error-message', 'El procesamiento fue interrumpido debido a que el archivo: '.$file_pdf.' no esta acompañado por un xml.');
                }

                $record_exist = Facturacion::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    $added_files [$i] = [
                        'rfc' => $rfc,
                        'contract_name' => $contract_name,
                        'date' => $year . '-' . $month . '-' . $day,
                        'file_pdf' => $file_pdf,
                        'file_xml' => $file_xml
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
                Facturacion::create([
                    'rfc' => $added_file['rfc'],
                    'contract_name' => $added_file['contract_name'],
                    'date' => $added_file['date'],
                    'file_pdf' => $added_file['file_pdf'],
                    'file_xml' => $added_file['file_xml']
                ]);
            }
        }

        if ($i > 0) {
            $message_rfcs = '';
            foreach ($null_rfcs as $null_rfc) {
                $message_rfcs = $null_rfc.', '.$message_rfcs;
            }
            return redirect('/administrador/constancia_inversion')->with('warning-message',
                'Los siguientes correos no fueron encontrados en la base de datos, por lo que no existen usuarios a los que asignar los documentos: '
                .$message_rfcs.
                ' el resto de Facturas fueron verificadas correctamente.'
            );
        }
        else {
            return redirect('/administrador/facturas')->with('message', 'Facturas vinculadas correctamente');
        }
    }

    public function pdf_auth($file) {
        $file = Facturacion::where('id', $file)->first();

        if(Auth::user()->rfc === $file->client->rfc || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }

    public function xml_auth($file) {
        $file = Facturacion::where('id', $file)->first();

        if(Auth::user()->rfc === $file->client->rfc || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_xml);
        }else{
            return abort('403');
        }
    }
}
