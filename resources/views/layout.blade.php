<html>

<head>
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <script src="{{ asset ('js/all.js')}}"></script>
    <script src="{{ asset ('js/jquery.min.js')}}"></script>
    <script src="{{ asset ('js/bootstrap.min.js')}}"></script> 
    

    @if(Auth::user()->dark_mode=='s')
        <style>
            .body{
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                font-family:'Raleway';  
            }
        </style>
    @else
        <style>
            .body{
                background-color:white;
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                font-family:'Raleway';
            }
        </style>
    @endif

    
</head>

    
    <body class="body bodybck">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#40829c;">
        <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('img/logo2.png')}}" style="width: 75px;height: auto;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link white" href="{{route('index')}}">Home</a>
                @if(Auth::check() && Auth::user()->tipo_user=="professor")<a class="nav-item nav-link white" href="{{route('registos.alunos')}}">Alunos</a>
                <a class="nav-item nav-link white" href="{{route('registos.criterios')}}">Criterios</a>@endif
                 @if(Auth::check() && Auth::user()->tipo_user!="pendente")<a class="nav-item nav-link white" href="{{route('contactos.index')}}">Contactos</a>@endif
            </div>
            <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('perfil') }}">
                                        Perfil
                                    </a>

                                    <a class="dropdown-item">
                                    <label>Fundo Animado</label>
                                    <div class="onoffswitch">
                                        <input onclick="darkMode()" type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" @if(Auth::user()->dark_mode=='s') checked @endif>
                                        <label class="onoffswitch-label" for="myonoffswitch">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
        </div>
    </nav>
    
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="wrap">
            <div id="divcont" class="divcont">
               @yield('subtitulo')
                <br>
                <div class="row">  
                    <div class="col-md-12">
                        @yield('conteudo')
                    </div>
                </div>
          
            </div>
        </div>
        </div>
        
        
    </div>
    </div>  

    <script type="text/javascript">
        function notification() {
            $('#notification').toast('show');
        }
    </script>
 
    


    <script>
        setTimeout(function() {
            $('#divcont').slideUp(0);
        }, 0);   
    </script> 

    <script>
        setTimeout(function() {
            $('#divcont').slideDown("slow");
        }, 0);   
    </script>   

    <script>
        setTimeout(function() {
            $('#alertmessage').fadeOut('slow');
        }, 3000);   
    </script>
    
        
        
    <script>
        function paginate(array){
        if(array.current_page != 1){
            var page = array.current_page-1;
            document.getElementById("anterior").href = '?page='+page;
        }
        if(array.current_page != array.last_page){
            var page = array.current_page+1;
            document.getElementById("seguinte").href = '?page='+page;
        }

        const div = document.getElementById('paginas');
        
        
        div.innerHTML = '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
        
        while ($('#paginas2').length > 0) {
            document.getElementById("paginas2").remove();
        }
        
        for(i = array.last_page; i>1;i--){
            div.insertAdjacentHTML("afterend",'<div id="paginas2"><li class="page-item"><a class="page-link" href="?page='+i+'">'+i+'</a></li></div>');    
        }
    }    
    </script>
        
        
        

@if(Auth::check())
    <script>
    var hostName = window.location.hostname;
        function darkMode(){

            var idUser = '{{Auth::user()->id}}';

            
            if('{{Auth::user()->dark_mode}}'=='s'){
                var darkMode = 's';
                var url = 'http://'+hostName+'/api/darkmode/'+darkMode+'/user/'+idUser;
                var pesquisa = new XMLHttpRequest();
                pesquisa.open('get',url,true);
        
                pesquisa.onreadystatechange = function(){
                    $rs = this.readyState; 
                    $s = this.status;

                    if($rs==4 && $s==200){
                        console.log(this.readyState+ ' '+ this.status);
                        location.reload();
                    }
                 

                }
            }
            else{
                var darkMode = 'n';
                var url = 'http://'+hostName+'/api/darkmode/'+darkMode+'/user/'+idUser;
                var pesquisa = new XMLHttpRequest();
                pesquisa.open('get',url,true);
        
                pesquisa.onreadystatechange = function(){
                    $rs = this.readyState; 
                    $s = this.status;

                    if($rs==4 && $s==200){
                        console.log(this.readyState+ ' '+ this.status);
                        location.reload();
                    }
                 

                }
            }
        
            pesquisa.send();
        
            
            
        }
        
    </script>
@endif



    
    @if(Auth::user()->dark_mode=='s')  
        <script>
            var images=new Array("{{asset('img/bckslide/1.jpg')}}","{{asset('img/bckslide/2.jpg')}}","{{asset('img/bckslide/3.jpg')}}");
            var nextimage=0;
            doSlideshow();

            function doSlideshow(){
                if(nextimage>=images.length){nextimage=0;}
                $('.bodybck')
                .css('background-image','url("'+images[nextimage++]+'")')
                .fadeIn(500,function(){
                    setTimeout(doSlideshow,10000);
                });
            }
        </script>
    @endif


    <div aria-live="polite" aria-atomic="true" style="position: fixed;bottom:10px;right:10px;min-height: 200px;">
        <div id="notification" class="toast" style="position: fixed; bottom: 10; right: 10;min-width: 200px;" data-delay="10000">
            <div class="toast-header" style="background-color:#122e75;color:white;">
            <strong class="mr-auto">Aviso</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div id="notificationbody" class="toast-body">
                @if(session()->has('permissoes')) 
                    {{session()->get('permissoes')}}
                    <script type="text/javascript">         
                        notification();
                    </script>
                @endif
                @if(session()->has('mensagem')) 
                    {{session()->get('mensagem')}}
                    <script type="text/javascript">
                        notification();
                    </script>
                @endif
            </div>
        </div>
    </div>

    
    </body>

</html>