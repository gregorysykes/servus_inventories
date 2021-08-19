{{-- <div>
    The best athlete wants his opponent at his best.
</div> --}}
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="text-2xl mb-2">
        {{ __('All States') }}
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="stateTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="">{{__('Order Sequence')}}</th>
                            <th class="">{{__('State')}}</th>
                            <th class="">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($states as $state)
                        <tr>
                            <td class="py-2 pr-2">
                                {{$loop->iteration}}
                            </td>
                            <td class="py-2 pr-2">
                                {{$state->state}}
                            </td>
                            <td class="py-2 pr-2">
                                <x-jet-button wire:loading.attr="disabled" wire:target="photo" data-target="#editstateModal{{$state->id}}" data-toggle="modal">
                                    <i class="fa fa-pencil"></i>
                                </x-jet-button>
                                <x-jet-button wire:loading.attr="disabled" wire:target="photo" class="bg-danger" data-target="#deletestateConfirmation{{$state->id}}" data-toggle="modal">
                                    <i class="fa fa-trash"></i>
                                </x-jet-button>
                            </td>
                        </tr>
    
    
                        {{-- edit modal --}}
                        <div class="modal fade" id="editstateModal{{$state->id}}" tabindex="-1" role="dialog" aria-labelledby="editstateModal{{$state->id}}Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editstateModal{{$state->id}}Label"><i class="fa fa-pencil"></i>&ensp;Edit state</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">    
                                        <div class="row">
                                            <div class="col-12">
                                                <form action="/update-state" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-lg-2">
                                                            <label for="name">{{__('Sequence')}}</label>
                                                            <input type="number" class="form-control" id="sequence-{{$state->id}}" name="sequence" onchange="order({{$state->id}})" required value="{{$state->sequence}}" min="1" max="{{count($states)}}">
                                                            <small class="text-primary" id="order-{{$state->id}}"><i></i></small>
                                                        </div>
                                                        <div class="form-group col-lg-10">
                                                            <label for="name">{{__('State')}}</label>
                                                            <input type="text" class="form-control" id="state" name="state" required value="{{$state->state}}">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="id" value="{{$state->id}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">  
                                        <x-jet-button wire:loading.attr="disabled" data-dismiss="modal" wire:target="photo" class="bg-secondary">
                                            Close
                                        </x-jet-button>
                                        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                                            <i class="fa fa-save"></i>&ensp;Save
                                        </x-jet-button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                          </div>
                        {{-- end of edit modal --}}
    
    
    
    
                        {{-- delete modal --}}
    
                        <div class="modal fade" id="deletestateConfirmation{{$state->id}}" tabindex="-1" role="dialog" aria-labelledby="deletestateConfirmation{{$state->id}}Label" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                  
                                    <div class="modal-body">
                                      <h5 class="modal-title" id="deletestateConfirmation{{$state->id}}Label"><i class="fa fa-trash"></i>&ensp;Confirm Delete?</h5>
                                    </div>
                                    <div class="modal-footer">  
                                        <x-jet-button wire:loading.attr="disabled" data-dismiss="modal" wire:target="photo" class="bg-secondary">
                                            Cancel
                                        </x-jet-button>
                                        <form action="/delete-state" method="post">
                                          @csrf
                                          <input type="hidden" name="id" value="{{$state->id}}">
                                          <x-jet-button wire:loading.attr="disabled" wire:target="photo" class="bg-danger">
                                            <i class="fa fa-trash"></i>&ensp;Delete
                                          </x-jet-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                          </div>
                        {{-- End of delete modal --}}
    
                    @endforeach
                    </tbody>
                </table>
            </div>
          
        </div>
      </div>
    </div>
</div>

<script>
    function order(id){
        object = JSON.parse($('#object').html())
        curr = object[$('#sequence-'+id).val()-1].state
        before = ''
        after = ''

        if($('#sequence-'+id).val() == 1){
            before = null
        }else{
            before = object[$('#sequence-'+id).val()-1].state
        }

        if($('#sequence-'+id).val() == 7){
            after = null
        }else{
            after = object[$('#sequence-'+id).val()].state
        }

        // if(after == null){
        //     $('#order-'+id).html('After '+before)
        // }else if(before == null){
        //     $('#order-'+id).html('Before '+after)
        // }else{
        //     $('#order-'+id).html('Before '+after)
        // }
    }
</script>
<script>
    $(document).ready( function () {
        $('#stateTable').DataTable();
    } );
  </script>
  