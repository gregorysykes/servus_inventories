<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Process;
use App\Models\State;
use App\Models\Team;

class StockController extends Controller
{
    //
    public function index(){
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        $states = State::orderBy('sequence')->get();
        $processes = Process::where('status','on process')->get();
        $teams = Team::all();

        $arr = array();
        $final = array();

        foreach($processes as $process){
            array_push($arr, ['name'=>$process->detail_transaction->item->name, 'quantity'=>$process->balance]);
        }
        $arr = collect($arr)->sortBy('name')->reverse()->toArray();
        // for($i=0;$i<count($arr);$i++){
        //     if($arr[$i].name == $arr[$i+1].name){
        //         array_push($final,['name'=>$arr[$i+1].name]);
        //     }
        // }

        return view('/livewire/stocks/show')->with('transactions',$transactions)->with('states',$states)->with('processes',$processes)->with('teams',$teams);
    }
}



