<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GameCharactersRanking;

class Ranking extends Controller
{
 
    public function getRanking(){

        $ranking = GameCharactersRanking::selectRaw("
         TOP (50)
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
            ["level", ">=", "110"],
            ["isSelling", "=", 0],
            ["flag", "=", 0],
            ["name", "NOT like", "%!%"]
        ])
        ->orderByRaw("kill_count desc, exp desc")
        ->get();

        return view('modules.ranking', compact('ranking'));
    }
    
}
