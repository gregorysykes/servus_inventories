<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Transaction;
use DateTime;
use Carbon\Carbon;

class IncomingExport implements FromCollection, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // use Exportable;

    public $month;
    public function __construct($month){
        $this->month = $month;
    }

    public function collection()
    {
        // $income = array();
        // $total = 0;
        $month = $this->month;
        // $trans = 0;
        // $claim = 0;
        // $rejects = 0;
        // $ts = Transaction::whereMonth('created_at','=',$month)->where('status','done')->get();
        // foreach($ts as $t){
        //     foreach($t->detail_transactions as $dt){
        //         for($j=0;$j<count($dt->logs);$j++){
        //             $claim += $dt->logs[$j]->expected - $dt->logs[$j]->actual;
        //         }
        //         $rejects += $dt->rejects->sum('quantity');
                
        //         foreach($dt->processes as $p){
        //             $total += $p->detail_packagings->sum('quantity');
        //         }
        //     }
        //     $trans++;
        // }
        // $m = DateTime::createFromFormat('!m', $month);
        // $monthName = $m->format('F');
        // array_push($income,['month'=>$monthName,'total_transactions'=>$trans,'quantity'=>$total,'claim'=>$claim,'rejects'=>$rejects]);

        // return collect($income);

        $transactions = Transaction::whereMonth('created_at',$month)->where('status','done')->get();
        $trans = array();
        foreach($transactions as $transaction){
            $details = array();
            foreach($transaction->detail_transactions as $dt){
                $processed = 0;
                $rejects = 0;
                foreach($dt->processes as $process){
                    $processed = $process->detail_packagings->sum('quantity');
                }
                $rejects = $dt->rejects->sum('quantity');
                $item = $dt->item->name;
                $quantity = $dt->quantity;
                
                $claimed = $quantity-$processed-$rejects;
                array_push($trans,['no'=>$transaction->no,'customer'=>$transaction->customer,'date'=>date('d/m/y', strtotime($transaction->created_at)),'item'=>$item,'quantity'=>$quantity,'processed'=>$processed,'rejects'=>$rejects,'claimed'=>$claimed]);
            }
        }

        return collect($trans);


    }
}
