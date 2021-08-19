<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\State;
use App\Models\Process;
use App\Models\Reject;
use App\Models\Packaging;
use App\Models\Log;
use App\Models\DetailPackaging;

class ProcessController extends Controller
{
    
    public function process(Request $req){
        
        $expected = 0;
        $actual = 0;
        

        $process = Process::find($req->process_id);
        $state_id = $process->state_id;

        if($process->state->state != 'Assembly'){
            $expected = $req->total;
            $actual = $req->total;
        }else{
            $validated = $req->validate([
                'expected' => 'required|numeric',
                'actual' => 'required|numeric',
            ]);
            $expected = $req->expected;
            $actual = $req->actual;
        }

        $s = State::find($req->state);

        $log = new Log;
        $log->detail_transaction_id = $process->detail_transaction_id;
        $log->state_id = $state_id;
        $log->state_to = $s->state;
        // $log->balance -= $expected;
        $log->actual = $actual;
        $log->expected = $expected;
        $log->save();

        $process->balance -= $expected;
        $process->quantity -= $expected-$actual;
        $process->save();



        $detail_transaction_id = $process->detail_transaction_id;

        $dt = DetailTransaction::find($detail_transaction_id);
        $transaction = Transaction::find($dt->transaction_id);

        $transaction->status = 'process';
        $transaction->save();
        if($req->bs){
            $reject = new Reject;
            $reject->process_id = $req->process_id;
            $reject->detail_transaction_id = $process->detail_transaction_id;
            $reject->state_id = $process->state_id;
            $reject->quantity = $req->total;
            $reject->type = 'bredel';
            $reject->remarks = $req->remarks;
            $reject->save();

            $temp_state = State::where('state','BS')->first();
            $log->state_to = $temp_state->state;
            $log->save();
            
            $process = Process::find($req->process_id);
            $process->quantity -= $req->total;
            // $process->balance -= $req->total;
            $process->save();

            return redirect('/stock');
        }
        
        //if all is clear then delete current process
        if($process->quantity == $req->total){
            if($process->state_id == $req->state){
                $process->balance += $expected;
                $process->remarks = $req->remarks;
                $process->team_id = $req->team;
                $process->save();
                return redirect('/stock');
            }else{
                $process->delete();
            }
        }else{
            $process->quantity -= $req->total;
            $process->save();
        }
        
        // process
        //find if other process is already available
        $x = Process::where('detail_transaction_id',$detail_transaction_id)->where('state_id',$req->state)->first();

        //if there is item is already in another process
        if($x){
            $x->quantity += $req->total;
            $x->balance += $req->total;
            $x->save();
        }
        //if not found, create new
        else{
            $new_process = new Process;
            $new_process->detail_transaction_id = $detail_transaction_id;
            $new_process->balance = $req->total;
            $new_process->state_id = $req->state;
            $new_process->team_id = $req->team;
            $new_process->quantity = $req->total;
            $new_process->remarks = $req->remarks;
            $new_process->status = 'on process';
            $new_process->save();
            
            // $log->balance = $req->total;
            $log->save();
        }

        // end of process

        return redirect('/stock');
    }
    public function add(Request $req){
        $process = new Process;
        $process->detail_transaction_id = $detail_transaction_id;
        $process->state_id = $req->state_id;
        $process->quantity = $req->quantity;
        $process->status = $req->status;
        $process->save();

        return redirect('/stock');
    }
    public function update(Request $req){
        $process = Process::find($req->id);
        $process->detail_transaction_id = $detail_transaction_id;
        $process->state_id = $req->state_id;
        $process->quantity = $req->quantity;
        $process->status = $req->status;
        $process->save();

        return redirect('/stock');
    }
    public function delete(Request $req){
        $process = Process::find($req->id);
        $process->delete();

        return redirect('/stock');
    }
}
