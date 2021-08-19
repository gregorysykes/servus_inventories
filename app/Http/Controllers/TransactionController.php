<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Item;
use App\Models\Process;
use App\Models\State;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function index(){
        $transactions = Transaction::orderBy('created_at','desc')->get();
        $items = Item::all();
        $qty = 0;
        foreach($transactions as $transaction){
            if($transaction->status != 'done'){
                foreach($transaction->detail_transactions as $detail){
                    foreach($detail->processes as $process){
                        $qty += $process->quantity;
    
                        
                        foreach($process->detail_packagings as $pack){
                            if($pack->packaging->status == 'done'){
                                $qty = 0;
                            }else{
                                $qty += 1;
                            }
                        }
                    }
                }
                if($qty == 0){
                    $transaction->status = 'done';
                    $transaction->save();
                }
            }
        }
        
        return view('livewire/transactions/show')->with('items',$items)->with('transactions',$transactions);
    }
    public function add(Request $req){

        $validated = $req->validate([
            'no' => 'required|unique:transactions|max:255',
            'quantity' => 'required',
        ]);


        $transaction = new Transaction;
        $transaction->user_id = auth()->user()->id;
        $transaction->customer = $req->customer;
        $transaction->no = $req->no;
        $transaction->status = 'accepted';
        $transaction->save();
        
        for($i=0;$i<count($req->quantity);$i++){
            if($req->quantity[$i] != null){
                $detail = new DetailTransaction;
                $detail->item_id = $req->item_id[$i];
                $detail->transaction_id = $transaction->id;
                $detail->quantity = $req->quantity[$i]*$req->per_pack[$i];
                $detail->supplier = $req->supplier[$i];
                // $detail->remarks = $req->remarks[$i];
                $detail->save();

                $state = State::where('state','Warehouse')->first();

                $process = new Process;
                $process->detail_transaction_id = $detail->id;
                $process->balance = $req->quantity[$i]*$req->per_pack[$i];
                $process->state_id = $state->id;
                $process->quantity = $req->quantity[$i]*$req->per_pack[$i];
                // $process->per_pack = $req->per_pack[$i];
                $process->status = 'on process';
                $process->save();
            }
        }

    
        return back();
    }
    public function claim(Request $req){
        $transaction = Transaction::find($req->transaction_id);
        $transaction->claim = 'x';
        $transaction->save();
        return redirect('/transaction');
    }
    public function cancel(Request $req){
        $transaction = Transaction::find($req->transaction_id);
        for($i=0;$i<count($transaction->detail_transactions);$i++){
            for($j=0;$j<count($transaction->detail_transactions[$i]->processes);$j++){
                $transaction->detail_transactions[$i]->processes[$j]->delete();
            }
            for($j=0;$j<count($transaction->detail_transactions[$i]->rejects);$j++){
                $transaction->detail_transactions[$i]->rejects[$j]->delete();
            }
            for($j=0;$j<count($transaction->detail_transactions[$i]->logs);$j++){
                $transaction->detail_transactions[$i]->logs[$j]->delete();
            }
            $transaction->detail_transactions[$i]->delete();
        }
        $transaction->delete();
        return redirect('/transaction');
    }
}
