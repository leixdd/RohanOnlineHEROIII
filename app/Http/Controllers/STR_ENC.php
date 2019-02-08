<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class STR_ENC extends Controller
{
    public static function exec($action, $string){
        $output = false;
        
        $encrypt_method = 'AES-256-CBC';                // Default
        $secret_key = 'itsyyyy';               // Change the key!
        $secret_iv = '!@#^%$Xitsyyyy';  // Change the init vector!
        
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        
        return $output;
    }
}
