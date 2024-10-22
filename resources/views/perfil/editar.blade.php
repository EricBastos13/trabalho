<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/perfilstl.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h1>Editar Perfil</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('perfil.atualizar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nomesobrenome">Nome</label>
                <input type="text" name="nomesobrenome" id="nomesobrenome" value="{{ old('nomesobrenome', Auth::user()->nomesobrenome) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="apelido">Apelido</label>
                <input type="text" name="apelido" id="apelido" value="{{ old('apelido', Auth::user()->apelido) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="cep">cep</label>
                <input type="text" name="cep" id="cep" value="{{ old('cep', $localizacao->cep) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="cidade">cidade</label>
                <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $localizacao->cidade) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="estado">estado</label>
                <input type="text" name="estado" id="estado" value="{{ old('estado', $localizacao->estado) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="foto">Foto (opcional)</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </form>
    </div>
</body>
<script src="/js/menu_lateral.js"></script>
</html>

