@extends('layouts.main')

@section('title', 'Farfetch')

@section('content')

    <div id="events-container" class="col-md-12">

        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @if ($search)
                        <h2>Buscando por: {{ $search }}</h2>
                        
                    @endif
                    @if (count($roupas) == 0 && $search)
                        <p>Não foi possível encontrar nenhuma roupa com {{ $search }}! <a href="/">Ver
                                todas</a></p>
                    @elseif (count($roupas) == 0)
                        <p>Não há roupas disponíveis</p>
                    @endif
                    @foreach ($roupas as $roupa)
                        <div class="col mb-5">

                            <div class="card h-100">
                                <img class="card-img-top" src="/img/roupas/{{ $roupa->image }}" alt="{{ $roupa->tipo }}">
                                <div class="card-body p-4">

                                    <div class="text-center">
                                        <h5 class="fw-bolder">{{ $roupa->tipo }}</h5>
                                        R$ {{ $roupa->preco }}
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-success mt-auto"
                                            href="/roupas/{{ $roupa->id }}">Ver</a></div>
                                </div>

                            </div>


                        </div>
                    @endforeach

                </div>
            </div>
        </section>

    </div>
@endsection
