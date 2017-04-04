@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <span style="color:green;">{{ Session::get('success_login') }}</span><br>
                    <!-- You are logged in! -->

                    <img src="{{ Auth::user()->profile_picture }}" alt=""><br>
                    <strong>{{ Auth::user()->name }}</strong><br>
                    <strong>{{ Auth::user()->email }}</strong><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
