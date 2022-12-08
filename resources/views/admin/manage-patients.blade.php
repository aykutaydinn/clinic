@extends('.layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="user-profiles-list-basic">
                    @foreach($users as $user)
                    
        <li>
            <p>
                <a href="/admin/manage-patients/{{ $user->accType }}/{{ $user->id }}">{{$user->name}}</a>
                <span>{{$user->accType}} <i></i></span>
            </p>

            <form action="/admin/manage-patients/delete/{{ $user->id }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button>Delete</button>
        </form>

        </li>
        
        @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
@endsection
