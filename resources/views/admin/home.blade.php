@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
asdasd
                    <a href="{{ route('admin.logout') }}"   onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="icon-unlock"></i>Logout</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    You are logged in!
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
