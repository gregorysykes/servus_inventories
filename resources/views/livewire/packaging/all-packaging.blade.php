{{-- <div>
    The whole world belongs to you
</div> --}}
<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="text-2xl">
        {{ __('All packagings') }}
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dX" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{__('Packaging')}}</th>
                                <th>{{__('Customer Name')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Entry Date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($packagings as $packaging)
                                    <tr data-toggle="modal" data-target="#showpackagingModal{{$packaging->id}}">
                                        <td>{{$packaging->no}}</td>
                                        <td>{{$packaging->name}}</td>
                                        @if($packaging->status == 'done')
                                            <td><span class="badge badge-success">{{$packaging->status}}</span></td>
                                        @else
                                            <td>{{$packaging->status}}</td>
                                        @endif
                                        <td>{{date('d/m/y', strtotime($packaging->created_at))}}</td>
                                    </tr>
                                    {{-- View packaging Modal --}}
                                    <div class="modal fade" id="showpackagingModal{{$packaging->id}}" tabindex="-1" role="dialog" aria-labelledby="showpackagingModal{{$packaging->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showpackagingModal{{$packaging->id}}Label">
                                                        <i class="fa fa-credit-card"></i>&ensp;{{__('View packaging') }} 
                                                    </h5>
                                                        @if($packaging->status == 'accepted')
                                                            <span class="badge badge-primary mt-1 ml-3">{{$packaging->status}}</span>
                                                        @elseif($packaging->status == 'process')
                                                            <span class="badge badge-warning mt-1 ml-3">{{$packaging->status}}</span>
                                                        @elseif($packaging->status == 'done')
                                                            <span class="badge badge-success mt-1 ml-3">{{$packaging->status}}</span>
                                                        @endif
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <small class="small d-block">{{__('Packaging No.')}}</small>
                                                            <strong>{{$packaging->no}}</strong>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="small d-block">{{__('Customer Name')}}</small>
                                                            <strong>{{$packaging->name}}</strong>
                                                        </div>
                                                        <div class="col-6 text-right">
                                                            <small class="d-block">{{__('Entry Date')}}</small>
                                                            <strong>{{date('d M Y H:i:s',strtotime($packaging->created_at))}}</strong>
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
                                                        <div class="col d-none d-lg-block ">
                                                            <strong>{{__('Total')}}</strong>
                                                        </div>
                                                        <div class="col-lg col-3">
                                                            <strong>{{__('Remarks')}}</strong>
                                                        </div>
                                                    </div>
                                                    {{-- Detail packaging --}}
                                                    @foreach($packaging->detail_packagings as $detail)
                                                        <div class="row mt-2">
                                                            <div class="col d-none d-lg-block">
                                                                {{__($detail->process->detail_transaction->item->name)}}</strong>
                                                            </div>
                                                            <div class="col d-none d-lg-block ">
                                                                {{__(number_format($detail->quantity))}}</strong>
                                                            </div>
                                                            <div class="col-lg col-3">
                                                                {{__($detail->remarks)}}</strong>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    {{-- End of Detail packaging --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="/cancel-packaging" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$packaging->id}}">
                                                        <x-jet-button wire:loading.attr="enabled" wire:target="photo" class="bg-warning">
                                                            <i class="fa fa-times"></i>&ensp;{{__('Cancel')}}
                                                        </x-jet-button>
                                                    </form>
                                                    <form action="/update-packaging" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$packaging->id}}">
                                                        <x-jet-button wire:loading.attr="enabled" wire:target="photo" class="bg-info">
                                                            <i class="fab fa-searchengin"></i>&ensp;{{__('Set Done')}}
                                                        </x-jet-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End of View packaging Modal --}}
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
        $('#dX').DataTable();
    } );
</script>