{{-- <div>
    The whole world belongs to you
</div> --}}
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="text-2xl">
        {{ __('All Transactions') }}
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="table-responsive">
                    <table class="table table-bordered" id="transactionTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th class="">{{__('Transaction No.')}}</th>
                            <th class="">{{__('Customer Name')}}</th>
                            <th class="">{{__('Status')}}</th>
                            <th>{{__('Entry Date')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr data-toggle="modal" data-target="#showTransactionModal{{$transaction->id}}">
                                <td>
                                    {{$transaction->no}}
                                    @if($transaction->claim)
                                        <i class="fa fa-circle text-success fa-xs"></i>
                                    @else
                                        @php
                                            $kkk = 0;
                                        @endphp
                                        @foreach($transaction->detail_transactions as $d)
                                            @foreach($d->processes as $process)
                                                @if($transaction->status != 'done')
                                                    @if($process->state->state != 'Warehouse' && $process->state->state != 'Assembly')
                                                        @php
                                                            $kkk+=1;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if($kkk == count($transaction->detail_transactions))
                                                <i class="fa fa-circle text-danger fa-xs"></i>
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                    
                                </td>
                                <td>{{$transaction->customer}}</td>
                                @if($transaction->status == 'accepted')
                                    <td><span class="badge badge-primary">{{$transaction->status}}</span></td>
                                @elseif($transaction->status == 'process')
                                    <td><span class="badge badge-warning">{{$transaction->status}}</span></td>
                                @elseif($transaction->status == 'done')
                                    <td><span class="badge badge-success">{{$transaction->status}}</span></td>
                                @endif
                                <td>{{date('d/m/y', strtotime($transaction->created_at))}}</td>
                            </tr>
                            {{-- View Transaction Modal --}}
                            <div class="modal fade" id="showTransactionModal{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="showTransactionModal{{$transaction->id}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="showTransactionModal{{$transaction->id}}Label">
                                                <i class="fa fa-credit-card"></i>&ensp;{{__('View Transaction') }}
                                            </h5>
                                            
                                                @if($transaction->status == 'accepted')
                                                    <span class="badge badge-primary mt-1 ml-3">{{$transaction->status}}</span>
                                                @elseif($transaction->status == 'process')
                                                    <span class="badge badge-warning mt-1 ml-3">{{$transaction->status}}</span>
                                                @elseif($transaction->status == 'done')
                                                    <span class="badge badge-success mt-1 ml-3">{{$transaction->status}}</span>
                                                @endif
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <small class="small d-block">{{__('Transaction No.')}}</small>
                                                    <strong>{{$transaction->no}}</strong>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <small class="d-block">{{__('Packaging No.')}}</small>
                                                    <strong>{{$transaction->no_out}}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <small class="small d-block">{{__('Customer')}}</small>
                                                    <strong>{{$transaction->customer}}</strong>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <small class="d-block">{{__('Entry Date')}}</small>
                                                    <strong>{{date('d M Y H:i:s',strtotime($transaction->created_at))}}</strong>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12"><hr></div>
                                            </div>
                                            <div class="row">
                                                {{-- item name --}}
                                                <div class="col d-none d-lg-block">
                                                    <strong>{{__('Item Name')}}</strong>
                                                </div>
                                                <div class="col-2 d-block d-lg-none">
                                                    <strong>{{__('Item')}}</strong>
                                                </div>
                                                {{-- item name --}}
                                                <div class="col-lg col-3">
                                                    <strong>{{__('Quantity')}}</strong>
                                                </div>
                                                <div class="col-lg col-4">
                                                    <strong>{{__('Process')}}</strong>
                                                </div>
                                                <div class="col-lg col-4">
                                                    <strong>{{__('Supplier')}}</strong>
                                                </div>
                                                <div class="col-lg col-3">
                                                    <strong>{{__('Remarks')}}</strong>
                                                </div>
                                            </div>
                                            {{-- Detail Transaction --}}
                                            @foreach($transaction->detail_transactions as $detail)
                                                <div class="row mt-2">
                                                    {{-- item name --}}
                                                    <div class="col d-none d-lg-block">
                                                        {{$detail->item->name}}
                                                    </div>
                                                    <div class="col-2 d-block d-lg-none small">
                                                        {{$detail->item->name}}
                                                    </div>
                                                    {{-- item name --}}
                                                    {{-- item quantity --}}
                                                    <div class="col d-none d-lg-block">
                                                        {{$detail->quantity}} {{__('Items')}}
                                                    </div>
                                                    <div class="col-3 d-block d-lg-none small">
                                                        {{$detail->quantity}} {{__('Items')}}
                                                    </div>
                                                    <div class="col-lg col-4">
                                                        @foreach($detail->processes->sortBy('state_id') as $process)
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    @if($process->state->state != 'Pack Warehouse' || $process->quantity != 0)
                                                                        <small>{{$process->state->state}}</small>
                                                                    @endif
                                                                </div>
                                                                <div class="col-5">
                                                                    @if($process->state->state != 'Pack Warehouse' || $process->quantity != 0)
                                                                        <span class="badge badge-primary">{{$process->quantity}}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <small>{{__('Pack')}}</small>
                                                            </div>
                                                            <div class="col-5">
                                                                @php
                                                                    $qty = 0;
                                                                @endphp
                                                                @foreach($detail->processes as $process)
                                                                    @if($process->detail_packagings)
                                                                        @for($i=0;$i<count($process->detail_packagings);$i++)
                                                                            @php
                                                                                $qty += $process->detail_packagings[$i]->quantity
                                                                            @endphp
                                                                        @endfor
                                                                        @if($qty != 0)
                                                                            <span class="badge badge-info">{{$qty}}</span>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <small>{{__('Reject')}}</small>
                                                            </div>
                                                            <div class="col-5">
                                                                @php
                                                                    $r = 0
                                                                @endphp
                                                                @if($detail->rejects)
                                                                    @for($i=0;$i<count($detail->rejects);$i++)
                                                                        @php
                                                                            $r += $detail->rejects[$i]->quantity;
                                                                        @endphp
                                                                    @endfor
                                                                    @if($r != 0)
                                                                        <span class="badge badge-danger">{{$r}}</span>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-7">
                                                                <small>{{__('Claim')}}</small>
                                                            </div>
                                                            <div class="col-5">
                                                                @php
                                                                    $claim = 0;
                                                                @endphp
                                                                @if($detail->logs)
                                                                    @for($i=0;$i<count($detail->logs);$i++)
                                                                        @php
                                                                            $claim += $detail->logs[$i]->expected - $detail->logs[$i]->actual
                                                                        @endphp
                                                                    @endfor
                                                                    <span class="badge badge-warning">{{$claim}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg col-4">
                                                        {{$detail->supplier}}
                                                    </div>
                                                    <div class="col-lg col-3">
                                                        {{$detail->remarks}}
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{-- End of Detail Transaction --}}
                                        </div>
                                        <div class="modal-footer">
                                            <form action="/cancel-transaction" method="POST">
                                                @csrf
                                                <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
                                                <x-jet-button wire:loading.attr="disabled" wire:target="photo" class="bg-warning text-dark">
                                                    <i class="fa fa-times"></i>&ensp;{{__('Cancel')}}
                                                </x-jet-button>
                                            </form>
                                            @if(!$transaction->claim)
                                                @php
                                                    $f = 0;
                                                @endphp
                                                @foreach($transaction->detail_transactions as $d)
                                                    @foreach($d->processes as $process)
                                                        @if($transaction->status != 'done')
                                                            @if($process->state->state != 'Warehouse' && $process->state->state != 'Assembly')
                                                                @php
                                                                    $f+=1;
                                                                @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @if($f == count($transaction->detail_transactions))
                                                            <form action="/set-claim" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
                                                                <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                                                                    <i class="fa fa-check"></i>&ensp;{{__('Claimed')}}
                                                                </x-jet-button>
                                                            </form>
                                                        @break
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End of View Transaction Modal --}}
                        @endforeach
                        </tbody>
                    </table>
                </div>

                
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#transactionTable').DataTable();
    } );
  </script>
  