{{-- <div>
    To attain knowledge, add things every day; To attain wisdom, subtract things every day
</div> --}}
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="container">
      <div class="row">
        @foreach($states as $state)
          <div class="col-12 col-lg-6">
            <h6 class="mt-2"><strong>{{$state->state}}</strong></h6>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable-{{$state->id}}" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th class="">{{__('Item')}}</th>
                        <th class="">{{__('Quantity')}}</th>
                        <th class="">{{__('Remarks')}}</th>
                        <th class="">{{__('Action')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($state->rejects as $reject)
                    @if($reject->quantity != 0)
                      <tr>
                        <td class="small">{{$reject->detail_transaction->item->name}}</td>
                        <td class="small">{{number_format($reject->quantity)}}</td>
                        <td class="small">{{$reject->remarks}}</td>
                        <td>
                          @if($reject->status == 'done')
                            <span class="badge badge-success"><i class="fa fa-check fa-sm"></i></span>&ensp;<span class="small">Done</span>
                          @else
                            <span class="badge badge-danger p-2" data-toggle="modal" data-target="#editRejectModal{{$reject->id}}"><i class="fa fa-cogs"></i></span>
                          {{-- <x-jet-button wire:loading.attr="disabled"  wire:target="photo" class="bg-primary small">
                              <i class="fa fa-cogs fa-xs"></i>
                          </x-jet-button> --}}
                          @endif
                        </td>
                      </tr>
                      {{-- Edit Reject Modal --}}
                      <div class="modal fade" id="editRejectModal{{$reject->id}}" tabindex="-1" role="dialog" aria-labelledby="editRejectModal{{$reject->id}}Label" aria-hidden="true">
                          <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="editRejectModal{{$reject->id}}Label"><i class="fa fa-pencil"></i>&ensp;Edit Rejected Items</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                      <div class="col-12">
                                        <form action="/update-reject" method="post">
                                            @csrf
                                            <div class="row">
                                              <div class="form-group col-12 col-lg-6">
                                                <small class="small">{{__('Transaction No.')}}</small><br>
                                                <strong>{{$reject->detail_transaction->transaction->no}}</strong>
                                              </div>
                                              <div class="form-group col-12 col-lg-6">
                                                <small class="small">{{__('Item Name')}}</small><br>
                                                <strong>{{$reject->detail_transaction->item->name}}</strong>
                                              </div>
                                              <div class="form-group col-12 col-lg-6">
                                                <small class="small">{{__('From')}}</small><br>
                                                <strong>{{$reject->state->state}}</strong>
                                              </div>
                                              <div class="form-group col-12 col-lg-6">
                                                <small class="small">{{__('Set State')}}</small><br>
                                                <select name="state_id" class="form-select form-select-sm" id="">
                                                  @foreach($states as $state)
                                                    @if($state->state == $reject->state->state)
                                                      <option selected value="{{$state->id}}">{{$state->state}}</option>
                                                    @else
                                                      <option value="{{$state->id}}">{{$state->state}}</option>
                                                    @endif
                                                  @endforeach
                                                </select>
                                              </div>
                                              <div class="form-group col-12 col-lg-6">
                                                <small class="small">{{__('Remarks')}}</small><br>
                                                <strong>{{$reject->remarks}}</strong>
                                              </div>
                                              <div class="form-group col-12 col-lg-6">
                                                <label for="quantity" class="small">{{__('Item(s) fixed')}}</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity" required value="{{$reject->quantity}}">
                                              </div>
                                              <input type="hidden" name="id" value="{{$reject->id}}">
                                            </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="modal-footer">  
                                <x-jet-button wire:loading.attr="disabled" data-dismiss="modal" wire:target="photo" class="bg-secondary">
                                Close
                                </x-jet-button>
                                <x-jet-button wire:loading.attr="enabled" wire:target="photo">
                                <i class="fa fa-check"></i>&ensp;Set Done
                                </x-jet-button>
                                </form>
                                </div>
                            </div>
                          </div>
                      </div>
                    @endif
                    {{-- End of Edit Reject Modal --}}
                  @endforeach
                  </tbody>
              </table>
          </div>
          </div>
        @endforeach
        
      </div>
    </div>
</div>
<script>
  $(document).ready( function () {
      $('table[id^="dataTable-"]').DataTable();
      $('table[id^="dT-"]').DataTable();
  } );
</script>