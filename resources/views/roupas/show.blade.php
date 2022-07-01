@extends('layouts.main')

@section('title', $roupa->tipo)

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <h1>{{ $roupa->tipo }}</h1>
            <hr>
            <div id="image-container" class="col-md-6">
                <img src="/img/roupas/{{ $roupa->image }}" alt="{{ $roupa->tipo }}" style="width: 500px;border-radius: 10px">
            </div>  
            <div id="info-container" class="col-md-6">
                
                <p class="roupa-marca">
                    <ion-icon name="attach"></ion-icon> Marca: {{ $roupa->marca }}
                </p>
                <p class="roupa-preco">
                    <ion-icon name="pricetags"></ion-icon> R$ {{ $roupa->preco }}
                </p>
               

                <h4>Disponível nos tamanhos:</h4>
                <ul id="roupas-list">
                    @foreach ($roupa->tamanhos as $tamanho)
                        <li>
                                <span>{{ $tamanho }}</span>
                        </li>
                    @endforeach

                </ul>

                @if (!$hasUserJoined)
                <form action="/roupas/wish/{{ $roupa->id }}" method="POST">
                    @csrf
                    <a href="/roupas/wish/{{ $roupa->id }}" class="btn btn-success" id="event-submit" onclick="event.preventDefault();
                         this.closest('form').submit();">
                        Adicionar à wishlist</a>
                </form>
            @else
            <p class="already-joined-msg">Esse produto já está na sua wishlist!</p>
            @endif
            </div>
        </div>
    </div>

@endsection
