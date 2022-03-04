<?php


namespace App\Http\Controllers;

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
        $cuentas_inversiones = EstadosInversion::where('email', Auth::user()->email)->get();

        return view('pages.cliente.cuentas_inversion.index', compact('cuentas_inversiones'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/cuentas_inversion/'.$date.'/');

        $added_files = [];
        $i = 0;
        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode(';', $filename, 5);
                $email = $data[0];
                $currency = $data[1];
                $day = $data[2];
                $month = $data[3];
                $year = $data[4];
                $file_pdf = $file;

                $record_exist = EstadosInversion::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    $added_files [$i] = [
                        'email' => $email,
                        'currency' => $currency,
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
                EstadosInversion::create([
                    'email' => $added_file['email'],
                    'currency' => $added_file['currency'],
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
            return redirect('/administrador/cuentas_inversion')->with('warning-message',
                'Los siguientes correos no fueron encontrados en la base de datos, por lo que no existen usuarios a los que asignar los documentos: '
                .$message_emails.
                ' el resto de Estados de Cuenta de Inversiones fueron verificados correctamente.'
            );
        }
        else {
            return redirect('/administrador/cuentas_inversion')->with('message', 'Estados de Cuenta de Inversiones verificados correctamente.');
        }
    }

    public function pdf_auth($file) {
        $file = EstadosInversion::where('id', $file)->first();

        if(Auth::user()->email === $file->client->email || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}
