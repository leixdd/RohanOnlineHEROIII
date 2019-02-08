<?php

namespace App\Http\Controllers\Rewards;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Rewards;
use CusAuth;

class rewardsys extends Controller
{
    public function __construct() {
        $this->middleware('cusauth');
    }

    public function index() {
        //SELECT *, (SELECT COUNT(*) FROM RohanRFS.dbo.tbl_rw_logs WHERE reward_id = rds.reward_id) as countReward  FROM RohanRFS.dbo.tbl_rewards rds;
        $rewards = \DB::connection('rohan_rfs')->select("
        SELECT *, (SELECT COUNT(*) FROM RohanRFS.dbo.tbl_rw_logs WHERE reward_id = rds.reward_id) as countReward  
        FROM RohanRFS.dbo.tbl_rewards rds");

        return view('modules.rewards', compact('rewards'));
    }

    public function getReward(Request $request) {
        
    }
}
