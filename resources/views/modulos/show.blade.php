@extends('layout')
@section('titulo')
Modulos
@endsection
@section('subtitulo')
    <center><h1>Detalhes</h1></center>
@endsection
@section('conteudo')
<br><br>  
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col" style="text-align: center;">Designação</th>
      <th scope="col" style="text-align: center;">Ano</th>
      <th scope="col" style="text-align: center;">Numero de aulas</th>
      <th scope="col" style="text-align: center;">Ficha Informativa</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Mod. {{$modulo->numero}}</td>
      <td style="text-align: center;">{{$modulo->designacao}}</td>
      <td style="text-align: center;">{{$modulo->ano}}</td>
      <td style="text-align: center;">{{$modulo->num_aulas}}</td>
      <td style="text-align: center;">@if(!is_null($modulo->ficha_informativa))<a target="_blank" href="{{asset('pdf/modulos/'.$modulo->ficha_informativa)}}"><i class="far fa-file-pdf fa-2x"></i></a>@endif</td>
    </tr>
  </tbody>
</table>
<br><br>

<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>

@endsection