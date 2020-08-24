@extends('layout')



@section('titulo')
Cursos
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
      <th scope="col" style="text-align: center;">Ficha Informativa</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td>{{$curso->nome}}</td>
      <td style="text-align: center;">{{$curso->designacao}}</td>
      <td style="text-align: center;">@if(!is_null($curso->ficha_informativa))<a target="_blank" href="{{asset('pdf/cursos/'.$curso->ficha_informativa)}}"><i class="far fa-file-pdf fa-2x"></i></a>@endif</td>
    </tr>

  </tbody>
</table>

<br><br>

<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>

@endsection