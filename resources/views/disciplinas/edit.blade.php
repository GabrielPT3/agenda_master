@extends('layout')
@section('titulo')
Disciplina
@endsection

@section('conteudo')

@section('subtitulo')
<center><h1>Editar Disciplina</h1></center>
@endsection
<center>
<form method="post" action="{{route('disciplinas.update', ['id'=>$disciplina->id_disciplina])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <table style="color: white; margin-left: 10%">
    <tr><td style="text-align: right;"><label>Designação:</label></td>
    <td><input type="text" name="designacao" value="{{$disciplina->designacao}}" style="width:100%;" class="form-control formsinputs"><br>
    @if($errors->has('designacao'))
        {{$errors->first('designacao')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Numero de aulas:</label></td>
    <td><input type="text" name="numero_aulas" value="{{$disciplina->numero_aulas}}" class="form-control formsinputs"><br>
    @if($errors->has('numero_aulas'))
        {{$errors->first('numero_aulas')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Curso:</label></td>
    <td><select name="id_curso[]" multiple size="3" class="form-control formsinputs">
        @foreach($cursos as $curso)<option value="{{$curso->id_curso}}" @if(in_array($curso->id_curso,$cursosDisciplinas))selected @endif>{{$curso->designacao}}</option>@endforeach
    </select><br></td></tr>
    </table>
    <br><input type="submit" name="criar" class="btn btn-success" value="Criar">
</form>
</center>
<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>
@endsection