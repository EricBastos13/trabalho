<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
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

    <div class="about-container" id="sobre">
        <h2>Sobre Nós</h2>
        <p>Bem-vindo ao nosso portal dedicado à Câmara dos Deputados! Nosso objetivo é oferecer uma ponte entre a sociedade e as atividades legislativas, promovendo a transparência, o acesso à informação e a participação cidadã no processo democrático.</p>
        <p>Aqui, você encontrará conteúdos atualizados sobre projetos de lei, debates parlamentares e iniciativas que impactam diretamente a vida dos brasileiros...</p>
        <p>Junte-se a nós nessa missão de promover o diálogo entre a sociedade e seus representantes!</p>
    
        
    </div>
    <footer>
        <p>&copy; 2024. Todos os direitos reservados.</p>
    </footer>

    <script src="/js/menu_lateral.js"></script>
</body>
</html>