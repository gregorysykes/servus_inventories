<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Packaging;
use App\Models\Process;
use App\Models\Item;
use DateTime;
use Excel;
use App\Exports\IncomingExport;
use App\Exports\OutgoingExcel;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    //
    public function index(){
        $income = array();
        $items = array();
        $transactions = Transaction::all();
        for($i=0;$i<12;$i++){
            $total = 0;
            $trans = 0;
            $claim = 0;
            $rejects = 0;
            $ts = Transaction::whereMonth('created_at','=',$i+1)->where('status','done')->get();
            foreach($ts as $t){
                foreach($t->detail_transactions as $dt){
                    for($j=0;$j<count($dt->logs);$j++){
                        $claim += $dt->logs[$j]->expected - $dt->logs[$j]->actual;
                    }

                    $rejects += $dt->rejects->sum('quantity');
                    
                    foreach($dt->processes as $p){
                        $total += $p->detail_packagings->sum('quantity');
                    }
                }
                $trans++;
            }


            $month = DateTime::createFromFormat('!m', $i+1);
            $monthName = $month->format('F');

            $expected = $total + $claim + $rejects;

            array_push($income,['month'=>$monthName,'total_expected'=>$expected,'total_transactions'=>$trans,'quantity'=>$total,'claim'=>$claim,'rejects'=>$rejects]);
        }

        $processes = Process::where('status','done')->get();
        
        for($i=0;$i<count($processes);$i++){
            $itemName = $processes[$i]->detail_transaction->item->name;
            $mos = date('F',strtotime($processes[$i]->detail_transaction->created_at));
            $itemIncoming = $processes[$i]->detail_transaction->quantity;
            $itemOutgoing = $processes[$i]->detail_packagings->sum('quantity');
            array_push($items, ['item_name'=>$itemName,'item_incoming'=>$itemIncoming,'item_outgoing'=>$itemOutgoing,'month'=>$mos]);       
        }

        $items = collect($items)->sortBy('item_name')->toArray();

        for($i=0;$i<count($items);$i++){
            if($i>0){
                if($items[$i-1]['item_name'] == $items[$i]['item_name']){
                    $items[$i-1]['item_incoming'] += $items[$i]['item_incoming'];
                    $items[$i-1]['item_outgoing'] += $items[$i]['item_outgoing'];
                    $items[$i]['item_incoming'] = 0;
                    $items[$i]['item_outgoing'] = 0;
                }
            }
        }

        for($i=0;$i<count($items);$i++){
            if($items[$i]['item_incoming']==0 && $items[$i]['item_outgoing']==0){
                array_splice($items,$i,1);
            }
        }

        
        return view('/livewire/report/show')->with('transactions',$transactions)->with('incomes',$income)->with('items',$items);
    }
    public function incomingExcel($mo){
        $date = date_parse($mo);
        $realMonth = $date['month'];

        return Excel::download(new IncomingExport($realMonth),$mo.'_barang_masuk.xlsx');
    }
    public function outgoingExcel($mo){
        $date = date_parse($mo);
        $realMonth = $date['month'];

        return Excel::download(new OutgoingExcel($realMonth),$mo.'_barang_keluar.xlsx');
    }
}
