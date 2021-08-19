{{-- <div>
    Knowing others is intelligence; knowing yourself is true wisdom.
</div> --}}
<div class="p-3 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="/add-packaging" autocomplete="off" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6 col-12">
                            <label for="customer">{{__('Packaging No.')}}</label>
                            <input type="text" class="form-control" id="no" name="no" required>
                            @if ($errors->has('no'))
                                <small class="small text-danger">{{__('Transaction No. is taken')}}</small>
                            @endif
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label for="customer">{{__('Customer Name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @if ($errors->has('name'))
                                <small class="small text-danger">{{__('Name is required')}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h6>Packed Items</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="col-4 offset-8">
                        <input type="text" class="form-control form-control-sm" name="search" placeholder="Search" id="searchPack" onchange="lookup()">
                    </div>
                    <div class="row mx-1">
                        <div class="col-lg-3 mb-1 mt-1">
                            <strong>{{__('Check')}}</strong>
                        </div>
                        <div class="col-lg-3 mb-1 mt-1">
                            <strong>{{__('Item Name')}}</strong>
                        </div>
                        <div class="col-lg-3 mb-1 mt-1">
                            <strong>{{__('Quantity')}}</strong>
                        </div>
                        <div class="col-lg-3 mb-1 mt-1">
                            <strong>{{__('Remarks')}}</strong>
                        </div>
                    </div>
                    <div class="row overflow-auto border mx-1 py-2" style="height:10em;border:#e5e5e5; border-radius:.3em">

                        <div class="col-12">
                            @if ($errors->has('check'))
                                <small class="small text-danger">{{__('Please choose an item')}}</small>
                            @endif
                        </div>
                        {{-- Item --}}
                        <div class="col-12 searchResult "></div>
                        {{-- End of Item Cards --}}
                    </div>
                    <div class="row">
                        <div class="col-12"><hr></div>
                        <div class="col-12">
                            <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                                <i class="fa fa-save"></i>&ensp;Save
                            </x-jet-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel"><i class="fa fa-plus"></i>&ensp;{{__('Set up Packaging')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
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


<script>
    $(document).ready(function(){
        $.extend({
            getValues: function() {
                var result;
                $.ajax({
                    url: '/getProcesses',
                    type: 'get',
                    dataType: 'json',
                    async: false,
                    success: function(data) {
                        console.log(data)
                        result = data;
                        $('.searchResult').html('')
                        for(i=0;i<data.length*1000;i++){
                            $('.searchResult').append('<div class="row"><div class="col-lg-3 mb-1 mt-1"><input type="checkbox" name="check['+data[0][i].id+']"><input type="hidden" name="process_id[]" value="'+data[0][i].id+'"></div><div class="col-lg-3 mb-1 mt-1">'+data[1][i]+'</div><div class="col-lg-3 mb-1 mt-1"><input type="number" class="form-control form-control-sm" name="quantity[]" min=1 max="'+data[0][i].quantity+'" value="'+data[0][i].quantity+'"><small class="small text-danger">Max: '+data[0][i].quantity+'</small></div><div class="col-lg-3 mb-1 mt-1">'+data[0][i].remarks+'<input type="hidden" name="remarks[]" value="'+data[0][i].remarks+'"></div></div>')
                        }
                    }
                });
            return result;
            }
        });
        
        r = $.getValues()
    })
</script>
<script>
    function lookup(){
        v = $('#searchPack').val()
        console.log(v)
        $('.searchResult').html('')
        for(i=0;i<r.length;i++){
            if(r[1][i].toLowerCase().includes(v.toLowerCase()) || r[1][i].toLowerCase().includes(v.toLowerCase())){
                $('.searchResult').append('<div class="row "><div class="col-lg-3 mb-1 mt-1"><input type="checkbox" name="check['+r[0][i].id+']"><input type="hidden" name="process_id[]" value="'+r[0][i].id+'"></div><div class="col-lg-3 mb-1 mt-1">'+r[1][i]+'</div><div class="col-lg-3 mb-1 mt-1"><input type="number" class="form-control form-control-sm" name="quantity[]" min=1 max="'+r[0][i].quantity+'" value="'+r[0][i].quantity+'"><small class="small text-danger">Max: '+r[0][i].quantity+'</small></div><div class="col-lg-3 mb-1 mt-1">'+r[0][i].remarks+'<input type="hidden" name="remarks[]" value="'+r[0][i].remarks+'"></div></div>')
            }
            if(v.toLowerCase() == '' || v.toLowerCase() == ' '){
                // $('.searchResult').html('')
                $.getValues()
            }
        }
    }
</script>