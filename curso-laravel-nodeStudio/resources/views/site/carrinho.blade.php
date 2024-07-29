@extends('site/layout')
@section('title', 'Carrinho')
@section('conteudo')

    <div class="row container">
        <div>
            <h5>Seu carrinho possui: {{$itens->count()}} produtos. </h5>
            <table>
                <thead>
                  <tr>
                      <th></th>
                      <th>Nome</th>
                      <th>preço</th>
                      <th>quantidade</th>
                      <th></th>
                  </tr>
                </thead>
        
                <tbody>
                    @foreach($itens as $item)
                    <tr>
                        <td><img src="{{$item->imagem}}" alt="" width="70px" class="responsive-img circle"></td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td><input type="number" name="quantity" value="{{$item->quantity}}"></td>
                        <td> <button class="btn-floating waves-effect waves-light orange"><i class="material-icons">refresh</i></button>
                        <td> <button class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
                        </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="row container center">
                <button class="btn-large waves-effect waves-light blue">Continuar comprando<i class="material-icons right">arrow back</i></button>
                <button class="btn-large waves-effect waves-light blue">Limpar carrinho<i class="material-icons right">clear</i></button>
                <button class="btn-large waves-effect waves-light green">Finalizar pedido<i class="material-icons right">check</i></button>
              </div>
                
        </div>
    </div>

@endsection
