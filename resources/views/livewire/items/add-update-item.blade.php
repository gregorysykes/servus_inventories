<div class="p-3 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-6 offset-lg-10 offset-6 d-flex justify-content-end">
                <x-jet-button wire:loading.attr="disabled" wire:target="photo" data-toggle="modal" data-target="#addItemModal">
                    <i class="fa fa-plus"></i>&ensp;{{__('Add Item')}}
                </x-jet-button>
                {{-- <button class="btn btn-dark" data-toggle="modal" data-target="#addItemModal">
                    <i class="fa fa-plus"></i>&ensp;Add item
                </button> --}}
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel"><i class="fa fa-plus"></i>&ensp;Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <div class="row">
                    <div class="col-12">
                        <form action="/add-item" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="category">{{__('Category')}}</label>
                                <input type="text" class="form-control" id="category" name="category" placeholder="Bracket, Ring, etc." required>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('Item Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Small Cap, JJ, etc." required>
                            </div>
                            <div class="form-group">
                                <label for="thickness">{{__('Thickness')}} (mm)</label>
                                <input type="number" class="form-control" id="thickness" name="thickness" placeholder="0.4, 0.45, 0.5, etc." required step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="thickness">{{__('Supplier')}}</label>
                                <input type="text" class="form-control" id="supplier" name="supplier" required>
                            </div>
                            <div class="form-group">
                                <label for="jigs">{{__('Jigs')}}</label>
                                <input type="number" class="form-control" id="jigs" name="jigs" placeholder="1-1000" required min="1" step="1">
                            </div>
                            <div class="form-group">
                                <label for="jigs">{{__('Per Box')}}</label>
                                <input type="number" class="form-control" id="per_box" name="per_box" placeholder="1-1000" required min="1" step="1">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('Description')}}</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="For Research, For Curtains, etc." required></textarea>
                            </div>
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