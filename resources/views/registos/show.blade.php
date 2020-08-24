@extends('layout')
@section('titulo')
Detalhes
@endsection

@section('conteudo')

@section('subtitulo')
<center><h1>Detalhes</h1></center>
@endsection

<table class="table table-striped table-dark"> 
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Data de nascimento</th>
            <th scope="col">Turma</th>
            <th scope="col">Ano</th>
            <th scope="col">Nacionalidade</th>
            <th scope="col">Morada</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{$aluno->id_aluno}}</th>
            <th>{{$aluno->nome}}</th>
            <th>@if(!is_null($aluno->data_nascimento)){{$aluno->data_nascimento->format('Y-m-d')}}@endif</th>
            <th>{{$aluno->turma->turma}}</th>
            <th>{{$aluno->ano}}</th>
            <th>{{$aluno->nacionalidade}}</th>
            <th>{{$aluno->morada}}</th>
            <th>{{$aluno->email}}</th>
        </tr>
        @if(isset($aluno->fotografia))<tr>
            <th>Fotografia</th>
            <th><img class="imgprofile" src="{{asset('imagens/alunos/'.$aluno->fotografia)}}"></th>
        </tr>@endif
    </tbody>
</table>

<center>
    <button type="button" class="btn btn-light" onclick="location.href='{{route('registos.index', ['uuidturma'=>$uuidturma,'uuidmodulo'=>$uuidmodulo,'uuidaula'=>$uuidaula])}}'">Voltar</button>
</center>

@endsection