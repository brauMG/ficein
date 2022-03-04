<?php


namespace App\Http\Controllers;

use App\Models\ContanciaInversion;
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
        $constancias_inversiones = ContanciaInversion::where('email', Auth::user()->email)->get();

        return view('pages.cliente.constancias_inversion.index', compact('constancias_inversiones'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/constancias_inversion/'.$date.'/');

        $added_files = [];
        $i = 0;
        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode(';', $filename, 6);
                $email = $data[0];
                $operation_number = $data[1];
                $type = 'Indefinido';
                if ($data[2] === 'R') {
                    $type = 'Renovación';
                }
                if ($data[2] === 'D') {
                    $type = 'Depósito';
                }
                $day = $data[3];
                $month = $data[4];
                $year = $data[5];
                $file_pdf = $file;

                $record_exist = ContanciaInversion::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    $added_files [$i] = [
                        'email' => $email,
                        'operation_number' => $operation_number,
                        'type' => $type,
                        'date' => $year . '-' . $month . '-' . $day,
                        'file_pdf' => $file_pdf,
                    ];
                    $i++;
                }
            }
        }

        $null_emails = [];
        $i = 0;
        foreach ($added_files as $added_file) {
            $user = User::where('email', '=', $added_file['email'])->first();
            if ($user === null) {
                $null_emails[$i] = $added_file['email'];
                $i++;
            }
            else {
                ContanciaInversion::create([
                    'email' => $added_file['email'],
                    'operation_number' => $added_file['operation_number'],
                    'type' => $added_file['type'],
                    'date' => $added_file['date'],
                    'file_pdf' => $added_file['file_pdf']
                ]);
            }
        }

        if ($i > 0) {
            $message_emails = '';
            foreach ($null_emails as $null_email) {
                $message_emails = $null_email.', '.$message_emails;
            }
            return redirect('/administrador/constancia_inversion')->with('warning-message',
                'Los siguientes correos no fueron encontrados en la base de datos, por lo que no existen usuarios a los que asignar los documentos: '
                .$message_emails.
                ' el resto de Constancias de Inversión fueron verificadas correctamente.'
            );
        }
        else {
            return redirect('/administrador/constancia_inversion')->with('message', 'Constancias de Inversión verificadas correctamente.');
        }
    }

    public function pdf_auth($file) {
        $file = ContanciaInversion::where('id', $file)->first();

        if(Auth::user()->email === $file->client->email || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}
