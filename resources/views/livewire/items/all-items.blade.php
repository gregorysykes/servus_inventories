<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="text-2xl mb-2">
        {{ __('All Items') }}
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-bordered" id="itemTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th class="">{{__('Category')}}</th>
                    <th class="">{{__('Name')}}</th>
                    <th class="">{{__('Thickness')}}</th>
                    <th class="">{{__('Description')}}</th>
                    <th class="">{{__('Action')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($items as $item)
                  <tr>
                    {{-- <td class="py-2 pr-2">{{$item->id}}</td> --}}
                    <td class="py-2 pr-2">{{$item->category}}</td>
                    <td class="py-2 pr-2">{{$item->name}}</td>
                    <td class="py-2 pr-2">{{$item->thickness}}mm</td>
                    <td class="py-2 pr-2">{{$item->description}}</td>
                    <td class="py-2 pr-2">
                        <x-jet-button wire:loading.attr="disabled" wire:target="photo" data-toggle="modal" data-target="#editItemModal{{$item->id}}">
                            <i class="fa fa-pencil"></i>
                        </x-jet-button>
                        
                        {{-- Edit Item Modal --}}
                        <div class="modal fade" id="editItemModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="editItemModal{{$item->id}}Label" aria-hidden="true">
                          <div class="modal-dialog modal-xl" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="editItemModal{{$item->id}}Label"><i class="fa fa-pencil"></i>&ensp;Edit Item</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">    
                                      <div class="row">
                                          <div class="col-12">
                                              <form action="/update-item" method="post">
                                                  @csrf
                                                  <div class="form-group">
                                                      <label for="category">{{__('Category')}}</label>
                                                      <input type="text" class="form-control" id="category" name="category" placeholder="Bracket, Ring, etc." required value="{{$item->category}}">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="name">{{__('Item Name')}}</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="Small Cap, JJ, etc." required value="{{$item->name}}">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="thickness">{{__('Thickness')}} (mm)</label>
                                                      <input type="number" class="form-control" id="thickness" name="thickness" placeholder="0.4, 0.45, 0.5, etc." required step="0.01" value="{{$item->thickness}}">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="thickness">{{__('Supplier')}}</label>
                                                    <input type="text" class="form-control" id="supplier" name="supplier" placeholder="" required value="{{$item->supplier}}">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="jigs">{{__('Jigs')}}</label>
                                                    <input type="number" class="form-control" id="jigs" name="jigs" placeholder="1-1000" required value="{{$item->jigs}}">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="per_box">{{__('Per Box')}}</label>
                                                    <input type="number" class="form-control" id="per_box" name="per_box" placeholder="1-1000" required value="{{$item->per_box}}">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="name">{{__('Description')}}</label>
                                                      <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="For Research, For Curtains, etc.">{{$item->description}}</textarea>
                                                  </div>
                                                  <input type="hidden" name="id" value="{{$item->id}}">
                                                  <input type="hidden" name="status" value="{{$item->status}}">
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
                        {{-- End of Edit Item Modal --}}
    
    
                        <x-jet-button wire:loading.attr="disabled" wire:target="photo" class="bg-danger" data-toggle="modal" data-target="#deleteItemConfirmation{{$item->id}}">
                            <i class="fa fa-trash"></i>
                        </x-jet-button>
    
                        {{-- Delete Item Modal --}}
                        <div class="modal fade" id="deleteItemConfirmation{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteItemConfirmation{{$item->id}}Label" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                
                                  <div class="modal-body">
                                    <h5 class="modal-title" id="deleteItemConfirmation{{$item->id}}Label"><i class="fa fa-trash"></i>&ensp;Confirm Delete?</h5>
                                  </div>
                                  <div class="modal-footer">  
                                      <x-jet-button wire:loading.attr="disabled" data-dismiss="modal" wire:target="photo" class="bg-secondary">
                                          Cancel
                                      </x-jet-button>
                                      <form action="/delete-item" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <x-jet-button wire:loading.attr="disabled" wire:target="photo" class="bg-danger">
                                          <i class="fa fa-trash"></i>&ensp;Delete
                                        </x-jet-button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                        </div>
                        {{-- End of Delete Item Modal --}}
    
    
    
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
<script>
  $(document).ready( function () {
      $('#itemTable').DataTable();
  } );
</script>
