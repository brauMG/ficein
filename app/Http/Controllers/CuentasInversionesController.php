<?php


namespace App\Http\Controllers;

use App\Models\EstadosInversion;
use App\Models\User;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\File;
use App\Models\Facturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
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

    public function index()
    {
        return view('pages.administrador.cuentas_inversion.index');
    }

    public function index_cliente()
    {
        $cuentas_inversiones = EstadosInversion::where('rfc', Auth::user()->rfc)->get();

        return view('pages.cliente.cuentas_inversion.index', compact('cuentas_inversiones'));
    }

    public function getAdminData()
    {
        $cuentas_inversiones = EstadosInversion::with('client')->select('estados_de_cuenta_inversiones.*', 'users.*');

        return DataTables::of($cuentas_inversiones)
            ->addColumn('full_name', function ($cuentas_inversiones) {
                return $cuentas_inversiones->client->name . $cuentas_inversiones->client->last_name;
            })
            ->addColumn('month', function ($cuentas_inversiones) {
                $month = date('m', strtotime($cuentas_inversiones->date));
                switch ($month) {
                    case '01': return 'Enero';
                    case '02': return 'Febrero';
                    case '03': return 'Marzo';
                    case '04': return 'Abril';
                    case '05': return 'Mayo';
                    case '06': return 'Junio';
                    case '07': return 'Julio';
                    case '08': return 'Agosto';
                    case '09': return 'Septiembre';
                    case '10': return 'Octubre';
                    case '11': return 'Noviembre';
                    case '12': return 'Diciembre';
                }
            })
            ->addColumn('year', function ($cuentas_inversiones) {
                return date('Y', strtotime($cuentas_inversiones->date));
            })
            ->addColumn('action', function ($cuentas_inversiones) {
                return '<a href="' . '/cliente/cuentas_inversion/pdf/download/' . $cuentas_inversiones->id . '" rel="tooltip" class="btn btn-sm btn-warning btn-adjust">PDF <i class="material-icons">file_download</i></a>';
            })
            ->make(true);
    }

    public function verify(Request $request)
    {

        $date = $request->input('date');

        $content = Storage::disk('myDisk')->allFiles('/cuentas_inversion/' . $date . '/');

        $added_files = [];
        $i = 0;
        foreach ($content as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ($extension === 'pdf') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $data = explode(';', $filename, 6);
                $rfc = $data[0];
                $currency = $data[1];
                $contract_name = $data[2];
                $day = $data[3];
                $month = $data[4];
                $year = $data[5];
                $file_pdf = $file;

                $record_exist = EstadosInversion::where('file_pdf', $file_pdf)->first();

                if ($record_exist === null) {
                    $added_files [$i] = [
                        'rfc' => $rfc,
                        'currency' => $currency,
                        'contract_name' => $contract_name,
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
            } else {
                EstadosInversion::create([
                    'rfc' => $added_file['rfc'],
                    'currency' => $added_file['currency'],
                    'contract_name' => $added_file['contract_name'],
                    'date' => $added_file['date'],
                    'file_pdf' => $added_file['file_pdf']
                ]);
            }
        }

        if ($i > 0) {
            $message_rfcs = '';
            foreach ($null_rfcs as $null_rfc) {
                $message_rfcs = $null_rfc . ', ' . $message_rfcs;
            }
            return redirect('/administrador/cuentas_inversion')->with('warning-message',
                'Los siguientes RFC no fueron encontrados en la base de datos, por lo que no existen usuarios a los que asignar los documentos: '
                . $message_rfcs .
                ' el resto de Estados de Cuenta de Inversiones fueron verificados correctamente.'
            );
        } else {
            return redirect('/administrador/cuentas_inversion')->with('message', 'Estados de Cuenta de Inversiones verificados correctamente.');
        }
    }

    public function pdf_auth($file)
    {
        $file = EstadosInversion::where('id', $file)->first();

        if (Auth::user()->rfc === $file->client->rfc || Auth::user()->type === 0) {
            return Storage::disk('myDisk')->download($file->file_pdf);
        } else {
            return abort('403');
        }
    }
}
