@if($errors->any())
    @foreach ($errors->all() as $error)
        {{$error}} <br>
    @endforeach    
@endif
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    Nome: <br> <input type="text" name="firstName" required> <br>
    sobrenome: <br> <input type="text" name="lastName" required> <br>
    Email: <br> <input name="email" type="email" required> <br>
    Password: <br> <input type="password" name="password" required> <br>
    <button type="submit">Cadastrar</button>
</form>
