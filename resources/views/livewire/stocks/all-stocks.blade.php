{{-- <div>
    The whole world belongs to you
</div> --}}
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="nav nav-justified nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                    <a class="nav-link text-secondary active small" id="v-pills-overall-tab" data-toggle="pill" href="#v-pills-overall" role="tab" aria-controls="v-pills-overall" aria-selected="true">Overall</a>
                    @foreach($states as $state)
                        <a class="nav-link text-secondary small" id="v-pills-{{$state->id}}-tab" data-toggle="pill" href="#v-pills-{{$state->id}}" role="tab" aria-controls="v-pills-{{$state->state}}" aria-selected="false">{{__($state->state)}}</a>
                    @endforeach
                  </div>
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-overall" role="tabpanel" aria-labelledby="v-pills-overall-tab">
                        <div class="row">
                            @foreach($states as $state)
                                <div class="col-12 col-lg-6">
                                    <h6 class="mt-2"><strong>{{$state->state}}</strong></h6>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable-{{$state->id}}" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>{{__('Item')}}</th>
                                                    <th>{{__('Quantity')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($state->processes->where('status', 'on process') as $process)
                                                <tr>
                                                    <td>{{$process->detail_transaction->item->name}}</td>
                                                    <td class="py-2 pr-2">{{number_format($process->balance)}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach($states as $state)
                        <div class="tab-pane fade" id="v-pills-{{$state->id}}" role="tabpanel" aria-labelledby="v-pills-{{$state->id}}-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dT-{{$state->id}}" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>{{__('No.')}}</th>
                                            <th>{{__('Item')}}</th>
                                            <th>{{__('Team')}}</th>
                                            <th>{{__('Quantity')}}</th>
                                            <th>{{__('Remarks')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($state->processes->where('status','on process') as $process)
                                        <tr>
                                            <td>
                                                {{$process->detail_transaction->transaction->no}}
                                            </td>
                                            <td>{{$process->detail_transaction->item->name}}</td>
                                            @if($process->team_id != null)
                                                <td>{{$process->team->name}}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            <td >{{number_format($process->balance)}}</td>
                                            <td>
                                                <small>
                                                    {{$process->remarks}}
                                                </small>
                                            </td>
                                            <td>
                                                <x-jet-button wire:loading.attr="disabled" wire:target="photo" data-toggle="modal" data-target="#showProcessAction{{$process->id}}" style="background-color:#6875f5">
                                                    <i class="fa fa-location-arrow"></i>
                                                </x-jet-button>
                                            </td>
                                        </tr>

                                        {{-- Process Action Modal --}}
                                        <div class="modal fade" id="showProcessAction{{$process->id}}" tabindex="-1" role="dialog" aria-labelledby="showProcessAction{{$process->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="showProcessAction{{$process->id}}Label">
                                                            <i class="fa fa-microchip"></i>&ensp;{{$state->state }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <form action="/process" method="post">
                                                            @csrf
                                                            <input type="hidden" name="process_id" value="{{$process->id}}">
                                                            <div class="col-lg-4 d-none d-lg-block">
                                                                <p>{{__('Specifications')}} <br><small>{{__('Quick specifications of ')}} <i>{{$process->detail_transaction->item->name}}</i></small></p>
                                                            </div>
                                                            <div class="col-lg-8 col-12">
                                                                <div class="row">
                                                                    <div class="col-lg-6 mt-2">
                                                                        <small class="small d-block">{{__('Item Name')}}</small>
                                                                        <strong>{{$process->detail_transaction->item->name}}</strong>
                                                                    </div>
                                                                    <div class="col-lg-6 mt-2">
                                                                        <small class="small d-block">{{__('Item Packing Standard')}}</small>
                                                                        <strong id="new_per_pack_text-{{$process->id}}">{{$process->detail_transaction->item->jigs}}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12"><hr></div>
                                                            <div class="col-lg-4 d-none d-lg-block">
                                                                <p>{{__('New State')}} <br><small>{{__('Set the next process state for ')}} <i>{{$process->detail_transaction->item->name}}</i></small></p>
                                                            </div>
                                                            <div class="col-lg-8 col-12">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <input type="hidden" name="per_box" id="per_box-{{$process->id}}" value="{{$process->detail_transaction->item->per_box}}">
                                                                        <small class="small d-block">{{__('Set State')}}</small>
                                                                        <select name="state" id="state-{{$process->id}}" class="form-control" required onchange="setState({{$process->id}})">
                                                                            @foreach($states as $statex)
                                                                                @if($statex->id == $state->id)
                                                                                    <option selected value="{{$statex->id}}">{{$statex->state}}</option>
                                                                                @else
                                                                                    <option value="{{$statex->id}}">{{$statex->state}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12"><hr></div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col text-center small">
                                                                        <strong>{{__('Date')}}</strong>
                                                                    </div>
                                                                    <div class="col text-center small">
                                                                        <strong>{{__('State')}}</strong>
                                                                    </div>
                                                                    <div class="col text-center small">
                                                                        <strong>{{__('Expected')}}</strong>
                                                                    </div>
                                                                    <div class="col text-center small">
                                                                        <strong>{{__('Actual')}}</strong>
                                                                    </div>
                                                                    <div class="col text-center small">
                                                                        <strong>{{__('Margin')}}</strong>
                                                                    </div>
                                                                    {{-- <div class="col-4 text-center small">
                                                                        <strong>{{__('Process')}}</strong>
                                                                    </div> --}}
                                                                </div>

                                                                
                                                                <div class="row p-3">
                                                                    <div class="col-12 overflow-auto border border-secondary" style="height:8em">
                                                                        @foreach($process->detail_transaction->logs as $log)
                                                                            <div class="row mt-2">
                                                                                <div class="col text-center small">
                                                                                    {{$log->created_at}}
                                                                                </div>
                                                                                <div class="col text-center small">
                                                                                    {{$log->state->state}} <i class="fa fa-xs fa-caret-right"></i> {{$log->state_to}}
                                                                                </div>
                                                                                <div class="col text-center small">
                                                                                    {{$log->expected}}
                                                                                </div>
                                                                                <div class="col text-center small">
                                                                                    {{$log->actual}}
                                                                                </div>
                                                                                <div class="col text-center small">
                                                                                    {{$log->expected-$log->actual}}
                                                                                </div>
                                                                                {{-- <div class="col-4 text-center small">
                                                                                    -
                                                                                </div> --}}
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>


                                                                <div class="row mt-2">
                                                                    {{-- <div class="col text-center small">
                                                                        {{__('Date')}}
                                                                    </div> --}}
                                                                    <div class="col text-center small">
                                                                        <label for="" class="small">{{__('Balance')}}</label><br>
                                                                        <strong>{{$process->balance}}</strong>
                                                                    </div>
                                                                    <div class="col small">
                                                                        <div class="form-group">
                                                                            <label for="expected" class="small">{{__('Expected')}}</label><br>
                                                                            @if($state->state == 'Assembly')
                                                                                <input type="number" class="form-control form-control-sm w-75 d-inline" id="expected-{{$process->id}}" required name="expected" min="1">
                                                                            @else
                                                                                <input type="number" class="form-control form-control-sm w-75 d-inline" id="expected-{{$process->id}}" disabled name="expected" min="1">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col small">
                                                                        <div class="form-group">
                                                                            <label for="actual" class="small">{{__('Actual')}}</label><br>
                                                                            @if($state->state == 'Assembly')
                                                                                <input type="number" class="form-control form-control-sm w-75 d-inline" id="actual-{{$process->id}}" required name="actual" onchange="changeActual({{$process->id}})" min="1">
                                                                            @else
                                                                                <input type="number" class="form-control form-control-sm w-75 d-inline" id="actual-{{$process->id}}" disabled name="actual" min="1">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    {{-- <div class="col text-center small">
                                                                        -
                                                                    </div> --}}
                                                                    <div class="col-4 small">
                                                                        <label for="" class="small">{{__('Process')}}</label>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <input type="number" class="form-control form-control-sm w-25 d-inline" id="quantity-{{$process->id}}" value="{{$process->quantity}}" onchange="changeTotal({{$process->id}})" min="1">
                                                                                <i class="fa fa-times text-secondary"></i>
                                                                                <input type="number" class="form-control form-control-sm w-25 d-inline" id="pack-{{$process->id}}" onchange="changeTotal({{$process->id}})" value="1" min="1">
                                                                                <i class="fa fa-caret-right text-primary"></i>
                                                                                <input type="number" class="form-control form-control-sm w-25 d-inline" name="total" id="total-{{$process->id}}" value="{{$process->quantity}}" max="{{$process->balance}}">
                                                                                <input type="hidden" name="qty" id="qty-{{$process->id}}" value="{{$process->quantity}}">
                                                                                <input type="hidden" name="remaining_items" id="remains-{{$process->id}}" value="0">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12"><hr></div>
                                                            <div class="col-lg-4 d-none d-lg-block">
                                                                <p>{{__('Team')}} <br><small>{{__('Set Team to handle ')}} <i>{{$process->detail_transaction->item->name}}</i></small></p>
                                                            </div>
                                                            <div class="col-lg-8 col-12">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <small class="small d-block">{{__('Set Team')}}</small>
                                                                        <select name="team" id="team" class="form-control" required>
                                                                            @if($process->team_id == null)
                                                                                <option value="">Select Team</i></option>
                                                                            @endif
                                                                            @foreach($teams as $team)
                                                                                @if($process->team_id != null)
                                                                                    @if($team->id == $process->team_id)
                                                                                        <option selected value="{{$team->id}}">{{$team->name}} - <i>{{$team->description}}</i></option>
                                                                                    @else
                                                                                        <option value="{{$team->id}}">{{$team->name}} - <i>{{$team->description}}</i></option>
                                                                                    @endif
                                                                                @else
                                                                                    <option value="{{$team->id}}">{{$team->name}} - <i>{{$team->description}}</i></option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-12"><hr></div>
                                                            <div class="col-lg-4 d-none d-lg-block">
                                                                <p>{{__('Remarks')}} <br><small>{{__('Add some info to make it easier to process')}}</small></p>
                                                            </div>
                                                            <div class="col-lg-8 col-12">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input" name="bs">
                                                                            <small class="form-check-label text-danger" for="exampleCheck1">BS?</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <small class="small d-block">{{__('Add Remarks')}}</small>
                                                                        <textarea name="remarks" id="remarks" cols="30" rows="5" class="form-control" required>{{$process->remarks}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <x-jet-button wire:loading.attr="enabled" wire:target="photo" id="process-btn">
                                                            <i class="fa fa-sync"></i>&ensp;{{__('Process')}}
                                                        </x-jet-button>
                                                        </form> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- End of Process Action Modal --}}
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endforeach
                  </div>
            </div>
        </div>
    </div>
</div>

<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
        }

    function changeTotal(id){
        qty = parseInt($('#quantity-'+id).val())
        pack = parseInt($('#pack-'+id).val())
        total = qty*pack
        $('#total-'+id).val(total)
        calculate(id)
    }

    function changeActual(id){
        actual = parseInt($('#actual-'+id).val())
        $('#quantity-'+id).val(actual)
        changeTotal(id)
    }

    function calculate(id){
        qty = parseInt($('#qty-'+id).val())

        remains = qty - parseInt($('#total-'+id).val())

        $('#remaining_items-'+id).html(number_format(remains))
        $('#remains-'+id).val(number_format(remains))
    }
</script>
<script>
    $(document).ready(function(){
        $('#process-btn').click(function(){
            // $(this).prop('disabled',true)    
        })
    })
</script>

<script>
    $(document).ready( function () {
        $('table[id^="dataTable-"]').DataTable();
        $('table[id^="dT-"]').DataTable();
    } );
</script>
