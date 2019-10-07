@extends('layouts.container')

@section('content')

    <div class="row justify-content-between">

    @if(count($items) > 0)

        <div class="col-sm-12">
            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Valor Unitário</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor Total</th>
                    <th></th>
                    </tr>
                </thead>

                <tbody>
                @php($i = 1)
                @foreach ($items as $item)

                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $item['product'] }} </td>
                        <td>@money($item['price'])</td>
                        <td>

                            <form method="post" action="{{ route('cart.update') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="number" required min="1" name="quantity" class="form-control-plaintext" id="productQuantity" value="{{ $item['quantity'] }}">
                                    </div>

                                    <input type="hidden" name="product" value="{{ $item['id'] }}">

                                    <div class="col-sm-2">
                                        <button class="btn btn-block btn-primary" action="submit"><i class="fas fa-sync-alt"></i></button>
                                    </div>
                                </div>
                            </form>

                        </td>
                        <td>@money($item['totalPrice'])</td>

                        <td>

                            <form method="post" action="{{ route('cart.remove') }}">
                                @csrf
                                <input type="hidden" name="product" value="{{ $item['id'] }}">
                                <button class="btn btn-danger btn-info" action="submit"><i class="fas fa-trash"></i></button>
                            </form>

                        </td>
                        
                    </tr>

                    @php($i++)

                @endforeach
                </tbody>

            </table>
        </div>

        <div class="col-sm-6 cart-info align-self-start">
            <h4>Valor total: @money($totalValue)</h4>
            <h4>Saldo atual: @money($totalCredit)</h4>

            @if($totalValue > $totalCredit)
                <div class="alert alert-danger" role="alert">
                    Não é possível concluir o pedido: saldo insuficiente.
                </div>
                <button disabled="disabled" class="btn btn-md btn-success">Concluir pedido</button>

            @else 

                <form method="post" action={{ $route_cart_order }}>
                    <button class="btn btn-md btn-success">Concluir pedido</button>
                </form>

            @endif
        </div>

    @else
    
        <div class="col-sm-12">
            <p>Nenhum produto no carrinho.</p>
        </div>

    @endif

        <div class="col-sm-3 align-self-end">
            <a href="{{ $route_products }}"><button class="btn btn-success btn-block"><i class="fas fa-plus"></i> Adicionar mais produtos</button></a>
        </div>    
    </div>


@endsection