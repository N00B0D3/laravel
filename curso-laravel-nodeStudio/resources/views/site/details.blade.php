@extends('site/layout')
@section('title', 'Detalhes')
@section('conteudo')

<div class="row container">
    <div class="col s12 m6">
        <img src="{{ $produto->imagem }}" class="responsive-img">    
    </div>

    <div class="col s12 m6">
        <h4>{{$produto->nome}}</h4>
        <h4>R$ {{number_format($produto->valor, 2, ',', '.')}}</h4>
        <p>{{$produto->descricao}}</p>
        <p>Postado por: {{$produto->user->firstName}} <br>
        Categoria: {{$produto->categoria->nome}}
        <p>Em estoque: <span id="estoque">{{ $produto->quantidade }}</span></p>
        </p>
        <form action="{{route('site/addcarrinho')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$produto->id}}">
            <input type="number" name="quantidade" value="1">
            <button class="btn orange btn-large">Comprar</button>
        </form> 
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var produtoId = "{{ $produto->id }}";

        function atualizarEstoque() {
            $.ajax({
                url: '/produto/' + produtoId + '/estoque',
                method: 'GET',
                success: function(response) {
                    if (response.quantidade !== undefined) {
                        $('#estoque').text(response.quantidade);
                    } else {
                        console.error('Erro ao obter o estoque:', response.error);
                    }
                },
                error: function(xhr) {
                    console.error('Erro na requisição:', xhr.statusText);
                }
            });
        }

        // Atualizar o estoque a cada 10 segundos
        setInterval(atualizarEstoque, 10000);

        // Atualizar o estoque imediatamente ao carregar a página
        atualizarEstoque();
    });
</script>

@endsection
