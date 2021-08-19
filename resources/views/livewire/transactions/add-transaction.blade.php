{{-- <div>
    Knowing others is intelligence; knowing yourself is true wisdom.
</div> --}}
<div class="p-3 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="/add-transaction" autocomplete="off" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6 col-12">
                            <label for="no">{{__('Transaction No.')}}</label>
                            <input type="number" class="form-control" id="no" name="no" placeholder="99999" required value="{{old('no')}}"">
                            @if ($errors->has('no'))
                                <small class="small text-danger">{{__('Transaction No. is taken')}}</small>
                            @endif
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label for="customer">{{__('Customer Name')}}</label>
                            <input type="text" class="form-control" id="customer" name="customer" placeholder="Budi, Pak E, etc." required value="{{old('customer')}}">
                        </div>
                    </div>
                    <div class="row"><div class="col-12"><hr></div></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="items">{{__('Items')}}</label>
                                <input type="text" class="form-control" name="search" id="search" placeholder="{{__('Search Item')}}" onkeyup="lookup()">
                                @if ($errors->has('quantity'))
                                    <small class="small text-danger">{{__('Select Item(s)')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <ul class="searchResult"></ul>
                        </div>
                    </div>
                    <div class="row"><div class="col-12"><hr></div></div>
                    <div class="cartItems"></div>

                    
                    <div class="row">
                        <div class="col-12 d-flex align-items-right justify-content-right">
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

<script>
    $(document).ready(function(){
        $.extend({
            getValues: function() {
                var result;
                $.ajax({
                    url: '/getAllItems',
                    type: 'get',
                    dataType: 'json',
                    async: false,
                    success: function(data) {
                        result = data;
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
        v = $('#search').val()
        // console.log(v)
        $('.searchResult').html('')
        for(i=0;i<r.length;i++){
            if(r[i].name.toLowerCase().includes(v.toLowerCase()) || r[i].category.toLowerCase().includes(v.toLowerCase())){
                $('.searchResult').append('<li class="border border-1 p-2 my-1" onclick="addToCart('+i+')">'+r[i].name +' - '+r[i].category +'</li>')
            }
            if(v.toLowerCase() == '' || v.toLowerCase() == ' '){
                $('.searchResult').html('')
            }
        }
    }
</script>
<script>
    temp=[]
    function addToCart(id){
        found = false
        for(i=0;i<temp.length;i++){
            if(temp[i].id == r[id].id){
                found = true
            }
        }
        if(!found){
            temp.push(r[id])
            $('.cartItems').append('<div class="row" id="item-'+r[id].id+'"><div class="col-lg-2 col-5 d-flex align-items-center justify-content-center">'+r[id].name+'</div><div class="col-lg-2 d-none d-lg-flex align-items-center justify-content-center">'+r[id].category+'</div><div class="col-lg-1 d-none d-lg-flex align-items-center justify-content-center">'+r[id].thickness+'</div><div class="col-lg-3 col-5 d-flex justify-content-center"><input type="hidden" name="item_id[]" value="'+r[id].id+'"><input type="number" name="quantity[]" min="1" class="form-control w-25" placeholder="Q" required>    <div class="row"><div class="col-12 d-flex align-items-center">&ensp;<i class="fa fa-times"></i>&ensp;</div></div>    <input type="number" min="1" name="per_pack[]" class="form-control w-25" placeholder="B" required></div><div class="col-lg-2 col-5 d-flex justify-content-center">	<input type="text" name="supplier[]" class="form-control" placeholder="Supplier" value="'+r[i].supplier+'" required></div><div class="col-lg-2 col-2">    <button class="btn btn-danger" onclick="remove('+r[id].id+')">        <i class="fa fa-trash"></i>    </button></div><div class="col-12"><hr></div></div>')
        }
    }
</script>
<script>
    function remove(id/*id of the item*/){
        $('#item-'+id).remove();
        //search for id in temp
        for(i=0;i<temp.length;i++){
            if(temp[i].id == id){
                temp.splice(i,1)
            }
        }
    }
</script>