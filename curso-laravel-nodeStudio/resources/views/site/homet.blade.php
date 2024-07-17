@extends('site/layoutt')
@section('title', 'Essa é a pagina home')
@section('conteudo')
    {{--verificando existencia de uma variavel com um operador ternario--}}
    {{--isset($nome) ? 'Existe' : 'Não existe'--}}
    {{--$teste ?? 'definindo valor padrão pra variavel inexistente'--}}

    {{--Estrutura de controle--}}

    @if($nome == 'Ruan')
        True
    @else
        False
    @endif
    <br>
    {{--Inverso--}}

    @unless($nome == 'Ruan')
        False
    @else
        True
    @endunless
    <br>
    {{--Switch--}}

    @switch($idade)
        @case(24)
            idade está certa
            @break
        @case(!24)
            idade está errada
            @break
        @default
            
    @endswitch
    <br>
    {{--isset--}}

    @isset($nome)
        True
    @endisset
    <br>
    {{--empty--}}

    @empty($idade)
        Está vazia
    @endempty
    <br>
    {{--auth--}}

    @auth
        Está autenticado
    @endauth
    <br>
    {{--Inverso do auth--}}

    @guest
        Não está autenticado
    @endguest
    <br>
    {{--Estrutura de Repetição--}}

    @for ($i = 0; $i <= 3; $i++)
        O valor de i é {{$i}} <br>
    @endfor
    <br>
    {{--While--}}

    @php
        $i = 0;
    @endphp

    @while ($i <=4)
        O valor de i com o while é {{ $i }} <br>
        @php $i++ @endphp
    @endwhile
    <br>
    {{--For each--}}
    {{--frutas criadas no array em ProdutoController--}}
    @foreach ($frutas as $fruta)
        {{$fruta}} <br>
    @endforeach
    <br>
    {{--For else--}}
    {{--Definindo valor padrão para caso o array no ProdutoController esteja vazio--}}
    @forelse ($frutas as $fruta)
        {{$fruta}} <br>
    @empty
        array está vazio
    @endforelse
    <br>
    {{--Includes--}}

    @include('includes/mensagem', ['titulo' => 'este é o titulo'])
    <br>
    {{--Component--}}

    @component('components/sidebar')
    @slot('paragrafo')
        texto qualquer vindo do slot
    @endslot
    @endcomponent
    <br>
    {{--Stacks e push--}}

    @push('style')
         <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    @endpush

    @push('script')
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>   
    @endpush
@endsection