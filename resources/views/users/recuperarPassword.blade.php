<html>

    <head>

        <title>Recuperar Password</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

        <style>
            .bcklogin{
                background: url('{{asset("img/bcklogin.jpg")}}');
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
            .card{

                width: 960px;
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                box-sizing: border-box;
                justify-content: center;
                align-items: center;
                margin-top: 7%;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                font-family:'Raleway';
                
            }

            .inputform{
                font-size: 15px;
                line-height: 1.5;
                color: #666;
                display: block;
                background: #e6e6e6;
                height: 50px;
                width:auto;
                border-radius: 25px;
                padding: 0 30px 0 68px;
                outline: none;
                border: solid 0px #2F80A7;
                transition: border-width 0.6s linear;
            }
            .inputform:hover {
                border-width: 2px;
            }

            .textareaform{
                font-size: 15px;
                line-height: 1.5;
                color: #666;
                display: block;
                background: #e6e6e6;
                height: 50px;
                width:auto;
                border-radius: 5px;
                padding: 0 30px 0 68px;
                outline: none;
                border: solid 0px #2F80A7;
                transition: border-width 0.6s linear;
            }

            .textareaform:hover{
                border-width: 2px;
            }

            .textareaform::-webkit-input-placeholder{
                line-height:50px;
            }
        </style>
    
    </head>

    <body class="bcklogin">
            <div class="card">
                <center>
                    <img src="{{asset('img/logo2.png')}}" style="width: 100px; height:auto;">
                </center>
                <br><br>
                <center><h3>Recuperar Password</h3></center>
                <br>
                <form method="post" action="{{route('contactos.recuperarpassword')}}">
                    @csrf
                    <div class="form-group" style="position:relative;margin: 0 auto;display: table;">
                        
                        <input placeholder="Email" type="email" class="inputform" id="exampleFormControlInput1" name="email">
                        <i style="color: #666;position:absolute;left:30px;display: inline-block;top:15px;bottom:15px;height:20px;" class="fa fa-envelope" aria-hidden="true"></i>  
                        @if($errors->has('email'))
                        {{$errors->first('email')}}<br>
                    @endif
                    </div>
                    <br>
                    <input type="submit" name="criar" value="Enviar" class="btn btn-primary">
                </form>
                <a href="{{ route('login') }}" style="float:right;">Login -></a>
            </div>
    </body>
    <script src="{{ asset ('js/all.js')}}"></script>
    <script src="{{ asset ('js/jquery.min.js')}}"></script>
    <script src="{{ asset ('js/bootstrap.min.js')}}"></script>   
</html>

