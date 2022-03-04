<?php

namespace App\Http\Controllers;

use App\Models\Dividendos;
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
use Illuminate\Validation\Rules\In;
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
        $intereses = Interes::where('email', Auth::user()->email)->get();

        return view('pages.cliente.intereses.index', compact('intereses'));

    }

    public function verify(Request $request) {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/intereses/'.$date.'/');

        $added_files = [];
        $i = 0;
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

                $record_exist = Interes::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    $added_files [$i] = [
                        'email' => $email,
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
                Interes::create([
                    'email' => $added_file['email'],
                    'date' => $added_file['date'],
                    'file_pdf' => $added_file['file_pdf'],
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
                ' el resto de Intereses fueron verificados correctamente.'
            );
        }
        else {
            return redirect('/administrador/intereses')->with('message', 'Intereses verificados correctamente.');
        }
    }

    public function pdf_auth($file) {
        $file = Interes::where('id', $file)->first();

        if(Auth::user()->email === $file->client->email || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        }else{
            return abort('403');
        }
    }
}
