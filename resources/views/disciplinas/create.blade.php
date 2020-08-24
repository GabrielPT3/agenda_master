@extends('layout')
@section('titulo')
Disciplinas
@endsection

@section('conteudo')

@section('subtitulo')
<center><h1>Criar Nova Disciplina</h1></center>
@endsection

<center>
<form method="post" action="{{route('disciplinas.store')}}" enctype="multipart/form-data">
    @csrf
    <table style="color: white; margin-left: 10%">
    <tr><td style="text-align: right;"><label>Designação*:</label></td>
    <td><input type="text" name="designacao" value="{{@old('designacao')}}" class="form-control formsinputs" placeholder="Insira a designação da disciplina..."><br>
    @if($errors->has('designacao'))
        {{$errors->first('designacao')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Numero de aulas:</label></td>
    <td><input type="number" name="numero_aulas" value="{{@old('numero_aulas')}}" class="form-control formsinputs" placeholder="Insira o número de aulas da disciplina..." min="1"><br>
    @if($errors->has('numero_aulas'))
        {{$errors->first('numero_aulas')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Curso*:</label></td>
    <td><select name="id_curso[]" multiple size="3" class="form-control formsinputs">
        @foreach($cursos as $curso)<option value="{{$curso->id_curso}}">{{$curso->designacao}}</option>@endforeach
    </select><br></td></tr>
    </table>
    (*) Campos obrigatorios<br>
    <br><input type="submit" name="criar" class="btn btn-success" value="Criar">
</form>
</center>
<button type="button" class="btn btn-secondary" onclick="location.href='{{route('disciplinas.index')}}'">Voltar</button>

@endsection