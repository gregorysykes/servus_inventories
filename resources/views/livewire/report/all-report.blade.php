{{-- <div>
    The Master doesn't talk, he acts.
</div> --}}
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="nav nav-justified nav-pills pt-2" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                <a class="nav-link text-secondary active small" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab" aria-controls="v-pills-customer" aria-selected="true">{{__('Customer')}}</a>
                <a class="nav-link text-secondary small" id="v-pills-transaction-tab" data-toggle="pill" href="#v-pills-transaction" role="tab" aria-controls="v-pills-transaction" aria-selected="false">{{__('Incoming Transaction')}}</a>
                <a class="nav-link text-secondary small" id="v-pills-packaging-tab" data-toggle="pill" href="#v-pills-packaging" role="tab" aria-controls="v-pills-packaging" aria-selected="false">{{__('Outcoming Transaction')}}</a>
                <a class="nav-link text-secondary small" id="v-pills-item-tab" data-toggle="pill" href="#v-pills-item" role="tab" aria-controls="v-pills-item" aria-selected="false">{{__('Item')}}</a>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-customer" role="tabpanel" aria-labelledby="v-pills-customer-tab">
                    <div class="row pb-3 pt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="customerTable" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Customer Name')}}</th>
                                        <th>{{__('Thickness')}}</th>
                                        <th>{{__('Total Transaction')}}</th>
                                        <th>{{__('Action')}}</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-print"></i></button>
                                            <button class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="v-pills-transaction" role="tabpanel" aria-labelledby="v-pills-transaction-tab">
                    <div class="row pb-3 pt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="transactionTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Month')}}</th>
                                        <th>{{__('Total')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactions as $transaction)
                                            <td>January</td>
                                            <td>82000000</td>
                                            <td>
                                                <button class="btn btn-warning"><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-primary"><i class="fa fa-print"></i></button>
                                                <button class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                                            </td>
                                        @endforeach
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
                                        <th>{{__('Total')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-warning"><i class="fa fa-eye"></i></button>
                                            <button class="btn btn-primary"><i class="fa fa-print"></i></button>
                                            <button class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade show" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
                    <div class="row pb-3 pt-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="itemTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Month')}}</th>
                                        <th>{{__('Item')}}</th>
                                        <th>{{__('Total')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-print"></i></button>
                                            <button class="btn btn-success"><i class="fa fa-file-excel"></i></button>
                                        </td>
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
<script>
    $(document).ready( function () {
        $('#itemTable').DataTable();
        $('#customerTable').DataTable();
        $('#packagingTable').DataTable();
        $('#transactionTable').DataTable();
    } );
</script>
  