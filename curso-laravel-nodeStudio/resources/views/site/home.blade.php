@extends('site/layout')
@section('title', 'Home')
@section('conteudo')

    <div class="row container">
        <div>
            @foreach ($produtos as $produto)
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ $produto->imagem }}">

                            {{--restrigindo recurso na view com can/cannot usando policy--}}
                            @can('verProduto', $produto)
                            <a href="{{ route('site/details', $produto->slug) }}"
                                class="btn-floating halfway-fab waves-effect waves-light red"><i
                                    class="material-icons">visibility</i></a>
                            @endcan
                            {{-- @cannot('verProduto', $produto)

                            @else
                            <a href="{{ route('site/details', $produto->slug) }}"
                                class="btn-floating halfway-fab waves-effect waves-light red"><i
                                    class="material-icons">visibility</i></a>
                            @endcannot --}}
                           
                        </div>
                        <div class="card-content">
                            <span class="card-title">{{ $produto->nome }}</span>
                            <p>{{ Str::limit($produto->descricao, 20) }}</p> {{-- limitando numero de caracteres com classse de manipulação de string STR --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row center">
        {{ $produtos->links('custom/pagination') }}
    </div>

@endsection
