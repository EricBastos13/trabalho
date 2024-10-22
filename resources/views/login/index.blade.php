<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Cadastro</title>
    <link rel="stylesheet" href="/css/log&cadstl.css">
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <!--<header class="topo">
        <div class="menu">
            <script>
                function voltar(){
                    window.location.href="{{ route('welcome') }}";
                }
            </script>
            <button id="voltar" class="voltar" onclick="voltar()" alt="voltar">
                <img src="/img/iconedemenu.png" alt="voltar">
            </button>

        </div>
        <div class="logo">LOGO</div>

    </header>-->
    <header class="topo">
        <div class="menu">
            
            <a href="{{route('welcome')}}" id="voltar" class="voltar">
                <img src="https://img.icons8.com/ios-filled/50/000000/left.png" alt="voltar" />
            </a>
        </div>
        <!-- Logo -->
        <div class="logo">LOGO</div>
    </header>
    <div class="container">
        <div class="form-container">
            @csrf
            <!-- Botões para alternar entre Login e Cadastro -->
            <div class="toggle-buttons">
                <button class="toggle-btn active" id="login-btn" onclick="showLogin()">Login</button>
                <button class="toggle-btn" id="register-btn" onclick="showRegister()">Cadastro</button>
            </div>

            <!-- Formulário de Login -->
             
            <div id="login-form" class="form">
                @if($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <h2>Login</h2>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <input type="email" id="login-email" name="email" placeholder="Seu email" required>
                    <input type="password" id="login-password" name="password" placeholder="Sua senha" required>
                    <button type="submit">Entrar</button>
                </form>
            </div>

            <!-- Formulário de Cadastro -->
            <div id="register-form" class="form hidden">
                <h2>Cadastro</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('cadastro.inserir') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="foto">Foto de Perfil</label>
                    <input type="file" id="foto" name="foto" accept="image/*" required>
                    <input type="text" id="register-username" name="nomesobrenome" placeholder="Nome de usuário" required>
                    <input type="text" id="register-cpf" name="CPF" placeholder="Seu CPF" required>
                    <input type="date" id="register-data de nascimento" name="idade" required>
                    <label for="estado">Insira o estado ou o cep:</label><br>
                    <select id="estado" name="estado">
                        <option value="">Selecione seu estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                    <input type="text" id="cep" name="cep" maxlength="8" placeholder="Digite seu CEP">
                    <button type="button" onclick="buscarCEP()">Buscar CEP</button><br><br>
                    <input type="text" id="register-cidade" name="cidade" placeholder="Sua cidade" required>
                    <input type="email" id="register-email" name="email" placeholder="Seu email" required>
                    <input type="text" id="register-apelido" name="apelido" placeholder="Crie um apelido se preferir">
                    <input type="password" id="register-password" name="senha" placeholder="Crie uma senha" required>
                    <button type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024. Todos os direitos reservados.</p>
    </footer>

    <script src="/js/scriptlog&cad.js"></script>
</body>
</html>