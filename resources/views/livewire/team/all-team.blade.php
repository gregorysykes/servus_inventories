{{-- <div>
    Be like water.
</div> --}}

<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="text-2xl mb-2">
        {{ __('All Users') }}
    </div>

    <div class="container">
      <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="teamTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                      <th class="">{{__('Name')}}</th>
                      <th class="">{{__('Description')}}</th>
                      <th class="">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$team->name}}</td>
                        <td>{{$team->description}}</td>
                        <td>
                            <x-jet-button wire:loading.attr="disabled" data-toggle="modal" data-target="#editTeam{{$team->id}}" wire:target="photo" class="bg-primary">
                                <i class="fa fa-pencil"></i> &ensp; Edit
                            </x-jet-button>
                            <x-jet-button wire:loading.attr="disabled" data-toggle="modal" data-target="#deleteTeamConfirmation{{$team->id}}" wire:target="photo" class="bg-danger">
                                <i class="fa fa-trash"></i> &ensp; Delete
                            </x-jet-button>

                            {{-- delete modal --}}

                            <div class="modal fade" id="deleteTeamConfirmation{{$team->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteTeamConfirmation{{$team->id}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                    
                                        <div class="modal-body">
                                        <h5 class="modal-title" id="deleteTeamConfirmation{{$team->id}}Label"><i class="fa fa-trash"></i>&ensp;Confirm Delete <strong>Team {{$team->name}}</strong>?</h5>
                                        </div>
                                        <div class="modal-footer">  
                                            <x-jet-button wire:loading.attr="disabled" data-dismiss="modal" wire:target="photo" class="bg-secondary">
                                                Cancel
                                            </x-jet-button>
                                            <form action="/delete-team" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$team->id}}">
                                            <x-jet-button wire:loading.attr="disabled" wire:target="photo" class="bg-danger">
                                                <i class="fa fa-trash"></i>&ensp;Delete
                                            </x-jet-button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End of delete modal --}}


                            {{-- edit modal --}}
                            <div class="modal fade" id="editTeam{{$team->id}}" tabindex="-1" role="dialog" aria-labelledby="editTeam{{$team->id}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editTeam{{$team->id}}Label"><i class="fa fa-pencil"></i>&ensp;Edit Team</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">    
                                            <div class="row">
                                                <div class="col-12">
                                                    <form autocomplete="off" action="/update-team" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="name">{{__('Team')}}</label>
                                                            <input type="hidden" name="id" value="{{$team->id}}">
                                                            <input type="text" class="form-control" id="name" name="name" value="{{$team->name}}"" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">{{__('Description')}}</label>
                                                            <textarea name="description" class="form-control" id="description" cols="30" rows="10" required>{{$team->description}}</textarea>
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
                            {{-- end of edit modal --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
      </div>
    </div>
</div>
<script>
    $(document).ready( function () {
        $('#teamTable').DataTable();
    } );
  </script>
  