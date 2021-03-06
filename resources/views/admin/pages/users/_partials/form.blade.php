@csrf
<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Nome:"
        value="{{ $user->name ?? old('name') }}" autofocus>
</div>
<div class="form-group">
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail:"
        value="{{ $user->email ?? old('email') }}">
</div>
<div class="form-group">
    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Senha:">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>