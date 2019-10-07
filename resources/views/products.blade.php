
@extends('layouts.container')

@section('content')

    @if(count($products) > 0)

        <div class="row">

            @foreach ($products as $product)

                <div class="col-md-4">

                        <div class="card product-card">

                        <p class="title">{{ $product->name }}</p>
                        <p>{{ $product->description }}</p>

                        <div class="row">
                            <p class="col-sm-8">Valor por unidade: </p>
                            <p class="col-sm-4 price">@money($product->price)</p>
                        </div>

                        <form method="post" action="{{ route('cart.add') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="productQuantity" class="col-sm-5 col-form-label">Quantidade: </label>
                                <div class="col-sm-2">
                                    <input type="number" required min="1" name="quantity" class="form-control-plaintext" id="productQuantity" value="1">
                                </div>

                                <input type="hidden" name="product" value="{{ $product->id }}">

                                <div class="col-sm-5">
                                    <button class="btn btn-block btn-success" action="submit">Comprar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            @endforeach

        </div>

    @else
    
        <p>Nenhum produto foi encontrado :(</p>

    @endif


@endsection