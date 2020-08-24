@extends('layout')
@section('titulo')
Editar
@endsection
@section('subtitulo')
    <center><h1>Editar</h1></center>
@endsection
@section('conteudo')

<center>
<form method="post" action="{{route('cursos.update',['id'=>$curso->id_curso])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <table style="color: white; margin-left: 10%">
    <tr><td style="text-align: right;"><label>Nome:</label></td>
    <td><input type="text" name="nome" value="{{$curso->nome}}" class="form-control formsinputs"><br>
    @if($errors->has('nome'))
        {{$errors->first('nome')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Designação:</label></td>
    <td><input type="text" name="designacao" value="{{$curso->designacao}}" class="form-control formsinputs"><br>
    @if($errors->has('designacao'))
        {{$errors->first('designacao')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Ficha Informativa:</label></td>
    <td><input type="file" name="ficha_informativa" value="{{asset('pdf/cursos/'.$curso->ficha_informativa)}}"><br>
    @if($errors->has('ficha_informativa'))
        {{$errors->first('ficha_informativa')}}<br>
    @endif</td></tr>
    @if(!is_null($curso->ficha_informativa))<tr><td style="text-align: right;"><label>Ficha Informativa Atual:</label></td>
    <td><a target="_blank" href="{{asset('pdf/cursos/'.$curso->ficha_informativa)}}" style="color: darkred;"><i class="far fa-file-pdf fa-2x"></i></a><br></td></tr>@endif
    </table>
    <br><input type="submit" name="editar" class="btn btn-success" value="Editar">
</form>
</center>
<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>

@endsection