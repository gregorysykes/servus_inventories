<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Packaging;

class OutgoingExcel implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $month;
    public function __construct($month){
        $this->month = $month;
    }
    public function collection()
    {
        //
        $array = array();
        $month = $this->month;
        $packagings = Packaging::whereMonth('created_at',$month)->where('status','done')->get();

        foreach($packagings as $pack){
            $customer = $pack->name;
            $date = date('d/m/y', strtotime($pack->created_at));
            $no = $pack->no;
            foreach($pack->detail_packagings as $dp){
                $item = $dp->process->detail_transaction->item->name;
                $quantity = $dp->quantity;
                array_push($array,['no'=>$no,'date'=>$date, 'customer'=>$customer,'item'=>$item,'quantity'=>$quantity]);
            }

        }
        return collect($array);

    }
}
