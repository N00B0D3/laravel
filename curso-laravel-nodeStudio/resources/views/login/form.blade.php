@if($mensagem = Session::get('erro'))
    {{ $mensagem }}
@endif

@if($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach    
@endif
<form action="{{ route('login/auth') }}" method="POST">
    @csrf
    Email: <br><input type="email" name="email" required> <br>
    Password: <br><input type="password" name="password" required> <br>
    <input type="checkbox" name="remember"> lembrar-me
    <button type="submit">Entrar</button>
</form>
