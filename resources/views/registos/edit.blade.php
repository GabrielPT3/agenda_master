@extends('layout')



@section('titulo')
Aula
@endsection

@section('subtitulo')
    <center><h1>Aula</h1></center>
@endsection

@section('conteudo')
<center>
<br>
<form method="post" action="{{route('registosaula.update', ['uuidaula'=>$uuidaula])}}" enctype="multipart/form-data">
    @csrf
    <label>Lição:</label>
    <input type="number" name="licao" value="{{$aula->licao}}"><br>
    @if($errors->has('licao'))
        {{$errors->first('licao')}}<br>
    @endif
    <label>Observacoes:</label>
    <input type="text" name="observacoes" value="{{$aula->observacoes}}"><br>
    @if($errors->has('observacoes'))
        {{$errors->first('observacoes')}}<br>
    @endif
    <input type="submit" name="criar">
</form>


</center>

@endsection