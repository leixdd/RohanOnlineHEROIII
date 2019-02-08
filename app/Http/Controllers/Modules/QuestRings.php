<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GameCharLogin;
use DB;
use STR_ENC;

class QuestRings extends Controller
{
    public function __construct(){
        //TODO: Don't forget to uncomment
        $this->middleware('cusauth');
    }

    public function index() {
        $values = [41579, 2753088, 2813581];
        $returnvalue = DB::connection('rohan_game')->select('EXEC _BLKMN_QuestRing ?,?,?', $values);

        dd($returnvalue);
    }

    public function getAllQuestRings() {
        
    }

    public function submitQuestAcce(Request $request) {
        $values = [STR_ENC::exec('decrypt', $request->input('char_id')), STR_ENC::exec('decrypt', $request->input('boss_id')), STR_ENC::exec('decrypt', $request->input('acce_id'))];
        $returnvalue = DB::connection('rohan_game')->select('EXEC _BLKMN_QuestRing ?,?,?', $values);

        if($returnvalue) {

            if($request->ajax()){
                return response([
                    "success" => true,
                    "message" => json_encode($returnvalue)
                ]);
            }

        }

        return response([
            "success" => false,
            "message" => 'An error occurred'
        ]);

    }
}
