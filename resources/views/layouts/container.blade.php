@extends('layouts.app')

@section('app_content')


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }} ">Cantina</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Route::is('products') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('products') }}">Produtos</a>
                </li>
                <li class="nav-item {{ Route::is('cart.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('cart.index') }}">Carrinho</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item {{ Route::is('account.orders') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('account.orders') }}">Meus Pedidos</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="post">
                @csrf

                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Sair</button>
            </form>
        </div>
    </div>
</nav>

<div class="content-container container white">
    <h2>{!! isset($title) ? $title : '' !!}</h2>

    @include('common.errors')
    @include('common.success')

    @yield('content')
    
</div>

@endsection