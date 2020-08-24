@extends('layout')
@section('titulo')
Turmas
@endsection
@section('subtitulo')
    <center><h1>Editar Turma {{$turma->ano}}{{$turma->turma}}</h1></center>
@endsection

@section('conteudo')
<center>
<form method="post" action="{{route('turmas.update',['id'=>$turma->id_turma])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <table style="color: white; margin-left: 10%">
    <tr><td style="text-align: right;"><label>Turma:</label></td>
    <td><input type="text" name="turma" value="{{$turma->turma}}" class="form-control formsinputs"><br>
    @if($errors->has('turma'))
        {{$errors->first('turma')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Ano:</label></td>
    <td><select name="ano" id="ano" class="form-control formsinputs">
        <option value="10" @if($turma->ano == 10) selected @endif>10</option>
        <option value="11" @if($turma->ano == 11) selected @endif>11</option>
        <option value="12" @if($turma->ano == 12) selected @endif>12</option>
    </select><br>
    @if($errors->has('ano'))
        {{$errors->first('ano')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Curso:</label></td>
    <td><select name="id_curso" class="form-control formsinputs">
        @foreach($cursos as $curso)
        <option value="{{$curso->id_curso}}" @if($turma->id_curso == $curso->id_curso) selected @endif>{{$curso->nome}}</option>
        @endforeach
    </select><br>
    @if($errors->has('id_curso'))
        {{$errors->first('id_curso')}}<br>
    @endif</td></tr>
    </table>
    <br><input type="submit" name="editar" class="btn btn-success" value="Editar">
</form>
</center>
<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>

@endsection