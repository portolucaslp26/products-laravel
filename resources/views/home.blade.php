@extends('layouts.app')

@section('content')
<h1 class="text-center mt-3 mb-4">Lista de produtos</h1>
<div class="container">
    @csrf
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">ADICIONADO POR</th>
                <th scope="col">VALOR</th>
                <th scope="col">ESTOQUE</th>
                <th scope="col">DESCRIÇÃO</th>
                <th scope="col">AÇÕES</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                @php
                    $user = $product->find($product->id)->relUsers;
                @endphp
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$user->name}}</td>
                <td>{{$product->value}}</td>
                <td>{{$product->stock}}</td>
                <td>{{$product->description}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{url("/$product->id/show")}}">
                            <button class="btn btn-dark mr-2">Visualizar</button>
                        </a>
                        <a href="{{url("/$product->id/edit")}}">
                            <button class="btn btn-primary mr-2">Editar</button>
                        </a>
                        <form action="{{url("/$product->id/delete")}}" method="POST"
                            onsubmit="return confirm('Tem certeza que deseja remover {{$product->name}}?')">
                            @csrf
                            @method('DELETE')
                            <a href="" class="delete">
                                <button class="btn btn-danger">Excluir</button>
                            </a>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{url("/create")}}">
        <button class="btn btn-success">Cadastrar</button>
    </a>
</div>
@endsection
