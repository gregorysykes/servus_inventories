{{-- <div>
    Knowing others is intelligence; knowing yourself is true wisdom.
</div> --}}

<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="text-2xl mb-2">
        {{ __('All Users') }}
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12">
          <table class="table">
            <thead>
              <tr>
                <th class="">{{__('Name')}}</th>
                <th class="">{{__('E-Mail')}}</th>
                <th class="">{{__('Team')}}</th>
                <th>{{__('Authorizations')}}</th>
              </tr>
            </thead>
            <tbody class="">
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->team_id}}</td>
                        <td>{{$user->team_id}}</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>