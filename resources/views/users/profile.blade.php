@extends('layout')


@section('titulo')
Perfil
@endsection


@section('conteudo')

<center>
<h1>Perfil</h1>
<br><br><br>


<div class="card">
  <center>
  @if(isset(Auth::user()->fotografia))
    <img class="imgprofile" src="{{asset('imagens/users/'.Auth::user()->fotografia)}}">
  @else
    <img src="{{asset('img/logo2.png')}}" style="width:75px;height:auto;">
  @endif
  </center>
  <br>
  <h3 class="black">{{Auth::user()->name}}</h3>
  <br>
  <p class="title">Email: {{Auth::user()->email}}</p>
  <p class="title">Disciplinas: <br> @foreach($disciplinas as $disciplina) {{$disciplina->designacao}} <br> @endforeach</p>
  <br>
  <input type="button" class="userbutton" value="Mudar Password" onclick="location.href='{{route('perfil.mudarpassword')}}'">
</div>

</center>

@endsection