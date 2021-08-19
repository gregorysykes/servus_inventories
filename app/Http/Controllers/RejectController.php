<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Reject;
use App\Models\Process;

class RejectController extends Controller
{
    //
    public function index(){
        $rejects = Reject::orderBy('status','desc')->get();
        $states = State::all();
        return view('livewire.rejects.show')->with('rejects',$rejects)->with('states',$states);
    }
    public function update(Request $req){
        // dd($req->state_id);
        $reject = Reject::find($req->id);
        
        //edit reject
        $reject->quantity -= $req->quantity;
        $reject->save();

        if($reject->quantity == 0){
            $reject->status = 'done';
            $reject->save();
        }

        // $log = new Log;
        // $log->detail_transaction_id = $process->detail_transaction_id;
        // $log->state_id = $state_id;
        // $log->state_to = $s->state;
        // $log->actual = $actual;
        // $log->expected = $expected;
        // $log->save();

        //set to process
        // $process = new Process;
        // $process->detail_transaction_id = $reject->detail_transaction_id;
        // $process->balance = $req->quantity;
        // $process->quantity = $req->quantity;
        // $process->state_id = $req->state_id;
        // $process->status = 'on process';
        // $process->save();

        if($reject->process){
            $process = Process::find($reject->process_id);
            $process->balance += $req->quantity;
            $process->quantity += $req->quantity;
            $process->save();
        }else{
            $process = new Process;
            $process->detail_transaction_id = $reject->detail_transaction_id;
            $process->balance = $req->quantity;
            $process->quantity = $req->quantity;
            $process->state_id = $req->state_id;
            $process->status = 'on process';
            $process->save();
        }
        return redirect('/rejects');
    }
}
