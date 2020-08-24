@extends('layout')
@section('titulo')
Turmas
@endsection
@section('subtitulo')
    <center><h1>Criar Nova Turma</h1></center>
@endsection

@section('conteudo')
<center>
<form method="post" action="{{route('turmas.store')}}" enctype="multipart/form-data">
    @csrf
    <table style="color: white; margin-left: 10%">
    <tr><td style="text-align: right;"><label>Turma*:</label></td>
    <td><input type="text" name="turma" value="{{@old('turma')}}" class="form-control formsinputs" placeholder="Insira a turma..."><br>
    @if($errors->has('turma'))
        {{$errors->first('turma')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Ano*:</label></td>
    <td><select name="ano" id="ano" class="form-control formsinputs">
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select><br>
    @if($errors->has('ano'))
        {{$errors->first('ano')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Curso*:</label></td>
    <td><select name="id_curso" class="form-control formsinputs">
        @foreach($cursos as $curso)
        <option value="{{$curso->id_curso}}">{{$curso->nome}}</option>
        @endforeach
    </select><br>
    @if($errors->has('id_curso'))
        {{$errors->first('id_curso')}}<br>
    @endif</td></tr>
    </table>
    (*) Campos obrigatorios<br>
    <br><input type="submit" name="criar" class="btn btn-success" value="Criar">
</form>
</center>
<button type="button" class="btn btn-light" onclick="location.href='{{route('turmas.index')}}'">Voltar</button>

@endsection