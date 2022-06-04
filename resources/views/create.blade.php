@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-3 mb-4">@if (isset($product)) Editar {{$product->name}} @else Cadastrar produtos @endif</h1>
    <div class="container">
        <hr>

        @if (isset($errors) && count($errors) > 0)
            <div class="text-center my-3 p-2 alert-danger">
                @foreach($errors->all() as $error)
                    {{$error}} <br>
                @endforeach
            </div>
        @endif
        @if(isset($product))
        <form name="edit" id="edit" method="POST" enctype="multipart/form-data" action="{{url("/$product->id")}}">
            @method('PUT')
        @else
        <form name="register" id="register" method="POST" enctype="multipart/form-data" action="{{url('/')}}">
        @endif
            @csrf
            <div class="form-group">
                <label for="name">Nome do produto:</label>
                <input  type="text" class="form-control" name="name" id="name" value="{{$product->name ?? ''}}"  placeholder="Digite o nome do produto">
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="value">Valor:</label>
                    <input  type="number" step="0.1" class="form-control" name="value" id="value" value="{{$product->value ?? ''}}" placeholder="Digite o valor do produto">
                </div>
                <div class="form-group col-4">
                    <label for="stock">Estoque:</label>
                    <input  type="number" class="form-control" name="stock" id="stock" value="{{$product->stock ?? ''}}" placeholder="Informe o estoque do produto">
                </div>
                <div class="form-group col-4">
                    <label for="id_user">Adicionado por:</label>
                    <select  class="form-control" name="id_user" id="id_user">
                        <option value="{{$product->relUsers->id ?? ''}}">{{$product->relUsers->name ?? 'Selecione'}}</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="custom-file col-6">
                    <input type="file" name="file[]" id="file" multiple >
                </div>
                @if(isset($product))
                <div class="col-6 d-flex">
                    @foreach($product->relImage as $image)
                        <div style="position:relative; text-align:center;" class="ml-3">
                            <img class="mb-3" src="{{ env('APP_URL') }}/storage/{{$image->path}}" alt="product image" style="max-height: 300px ">
                            <form action="{{url("/$product->id/delete-image/$image->id")}}" method="POST"
                                enctype="multipart/form-data" onsubmit="return confirm('Tem certeza que deseja remover a imagem?')">
                                @csrf
                                @method('DELETE')
                                <a href="">
                                    <button style="position:absolute; z-index:1; top:10%; left:53%; margin:-15px 0 0 -30px;" class="btn-sm btn-danger">X</button>
                                </a>
                            </form>

                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="input-group mb-3 col-6 px-0">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea  style="resize: none" class="form-control" name="description" id="description" placeholder="Digite a descrição do produto">{{$product->description ?? ''}}</textarea>
                </div>
                <button type="submit" class="btn btn-success">@if (isset($product)) Salvar @else Cadastrar @endif</button>
            </div>
        </form>
    </div>
@endsection
