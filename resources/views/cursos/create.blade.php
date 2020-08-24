@extends('layout')



@section('titulo')
Cursos
@endsection


@section('subtitulo')
<center><h1>Criar Novo Curso</h1></center>
@endsection


@section('conteudo')

<center>
<form method="post" action="{{route('cursos.store')}}" enctype="multipart/form-data">
    @csrf
    <table style="color: white; margin-left: 10%">
    <tr><td style="text-align: right;"><label>Nome*:</label></td>
    <td><input type="text" name="nome" value="{{@old('nome')}}" class="form-control formsinputs" placeholder="Insira o nome do curso..."><br>
    @if($errors->has('nome'))
        {{$errors->first('nome')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Designação*:</label></td>
    <td><input type="text" name="designacao" value="{{@old('designacao')}}" class="form-control formsinputs" placeholder="Insira a designação do curso..."><br>
    @if($errors->has('designacao'))
        {{$errors->first('designacao')}}<br>
    @endif</td></tr>
    
    <tr><td style="text-align: right;"><label>Ficha Informativa:</label></td>
    <td><input type="file" name="ficha_informativa" value="{{@old('ficha_informativa')}}" ><br>
    @if($errors->has('ficha_informativa'))
        {{$errors->first('ficha_informativa')}}<br>
    @endif</td></tr>
    </table>
    (*) Campos obrigatorios<br>
    <br><input type="submit" name="criar" class="btn btn-success" value="Criar">
</form>

</center>
<button type="button" class="btn btn-light" onclick="location.href='{{route('cursos.index')}}'">Voltar</button>

@endsection