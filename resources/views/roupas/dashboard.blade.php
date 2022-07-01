@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus produtos</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if (count($roupas) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Preço</th>
                        <th scope="col"></th>
                        

                    </tr>
                </thead>
                <tbody>
                    @foreach ($roupas as $roupa)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><a href="/roupas/{{ $roupa->id }}">{{ $roupa->tipo }}</a></td>
                            <td><a>{{ $roupa->marca }}</a></td>
                            <td><a>{{ $roupa->preco }}</a></td>
                            <td>
                                <div class="btn-group" >
                                    <a href="/roupas/edit/{{ $roupa->id }}" class="btn btn-info edit-btn" style="margin-right: 10px">
                                        <ion-icon name="create-outline"></ion-icon> Editar
                                    </a>


                                    <form action="/roupas/{{ $roupa->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-btn">
                                            <ion-icon name="trash-outline"></ion-icon> Deletar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem produtos criador, <a href="/roupas/create">crie um!</a></p>
        @endif
    </div>
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Minha wishlist</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if (count($roupasComprador) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Preço</th>
                        <th scope="col"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roupasComprador as $roupa)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td><a href="/roupas/{{ $roupa->id }}">{{ $roupa->tipo }}</a></td>
                            <td><a>{{ $roupa->marca }}</a></td>
                            <td><a>{{ $roupa->preco }}</a></td>
                            <td>
                                <form action="/roupas/leave/{{ $roupa->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon> Remover
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem nenhum produto na sua wishlist, <a href="/"> veja todos os produtos</a></p>
        @endif
    </div>

@endsection
