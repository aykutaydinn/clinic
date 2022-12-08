@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Manage Doctors</h1></div>
                <a href="?action=addDoctor"><i class="fa fa-medkit "></i>Add Doctor</a>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($_GET['action']))
                    @if($_GET['action']=='addDoctor')
                    @include('admin.adddoctors')
                    @endif
                    @endif

                    <ul class="user-profiles-list-basic">
                    @foreach($users as $user)
                    
        <li>
            <p>
                <a href="/admin/manage-doctors/{{ $user->accType }}/{{ $user->id }}">{{$user->name}}</a>
                <span>{{$user->doctorType}}</span>
            </p>

            <form action="/admin/manage-doctors/delete/{{ $user->id }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button>Delete</button>
        </form>

        </li>
        
        @endforeach
        </ul>

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
