@extends('site/layout')
@section('title', 'Carrinho')
@section('conteudo')

<div class="row container">

  @if ($mensagem = Session::get('sucesso'))
      <div class="card green">
        <div class="card-content white-text">
          <span class="card-title">Parabéns</span>
          <p>{{$mensagem}}</p>
        </div>
      </div>
  @endif
    <div>
        <h5>Seu carrinho possui: {{$itens->count()}} produtos.</h5>
        <table>
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
                    <td><img src="{{ $item->imagem }}" alt="" width="70px" class="responsive-img circle"></td>
                    <td>{{ $item->nome }}</td>
                    <td>R${{number_format($item->valor, 2, ',', '.')}}</td>
                    <td>
                        <form action="{{ route('site/attquantidade') }}" method="POST">
                            @csrf
                            <input style="width: 40px; font-weight:600;" class="white center" type="number" name="quantidade" value="{{ $item->quantidade }}" min="1">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button type="submit" class="btn-floating waves-effect waves-light orange"><i class="material-icons">refresh</i></button>
                        </form>
                    </td>
                    <td>
                      <form action="{{route('site/removecarrinho')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                      <button class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
                      </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row container center">
            <button class="btn waves-effect waves-light blue">Continuar comprando<i class="material-icons right">arrow_back</i></button>
            <button class="btn waves-effect waves-light blue">Limpar carrinho<i class="material-icons right">clear</i></button>
            <button class="btn waves-effect waves-light green">Finalizar pedido<i class="material-icons right">check</i></button>
        </div>
    </div>
</div>

@endsection
