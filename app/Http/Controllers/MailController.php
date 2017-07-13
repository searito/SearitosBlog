<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index(){
        return view('admin.mails.form');
    }


    public function send(Request $request){
        $data = $request->all();

        Mail::send('admin.mails.message', $data, function ($message) use($request){
            // REMITENTE
            $message->from($request->email, $request->name);

            //ASUNTO
            $message->subject($request->subject);

            // RECEPTOR
            $message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));
        });

        return view('admin.mails.success');
    }
}
