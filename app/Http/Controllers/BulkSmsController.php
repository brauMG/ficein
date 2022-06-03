<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class BulkSmsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.administrador.sms.index');
    }

    public function sendSms( Request $request ) {
        // Your Account SID and Auth Token from twilio.com/console
        $sid    = env( 'TWILIO_SID' );
        $token  = env( 'TWILIO_TOKEN' );
        $client = new Client( $sid, $token );

        $validator = Validator::make($request->all(), [
            'numbers' => 'required',
            'message' => 'required'
        ]);

        if ( $validator->passes() ) {

            $numbers_in_arrays = explode( ',' , $request->input( 'numbers' ) );

            $message = $request->input( 'message' );
            $count = 0;

            foreach( $numbers_in_arrays as $number )
            {
                $count++;

                $client->messages->create(
                    $number,
                    [
                        'from' => env( 'TWILIO_FROM' ),
                        'body' => $message,
                    ]
                );
            }

            return back()->with( 'message', $count . " mensajes enviados!" );

        } else {
            return back()->withErrors( $validator );
        }
    }
}
