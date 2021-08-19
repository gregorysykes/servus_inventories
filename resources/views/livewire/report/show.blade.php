{{-- <div>
    To attain knowledge, add things every day; To attain wisdom, subtract things every day
</div> --}}

<x-app-layout>
    <x-slot name="title">
        Report
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="nav nav-justified nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                                <a class="nav-link text-secondary active small" id="v-pills-transaction-tab" data-toggle="pill" href="#v-pills-transaction" role="tab" aria-controls="v-pills-transaction" aria-selected="false">{{__('Incoming Transaction')}}</a>
                                <a class="nav-link text-secondary small" id="v-pills-packaging-tab" data-toggle="pill" href="#v-pills-packaging" role="tab" aria-controls="v-pills-packaging" aria-selected="false">{{__('Outgoing Transaction')}}</a>
                                <a class="nav-link text-secondary small" id="v-pills-item-tab" data-toggle="pill" href="#v-pills-item" role="tab" aria-controls="v-pills-item" aria-selected="false">{{__('Item')}}</a>
                                <a class="nav-link text-secondary small" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab" aria-controls="v-pills-customer" aria-selected="true">{{__('Customer')}}</a>
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                
                                <div class="tab-pane fade show active" id="v-pills-transaction" role="tabpanel" aria-labelledby="v-pills-transaction-tab">
                                    <div class="row pb-3 pt-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="transactionTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('Month')}}</th>
                                                        <th>{{__('Transaction')}}</th>
                                                        <th>{{__('Expected')}}</th>
                                                        <th>{{__('Processed')}}</th>
                                                        <th>{{__('Claimed')}}</th>
                                                        <th>{{__('Rejects')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < count($incomes); $i++)
                                                            @if ($incomes[$i]['total_transactions']!=0)
                                                                <tr>
                                                                    <td>{{$incomes[$i]['month']}}</td>
                                                                    <td>{{$incomes[$i]['total_transactions']}}</td>
                                                                    <td>{{$incomes[$i]['total_expected']}}</td>
                                                                    <td>{{$incomes[$i]['quantity']}}</td>
                                                                    <td class="text-warning">({{$incomes[$i]['claim']}})</td>
                                                                    <td class="text-danger">({{$incomes[$i]['rejects']}})</td>
                                                                    <td class="d-flex d-inline">
                                                                        <a href="/incomingExcel/{{$incomes[$i]['month']}}" class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="tab-pane fade show" id="v-pills-packaging" role="tabpanel" aria-labelledby="v-pills-packaging-tab">
                                    <div class="row pb-3 pt-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="packagingTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('Month')}}</th>
                                                        <th>{{__('Transaction')}}</th>
                                                        <th>{{__('Outgoing')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < count($incomes); $i++)
                                                            @if ($incomes[$i]['total_transactions']!=0)
                                                                <tr>
                                                                    <td>{{$incomes[$i]['month']}}</td>
                                                                    <td>{{$incomes[$i]['total_transactions']}}</td>
                                                                    <td>{{$incomes[$i]['quantity']}}</td>
                                                                    <td class="d-flex d-inline">
                                                                        <a href="/outgoingExcel/{{$incomes[$i]['month']}}" class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                
                                <div class="tab-pane fade show" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
                                    <div class="row pb-3 pt-3">
                                        <div class="col-12 text-right">
                                            <a href="" class="btn btn-success"><i class="fa fa-file-excel"></i>&ensp;Download Full Excel File</a>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="itemTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('Month')}}</th>
                                                        <th>{{__('Item')}}</th>
                                                        <th>{{__('Incoming')}}</th>
                                                        <th>{{__('Outgoing')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 0; $i < count($items); $i++)
                                                            <tr>
                                                                <td>{{$items[$i]['month']}}</td>
                                                                <td>{{$items[$i]['item_name']}}</td>
                                                                <td>{{$items[$i]['item_incoming']}}</td>
                                                                <td>{{$items[$i]['item_outgoing']}}</td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade show " id="v-pills-customer" role="tabpanel" aria-labelledby="v-pills-customer-tab">
                                    <div class="row pb-3 pt-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="customerTable" width="100%" cellspacing="0">
                                                    <thead>
                                                      <tr>
                                                        <th>{{__('Date')}}</th>
                                                        <th>{{__('Customer Name')}}</th>
                                                        <th>{{__('Total Items')}}</th>
                                                        <th>{{__('Action')}}</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($transactions as $transaction)
                                                        <tr>
                                                            <td>{{date('d M Y', strtotime($transaction->created_at))}}</td>
                                                            <td>{{$transaction->customer}}</td>
                                                            <td>{{$transaction->detail_transactions->sum('quantity')}}</td>
                                                            <td>
                                                                <button class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
                
                            </div>
                        </div>
                    </div>
                    
                </div>                
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready( function () {
        $('#itemTable').DataTable();
        $('#customerTable').DataTable();
        $('#packagingTable').DataTable();
        $('#transactionTable').DataTable();
    } );
</script>
