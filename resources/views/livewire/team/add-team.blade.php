{{-- <div>
    In work, do what you enjoy.
</div> --}}
<div class="p-3 sm:px-20 bg-white border-b border-gray-200">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-6 offset-lg-10 offset-6 d-flex justify-content-end">
                <x-jet-button wire:loading.attr="disabled" wire:target="photo" data-toggle="modal" data-target="#addTeamModal">
                    <i class="fa fa-plus"></i>&ensp;{{__('Add Team')}}
                </x-jet-button>
                {{-- <button class="btn btn-dark" data-toggle="modal" data-target="#addTeamModal">
                    <i class="fa fa-plus"></i>&ensp;Add Team
                </button> --}}
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addTeamModal" tabindex="-1" role="dialog" aria-labelledby="addTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTeamModalLabel"><i class="fa fa-plus"></i>&ensp;Add Team</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <div class="row">
                    <div class="col-12">
                        <form autocomplete="off" action="/add-team" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Team')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="A, B, etc." required>
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="10" required placeholder="Persekutan..."></textarea>
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