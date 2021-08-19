<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Packaging;
use App\Models\DetailPackaging;
use App\Models\Process;
use App\Models\State;
use App\Models\Transaction;
use App\Models\Log;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class PackagingController extends Controller
{
    //
    public function index(){
        $packs = Packaging::all();
        $state = State::where('state','Pack Warehouse')->first();
        $processes = Process::where('state_id',$state->id)->where('quantity','>',0)->get();
        return view('livewire/packaging/show')->with('packagings',$packs)->with('processes',$processes);
    }

    public function getProcesses(){
        $names = array();
        $res = array();
        $state = State::where('state','Pack Warehouse')->first();
        $processes = Process::where('state_id',$state->id)->where('quantity','>',0)->get();
        
        for($i=0;$i<count($processes);$i++){
            $names = Arr::add($names,$i,$processes[$i]->detail_transaction->item->name);
        }
        array_push($res, $processes);
        array_push($res, $names);
        return response()->json($res);
    }

    public function packing(Request $req){
        $p = Process::find($req->process_id);
        $p->quantity -= $req->total/$req->per_pack;
        $p->remains = ($req->new_quantity * $req->per_pack) - $req->total;
        $p->save();
        $detail_transaction_id = $p->detail_transaction_id;

        $process = new Process;
        $process->detail_transaction_id = $detail_transaction_id;
        $process->state_id = $req->state;
        $process->quantity = 1;
        $process->per_pack = $req->total;
        $process->team_id = $req->team;
        $process->remarks = $req->remarks;
        $process->bs = null;
        $process->status = 'on process';
        $process->save();

        return redirect('/stock');
    }
    
    public function add(Request $req){
        // dd($req->check);

        $validated = $req->validate([
            'no' => 'required|unique:transactions|unique:packagings|max:255',
            'name' => 'required|max:255',
            'check' => 'required'
        ]);

        $p = new Packaging;
        $p->no = $req->no;
        $p->status = 'packing';
        $p->name = $req->name;
        $p->save();

        for($i=0;$i<count($req->process_id);$i++){
            if(isset($req->check[$req->process_id[$i]])){
                $detail = new DetailPackaging;
                $detail->packaging_id = $p->id;
                $detail->process_id = $req->process_id[$i];
                $detail->quantity = $req->quantity[$i];
                $detail->remarks = $req->remarks[$i];
                $detail->save();

                $pro = Process::find($req->process_id[$i]);
                $pro->quantity -= $req->quantity[$i];
                $pro->balance -= $req->quantity[$i];
                $pro->save();
            }


        }
        return redirect('/packaging');
    }

    public function update(Request $req){
        $packaging = Packaging::find($req->id);
        
        foreach($packaging->detail_packagings as $pack){
            $process = Process::find($pack->process_id);
            $process->status = 'done';
            $process->save();
        }
        $packaging->status = 'done';
        $packaging->save();

        

        return redirect('/packaging');
    }

    public function cancel(Request $req){
        $pack = Packaging::find($req->id);
        for($i=0;$i<count($pack->detail_packagings);$i++){
            $process = Process::find($pack->detail_packagings[$i]->process_id);
            $process->quantity += $pack->detail_packagings[$i]->quantity;
            $process->balance += $pack->detail_packagings[$i]->quantity;
            $process->save();
            $pack->detail_packagings[$i]->delete();
        }
        $pack->delete();
        return redirect('/packaging');
    }

    public function delete(Request $req){
        $p = Packaging::find($req->id);
        $p->delete();
        return redirect('/packaging');
    }
}
