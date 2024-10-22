<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/perfilstl.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Usando a fonte 'Roboto' do Google Fonts  -->
</head>
<body>
    <header class="topo">
        <div class="menu">
            <button id="atvmenu" class="menu button">
                <img src="/img/iconedemenu.png" alt="menu">
                <div id="barraltr" class="barraltr">
                    <h1>Menu</h1>
                    <ul>
                        <li><a href={{route('welcome')}} class="nav-link" >Inicio</a></li>
                        @if(auth()->check())
                            <li><a href={{route('perfil.usuario')}}>Perfil</a></li>
                        @else
                            <li><a href={{route('login.index') }}>Perfil</a></li>
                        @endif                        
                        <li><a href={{route('info.fale')}} class="nav-link" >Fale conosco</a></li>
                        <li><a href={{route('info.sobre')}} class="nav-link" >Sobre nós</a></li>
                        @if (auth()->check())
                            <li><a href="#" onclick="logout(event);">logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>                         
                        @else
                            <li><a href={{route('login.index')}}>Login</a></li>
                        @endif
                    </ul>
                </div>
            </button>
        </div>
        <!-- Logo -->
        <div class="logo">LOGO</div>
    </header>

    <main>
        
        <div id="perfil">
            <div class="container">
            <aside class="topbar">
                    @if(auth()->check())
                        <div class="profile">
                            @if (Auth::user()->foto != NULL)
                                <img src="{{asset(Auth::user()->foto)}}" alt="Foto do Usuário" class="profile-pic">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Foto do Usuário" class="profile-pic">
                            @endif
                            <h2 class="profile-name">{{Auth::user()->nomesobrenome}}</h2>
                            <p class="profile-description">Descrição simples sobre o usuário.</p>
                        </div>
                        <div class="profile-likes">
                            <p ><a href={{route('perfil.editar')}}>editar perfil</a></p>
                        </div>
                    @endif
                </aside>
        
                <main class="content">
                    <h1>Bem-vindo ao Perfil</h1>
                    <p>Aqui você pode adicionar mais informações ou seções.</p>
                    <h2>Favoritos</h2>
                    @if($interacoes->isEmpty())
                        <p>Nenhum favoritado disponível.</p>
                    @else
                        <ul>
                            @foreach($interacoes as $interacao)
                                <div class="favoritos">
                                <div id="infoDiv">
                                    <p>nome:</p>
                                </div>
                                    
                                    <span><p>{{$interacao->id_candidato}}</p>
                                    
                                    <form action="{{ route('delete', $interacao->id_interacao) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta interação?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Excluir</button>
                                    </form>
                                    </span>
                                </div>
                            @endforeach
                        </ul>
                    @endif
                </main>
            </div>        
        </div>
    </main>

    <footer>
        <p>&copy; 2024. Todos os direitos reservados.</p>
    </footer>

    <script src="/js/menu_lateral.js"></script>
    <script src="/js/consulta-api.js"></script>
</body>
</html>