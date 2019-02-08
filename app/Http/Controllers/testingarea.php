<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class testingarea extends Controller
{
    //

    public function testemail() {
        $to_name = 'Ariel Lecias';
        $to_email = 'lecias.ariel@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");
            
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Artisans Web Testing Mail');
            $message->from('rohanworldgmteam@gmail.com','Artisans Web');
        });
    }
 }
