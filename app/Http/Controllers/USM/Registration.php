<?php

namespace App\Http\Controllers\USM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RohanUser;
use App\Model\RFSLinks;
use App\Model\RFSReferrals;
use App\Model\RFSConfirmations;
use Validator;
use Auth;
use CusAuth;
use STR_ENC;
use Mail;

class Registration extends Controller
{
    public function __construct() {
    }
    public function registerUser(Request $request){

        Validator::make($request->all(), [
            'username' => 'required|max:20',
            'password' => 'required',
            'confirm_pass' => 'required',
            'email' => 'required|email',
            'sp' => 'required',
        ])->validate();

        $inviCodeAccepted = false;

        if($request->input('inviCode') != "") {
            if(RFSLinks::where("generated_link", $request->input('inviCode'))->count() == 0) {
                return \Redirect::route('registration')->with('errorNE', 'Invitation Code was not found')->withInput();
            }else {
                $inviCodeAccepted = true;
            }
        }

        if($request->input('password') !== $request->input('confirm_pass')) {
            return \Redirect::route('registration')->with('errorNE', 'Passwords are not matched')->withInput();
        }

        $ue = RohanUser::where('login_id', $request->input('username'))->count();

        if($ue > 0) {
            return \Redirect::route('registration')->with('errorNE', 'Username is existing')->withInput();    
        }

        if(RohanUser::where('email', $request->input('email'))->count() > 0) {
            return \Redirect::route('registration')->with('errorNE', 'Email Address is existing')->withInput();    
        }


        RohanUser::create([
            "login_id" => $request->input("username"),
            "login_pw" => md5($request->input("password")),
            "grade" => "10",
            "reset" => $request->input("sp"),
            "email" => $request->input("email"),
            "points" => 0,
            "login_pw2" => $request->input("password")
        ]);

        $newlygen = RohanUser::where('login_id', $request->input("username"))->get();
        
        $rfsc = RFSConfirmations::create([
            'user_id' => $newlygen[0]->user_id,
            'isConfirm' => 0,
            'confirmation_code' => STR_ENC::exec('encrypt', $newlygen[0]->user_id)
        ]);

        $to_name = $request->input("username");
        $to_email = $request->input("email");
        $data = array('name'=>$request->input("username"), "body" => "Your confirmation code is: " . $rfsc->confirmation_code );
            
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('ROHAN:WORLD Account Confirmation');
            $message->from('rohanworldgmteam@gmail.com','Rohan World GM Team');
        });

        if(CusAuth::Auth(RohanUser::where('login_id', $request->input("username"))->get())) {

            $old = RFSLinks::where("generated_link", $request->input('inviCode'))->get();

            if($inviCodeAccepted) {
                RFSReferrals::create([
                    'referrer_id' => $old[0]->user_id,
                    'new_refer_id' => CusAuth::user()->user_id
                ]);
            }
            

            return redirect('/User/profile');
        }

        return "Successfully Registered";
    }

    public function viewRegister(){

        if(CusAuth::user()) {
            return redirect('/User/profile');
        }

        return view('modules.registration');

    }

}
