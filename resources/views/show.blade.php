@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">Visualizar {{$product->name}}</h1>

    <div class="jumbotron col-8 m-auto d-flex justify-content-around align-items-center">
        @php
            $user = $product->find($product->id)->relUsers;
        @endphp
        <div style="font-size: 20px">
            <b>ID:</b>&nbsp;{{$product->id}}<br>
            <b>Nome do produto:</b>&nbsp;{{$product->name}}<br>
            <b>Adicionado por:</b>&nbsp;{{$user->name}}<br>
            <b>Valor:</b>&nbsp;{{$product->value}}<br>
            <b>Estoque:</b>&nbsp;{{$product->stock}}<br>
            <b>Descrição:</b>&nbsp;{{$product->description}}
        </div>
        <div class="d-flex flex-column">
            <h4><b>Imagens de {{$product->name}}:</b></h4>
            <div class="d-flex flex-column" style="max-height: 300px; overflow:auto">
                @foreach($product->relImage as $image)
                    <img class="mb-3" src="{{ env('APP_URL') }}/storage/{{$image->path}}" alt="product image" style="max-height: 300px ">
                @endforeach
            </div>
        </div>
    </div>
@endsection
