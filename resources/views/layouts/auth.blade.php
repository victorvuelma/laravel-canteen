@extends('layouts.app')

@section('app_content')
<div class="container container-top">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-10">
            <div class="card">

                <div class="card-body">
                    <h1 class="text-lg-center">{{ $title }}</h1>

                    @yield('auth_content')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection