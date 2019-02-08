<?php

namespace App\Http\Controllers\USM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GameCharacters;
use App\Model\RohanUser;
use CusAuth;
use DB;
use App\Model\UserDisconnect;
use App\Model\EMChars;
use STR_ENC;
use App\Model\GCStatus;
use App\Model\GCBuffs;
use App\Model\GameCharLogin;
use App\Model\RFSLinks;
use App\Model\RFSConfirmations;
use App\Model\RFSReferrals;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('cusauth');
    }

    public function fix5101(Request $request){
        
        UserDisconnect::create([
            "user_id" => CusAuth::user()->user_id,
            "server_id" => 31,
            "char_id" => $request->input('char_id')
        ]);

        //update tuser set session_id = '' where [user_id] = @user_id
        // RohanUser::where("user_id", CusAuth::user()->user_id)->update(array(
        //     "session_id" => ''
        // ));

        return response([
            "success" => true
        ]);
    }

    //removing murderer status
    public function removeMS(Request $request) {
    

        $user_points = RohanUser::where('user_id', CusAuth::user()->user_id)->get();

        if($user_points[0]->points >= 50) {

            //update 
            $r = GCStatus::where('char_id', STR_ENC::exec('decrypt', $request->input('char_id')))->update(array(
                'pk_state' => 1,
                'pk_point' => 0,
                'pk_state_second' => 0
            ));
            
            if($r) {
                RohanUser::where("user_id", CusAuth::user()->user_id)
                ->update(array(
                    "points" => ($user_points[0]->points - 50)
                ));
                         
                if($request->ajax()){
                    return response([
                        "success" => true,
                        "message" => "Murderer Status has been removed, Please logged in now"
                    ]);
                }
            }

        } else {
            if($request->ajax()){
                return response([
                    "success" => false,
                    "message" => "Not enough RPs"
                ]);
            }
        }

        if($request->ajax()){
            return response([
                "success" => false,
                "message" => "An error occured"
            ]);
        }

        
    }

    public function RKI(Request $request) {
    

        $user_points = RohanUser::where('user_id', CusAuth::user()->user_id)->get();

        if($user_points[0]->points >= 75) {

            //update 
            $r = GCStatus::where('char_id', STR_ENC::exec('decrypt', $request->input('char_id')))->update(array(
                'pk_state' => 1,
                'pk_point' => 10,
                'pk_state_second' => 0
            ));
            
            //ADD Murder Remission
            if(GCBuffs::where([
                ['char_id', "=", STR_ENC::exec('decrypt', $request->input('char_id'))],
                ['kind', "=", -28629]
            ])->count() >= 1) {
                GCBuffs::where([
                    ['char_id', "=", STR_ENC::exec('decrypt', $request->input('char_id'))],
                    ['kind', "=", -28629]
                ])->delete();
            }

            GCBuffs::create([
                'char_id' => STR_ENC::exec('decrypt', $request->input('char_id')),
                'kind' => -28629,
                'level' => 0,
                'affect_time' => 7199999,
                'event_time' => 0,
            ]);

            if($r) {


                RohanUser::where("user_id", CusAuth::user()->user_id)
                ->update(array(
                    "points" => ($user_points[0]->points - 75)
                ));
                         
                if($request->ajax()){
                    return response([
                        "success" => true,
                        "message" => "Set to lowest Possible Kills -> Murderer Remission Buffs Added , Please logged in now"
                    ]);
                }
            }

        } else {
            if($request->ajax()){
                return response([
                    "success" => false,
                    "message" => "Not enough RPs"
                ]);
            }
        }

        if($request->ajax()){
            return response([
                "success" => false,
                "message" => "An error occured"
            ]);
        }

        
    }


    public function showProfile() {

        $points = RohanUser::select("points")->where("user_id", CusAuth::user()->user_id)->get();
        
        //$isReferred = RFSReferrals::where('new_refer_id', CusAuth::user()->user_id)->
        //get all characters 
        $referrals = DB::connection('rohan_user')->select(
            "SELECT 
            u.user_id,
            u.login_id,
            rf.created_at, 
            (SELECT COUNT(*) FROM RohanGame.dbo.TCharacter c INNER JOIN RohanGame.dbo.TCharacterAbility ca ON ca.char_id = c.id WHERE c.user_id = u.user_id AND ca.level >= 110) 'char110'
            FROM RohanRFS.dbo.tbl_referrals as rf 
            INNER JOIN RohanUser.dbo.TUser as u ON u.user_id = rf.new_refer_id
            INNER JOIN RohanRFS.dbo.tbl_confirmations as cu ON cu.user_id = rf.new_refer_id
            WHERE rf.referrer_id = ? AND cu.isConfirm = 1", [CusAuth::user()->user_id]
        );

        $gc = GameCharLogin::join('TCharacter', 'TCharacter.id', 'TCharacterLogin.char_id')->where([ 
            ["login", "=", 0],
            ["user_id", "=", CusAuth::user()->user_id],
            ["isSelling", "=", 0]
        ])->get();

        $referral_link = null;
        
        if(RFSLinks::where("user_id", CusAuth::user()->user_id)->count() != 0) {
            $referral_link = RFSLinks::where("user_id", CusAuth::user()->user_id)->get();
        }

        $Characters = GameCharacters::selectRaw("
            flag,
            id,
            name,
            ctype_id,
            exp,
            pk_state,
            kill_count,
            killed_count,
            level,
            case when (ctype_id = 196869) then 'Human Female' when (ctype_id = 196993) then 'Human Male' when (ctype_id = 196870) then 'Guardian Female' when (ctype_id = 196994) then 'Guardian Male' when (ctype_id = 196871) then 'Defender Female' when (ctype_id = 196995) then 'Defender Male' when (ctype_id = 197133) then 'Elf Female' when (ctype_id = 197257) then 'Elf Male' when (ctype_id = 197134) then 'Priest Female' when (ctype_id = 197258) then 'Priest Male' when (ctype_id = 197135) then 'Templar Female' when (ctype_id = 197259) then 'Templar Male' when (ctype_id = 197653) then 'Half Elf Female' when (ctype_id = 197777) then 'Half Elf Male' when (ctype_id = 197654) then 'Ranger Female' when (ctype_id = 197778) then 'Ranger Male' when (ctype_id = 197655) then 'Scout Female' when (ctype_id = 197779) then 'Scout Male' when (ctype_id = 200741) then 'Giant Female' when (ctype_id = 200865) then 'Giant Male' when (ctype_id = 200742) then 'Berserker Female' when (ctype_id = 200866) then 'Berserker Male' when (ctype_id = 200743) then 'Savage Female' when (ctype_id = 200867) then 'Savage Male' when (ctype_id = 198685) then 'Dhan Female' when (ctype_id = 198809) then 'Dhan Male' when (ctype_id = 198686) then 'Avenger Female' when (ctype_id = 198810) then 'Avenger Male' when (ctype_id = 198687) then 'Predator Female' when (ctype_id = 198811) then 'Predator Male' when (ctype_id = 229437) then 'Dekan Female' when (ctype_id = 229561) then 'Dekan Male' when (ctype_id = 229438) then 'Dragon Knight Female' when (ctype_id = 229562) then 'Dragon Knight Male' when (ctype_id = 229439) then 'Dragon Sage Female' when (ctype_id = 229563) then 'Dragon Sage Male' when (ctype_id = 204845) then 'Dark Elf Female' when (ctype_id = 204969) then 'Dark Elf Male' when (ctype_id = 204846) then 'Warlock Female' when (ctype_id = 204970) then 'Warlock Male' when (ctype_id = 204847) then 'Wizard Female' when (ctype_id = 204971) then 'Wizard Sage Male'    end as Class
       ")
       ->join("TCharacterStatus", "TCharacterStatus.char_id", "TCharacter.id")
       ->join("TCharacterAbility", "TCharacterAbility.char_id", "TCharacter.id")
       ->where([
           ["user_id", "=", CusAuth::user()->user_id],
           ["isSelling", "=", 0]
       ])
       ->orderByRaw("kill_count desc, exp desc")
       ->get();

       $SellingChars = GameCharacters::selectRaw("
        flag,
        id,
        name,
        ctype_id,
        exp,
        kill_count,
        killed_count,
        level,
        case when (ctype_id = 196869) then 'Human Female' when (ctype_id = 196993) then 'Human Male' when (ctype_id = 196870) then 'Guardian Female' when (ctype_id = 196994) then 'Guardian Male' when (ctype_id = 196871) then 'Defender Female' when (ctype_id = 196995) then 'Defender Male' when (ctype_id = 197133) then 'Elf Female' when (ctype_id = 197257) then 'Elf Male' when (ctype_id = 197134) then 'Priest Female' when (ctype_id = 197258) then 'Priest Male' when (ctype_id = 197135) then 'Templar Female' when (ctype_id = 197259) then 'Templar Male' when (ctype_id = 197653) then 'Half Elf Female' when (ctype_id = 197777) then 'Half Elf Male' when (ctype_id = 197654) then 'Ranger Female' when (ctype_id = 197778) then 'Ranger Male' when (ctype_id = 197655) then 'Scout Female' when (ctype_id = 197779) then 'Scout Male' when (ctype_id = 200741) then 'Giant Female' when (ctype_id = 200865) then 'Giant Male' when (ctype_id = 200742) then 'Berserker Female' when (ctype_id = 200866) then 'Berserker Male' when (ctype_id = 200743) then 'Savage Female' when (ctype_id = 200867) then 'Savage Male' when (ctype_id = 198685) then 'Dhan Female' when (ctype_id = 198809) then 'Dhan Male' when (ctype_id = 198686) then 'Avenger Female' when (ctype_id = 198810) then 'Avenger Male' when (ctype_id = 198687) then 'Predator Female' when (ctype_id = 198811) then 'Predator Male' when (ctype_id = 229437) then 'Dekan Female' when (ctype_id = 229561) then 'Dekan Male' when (ctype_id = 229438) then 'Dragon Knight Female' when (ctype_id = 229562) then 'Dragon Knight Male' when (ctype_id = 229439) then 'Dragon Sage Female' when (ctype_id = 229563) then 'Dragon Sage Male' when (ctype_id = 204845) then 'Dark Elf Female' when (ctype_id = 204969) then 'Dark Elf Male' when (ctype_id = 204846) then 'Warlock Female' when (ctype_id = 204970) then 'Warlock Male' when (ctype_id = 204847) then 'Wizard Female' when (ctype_id = 204971) then 'Wizard Sage Male'    end as Class
       ")
       ->join("TCharacterStatus", "TCharacterStatus.char_id", "TCharacter.id")
       ->join("TCharacterAbility", "TCharacterAbility.char_id", "TCharacter.id")
       ->where([
           ["user_id", "=", CusAuth::user()->user_id],
           ["isSelling", "=", 1]
       ])
       ->orderByRaw("kill_count desc, exp desc")
       ->get();
       
       return view('modules.Profile', compact('Characters', 'points', 'SellingChars', 'gc', 'referral_link', 'referrals'));

    }

    public function renderSelling($id){

        $Character = GameCharacters::selectRaw("
        flag,
        id,
        name,
        ctype_id,
        exp,
        kill_count,
        killed_count,
        level,
        case when (ctype_id = 196869) then 'Human Female' when (ctype_id = 196993) then 'Human Male' when (ctype_id = 196870) then 'Guardian Female' when (ctype_id = 196994) then 'Guardian Male' when (ctype_id = 196871) then 'Defender Female' when (ctype_id = 196995) then 'Defender Male' when (ctype_id = 197133) then 'Elf Female' when (ctype_id = 197257) then 'Elf Male' when (ctype_id = 197134) then 'Priest Female' when (ctype_id = 197258) then 'Priest Male' when (ctype_id = 197135) then 'Templar Female' when (ctype_id = 197259) then 'Templar Male' when (ctype_id = 197653) then 'Half Elf Female' when (ctype_id = 197777) then 'Half Elf Male' when (ctype_id = 197654) then 'Ranger Female' when (ctype_id = 197778) then 'Ranger Male' when (ctype_id = 197655) then 'Scout Female' when (ctype_id = 197779) then 'Scout Male' when (ctype_id = 200741) then 'Giant Female' when (ctype_id = 200865) then 'Giant Male' when (ctype_id = 200742) then 'Berserker Female' when (ctype_id = 200866) then 'Berserker Male' when (ctype_id = 200743) then 'Savage Female' when (ctype_id = 200867) then 'Savage Male' when (ctype_id = 198685) then 'Dhan Female' when (ctype_id = 198809) then 'Dhan Male' when (ctype_id = 198686) then 'Avenger Female' when (ctype_id = 198810) then 'Avenger Male' when (ctype_id = 198687) then 'Predator Female' when (ctype_id = 198811) then 'Predator Male' when (ctype_id = 229437) then 'Dekan Female' when (ctype_id = 229561) then 'Dekan Male' when (ctype_id = 229438) then 'Dragon Knight Female' when (ctype_id = 229562) then 'Dragon Knight Male' when (ctype_id = 229439) then 'Dragon Sage Female' when (ctype_id = 229563) then 'Dragon Sage Male' when (ctype_id = 204845) then 'Dark Elf Female' when (ctype_id = 204969) then 'Dark Elf Male' when (ctype_id = 204846) then 'Warlock Female' when (ctype_id = 204970) then 'Warlock Male' when (ctype_id = 204847) then 'Wizard Female' when (ctype_id = 204971) then 'Wizard Sage Male'    end as Class
       ")
       ->join("TCharacterStatus", "TCharacterStatus.char_id", "TCharacter.id")
       ->join("TCharacterAbility", "TCharacterAbility.char_id", "TCharacter.id")
       ->where([
           ["user_id", "=", CusAuth::user()->user_id],
           ["id", "=", STR_ENC::exec('decrypt', $id)],
       ])
       ->orderByRaw("kill_count desc, exp desc")
       ->get();

        return view('modules.renderSelling', compact('Character'));   
    }

    public function doSelling(Request $request){

        $Character = GameCharacters::selectRaw("
        flag,
        id,
        name,
        ctype_id,
        exp,
        kill_count,
        killed_count,
        level,
        case when (ctype_id = 196869) then 'Human Female' when (ctype_id = 196993) then 'Human Male' when (ctype_id = 196870) then 'Guardian Female' when (ctype_id = 196994) then 'Guardian Male' when (ctype_id = 196871) then 'Defender Female' when (ctype_id = 196995) then 'Defender Male' when (ctype_id = 197133) then 'Elf Female' when (ctype_id = 197257) then 'Elf Male' when (ctype_id = 197134) then 'Priest Female' when (ctype_id = 197258) then 'Priest Male' when (ctype_id = 197135) then 'Templar Female' when (ctype_id = 197259) then 'Templar Male' when (ctype_id = 197653) then 'Half Elf Female' when (ctype_id = 197777) then 'Half Elf Male' when (ctype_id = 197654) then 'Ranger Female' when (ctype_id = 197778) then 'Ranger Male' when (ctype_id = 197655) then 'Scout Female' when (ctype_id = 197779) then 'Scout Male' when (ctype_id = 200741) then 'Giant Female' when (ctype_id = 200865) then 'Giant Male' when (ctype_id = 200742) then 'Berserker Female' when (ctype_id = 200866) then 'Berserker Male' when (ctype_id = 200743) then 'Savage Female' when (ctype_id = 200867) then 'Savage Male' when (ctype_id = 198685) then 'Dhan Female' when (ctype_id = 198809) then 'Dhan Male' when (ctype_id = 198686) then 'Avenger Female' when (ctype_id = 198810) then 'Avenger Male' when (ctype_id = 198687) then 'Predator Female' when (ctype_id = 198811) then 'Predator Male' when (ctype_id = 229437) then 'Dekan Female' when (ctype_id = 229561) then 'Dekan Male' when (ctype_id = 229438) then 'Dragon Knight Female' when (ctype_id = 229562) then 'Dragon Knight Male' when (ctype_id = 229439) then 'Dragon Sage Female' when (ctype_id = 229563) then 'Dragon Sage Male' when (ctype_id = 204845) then 'Dark Elf Female' when (ctype_id = 204969) then 'Dark Elf Male' when (ctype_id = 204846) then 'Warlock Female' when (ctype_id = 204970) then 'Warlock Male' when (ctype_id = 204847) then 'Wizard Female' when (ctype_id = 204971) then 'Wizard Sage Male'    end as Class
       ")
       ->join("TCharacterStatus", "TCharacterStatus.char_id", "TCharacter.id")
       ->join("TCharacterAbility", "TCharacterAbility.char_id", "TCharacter.id")
       ->where([
           ["user_id", "=", CusAuth::user()->user_id],
           ["id", "=", STR_ENC::exec('decrypt', $request->input('0xCH'))],
       ])
       ->get();

       $ec = EMChars::create([
        "Char_id" => STR_ENC::exec('decrypt', $request->input('0xCH')), 
        "Char_Name" => $Character[0]->name, 
        "Char_type" => $Character[0]->ctype_id, 
        "Char_exp" => $Character[0]->exp, 
        "Char_kill_count" => $Character[0]->kill_count, 
        "Char_Killed_count" => $Character[0]->killed_count, 
        "Char_level" => $Character[0]->level, 
        "Char_flag" => $Character[0]->flag, 
        "Char_class" => $Character[0]->Class, 
        "Char_Seller" => CusAuth::user()->user_id, 
        "Char_Price" => $request->input('char_price'), 
        "Char_Description" => $request->input('char_description')
       ]);  

       if($ec) {
            GameCharacters::where([
                ["user_id", "=", CusAuth::user()->user_id],
                ["id", "=", STR_ENC::exec('decrypt', $request->input('0xCH'))],
            ])->update(array(
                'isSelling' => 1
            ));

            return redirect('/User/profile')->with('SuccessMessage', $Character[0]->name . ' was successfully posted to exchange market');
       }

       return redirect()->back()->with('ErrorMessage', 'Error, Please Try Again');

    }

    public function unsealedChar(Request $request) {
        GameCharacters::where([
            ["user_id", "=", CusAuth::user()->user_id],
            ["id", "=", STR_ENC::exec('decrypt', $request->input('char_id'))],
        ])->update(array(
            'flag' => 0
        ));

        return response([
            "success" => true
        ]);
    }

    public function removeFromExm(Request $request){
        $ec = EMChars::where([
            ["Char_Seller", "=", CusAuth::user()->user_id],
            ["Char_id", "=", STR_ENC::exec('decrypt', $request->input('char_id'))],
        ])->delete();

        if($ec) {
            GameCharacters::where([
                ["user_id", "=", CusAuth::user()->user_id],
                ["id", "=", STR_ENC::exec('decrypt', $request->input('char_id'))],
            ])->update(array(
                'isSelling' => 0
            ));

            return response([
                "success" => true
            ]);
        }

        return response([
            "success" => false
        ]);

    }


    public function ChangePassword(Request $request) {

        $pw = RohanUser::where("user_id", CusAuth::user()->user_id)->get();

        if($pw[0]->login_pw !== md5($request->input('oldPass'))) {
            //return redirect()->back()->with("errorNE", "Old Password is incorrect");
            return response([
                "success" => false,
                "message" => 'Old Password is incorrect'
            ]);
        }

        if($request->input('newPass') != $request->input('confirmPass')) {
            //return redirect()->back()->with("errorNE", "Password is not matched");    
            return response([
                "success" => false,
                "message" => 'Passwords are not matched'
            ]);
        }

        RohanUser::where("user_id", CusAuth::user()->user_id)->update(array(
            "login_pw" => md5($request->input('newPass')),
            "login_pw2" => $request->input('newPass')
        ));

        if($request->ajax()){
            return response([
                "success" => true
            ]);
        }
          
        
    }
}
