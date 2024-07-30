@extends('site/layout')
@section('title', 'Carrinho')
@section('conteudo')

<div class="row container">

      {{--exibindo mensagens--}}

  @if ($mensagem = Session::get('sucesso'))
      <div class="card green">
        <div class="card-content white-text">
          <span class="card-title">Parabéns!</span>
          <p>{{$mensagem}}</p>
        </div>
      </div>
  @endif

  @if ($mensagem = Session::get('aviso'))
      <div class="card blue">
        <div class="card-content white-text">
          <span class="card-title">Tudo bem!</span>
          <p>{{$mensagem}}</p>
        </div>
      </div>
  @endif

    <div>
      @if($itens->count() == 0)
      <div class="card orange">
        <div class="card-content white-text">
          <span class="card-title">Seu carrinho está vazio!</span>
          <p>Aproveite nossas promoções!</p>
        </div>
      </div>
      @else
        <h5>Seu carrinho possui: {{$itens->count()}} produtos.</h5>
        <table class="striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              @foreach($itens as $item)
              <tr>

                {{--dados do produto--}}

                  <td><img src="{{ $item->imagem }}" alt="" width="70px" class="responsive-img circle"></td>
                  <td>{{ $item->nome }}</td>
                  <td>R${{number_format($item->valor, 2, ',', '.')}}</td>
                  <td>

                    {{--atualizando quantidade do produto--}}

                      <form action="{{ route('site/attquantidade') }}" method="POST">
                          @csrf
                          <input style="width: 40px; font-weight:600;" class="white center" type="number" name="quantidade" value="{{ $item->quantidade }}" min="1">
                          <input type="hidden" name="id" value="{{ $item->id }}">
                          <button type="submit" class="btn-floating waves-effect waves-light orange"><i class="material-icons">refresh</i></button>
                      </form>
                  </td>
                  <td>

                    {{--removendo itens do carrinho--}}

                    <form action="{{route('site/removecarrinho')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id" value="{{$item->id}}">
                    <button class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
                    </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>

      <div class="card orange">
        <div class="card-content white-text">
          <span class="card-title">R${{ number_format($total, 2, ',', '.') }}</span>
          <p>Pague em 12x sem juros!</p>
        </div>
      </div>

      @endif
            
        <div class="row container center">
            <a href="{{route('site/index')}}" class="btn waves-effect waves-light blue">Continuar comprando<i class="material-icons right">arrow_back</i></a>
            {{--é possivel apenas substituir o button pelo "a" e linkar a rota no href--}}
            <form action="{{route('site/limparcarrinho')}}" method="GET" enctype="multipart/form-data">
              @csrf
            <button class="btn waves-effect waves-light blue">Limpar carrinho<i class="material-icons right">clear</i></button>
          </form>
            <button class="btn waves-effect waves-light green">Finalizar pedido<i class="material-icons right">check</i></button>
        </div>
    </div>
</div>

@endsection
