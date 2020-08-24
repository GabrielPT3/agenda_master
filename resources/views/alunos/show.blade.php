@extends('layout')
@section('titulo')
Detalhes
@endsection

@section('conteudo')

@section('subtitulo')
<center><h1>Detalhes</h1></center>
@endsection

<center>    

<div class="card">
<br>
  <center>
    @if(isset($aluno->fotografia))<img class="imgprofile" src="{{asset('imagens/alunos/'.$aluno->fotografia)}}">
    @else<img src="{{asset('img/logo2.png')}}" style="width:75px;height:auto;">@endif
</center>
<br>
<h3 class="black">{{$aluno->nome}}</h3>
<br>
<center><table >
    <tr>
        <td style="text-align: right;"><p class="title">Email: </p></td>
        <td><p class="title"> {{$aluno->email}}</p></td>
    </tr>
    <tr>
        <td style="text-align: right;"><p class="title">Numero: </p></td>
        <td><p class="title"> {{$aluno->numero}}</p></td>
    </tr>
    <tr>
        <td style="text-align: right;"><p class="title">Turma: </p></td>
        <td><p class="title"> @if($aluno->id_turma != 0){{$aluno->turma->turma}} @else Turma não atribuida @endif</p></td>
    </tr>
    <tr>
        <td style="text-align: right;"><p class="title">Ano: </p></td>
        <td><p class="title"> @if($aluno->id_turma != 0){{$aluno->turma->ano}}@endif</p></td>
    </tr>
    <tr>
        <td style="text-align: right;"><p class="title">Data de Nascimento: </p></td>
        <td><p class="title"> @if(!is_null($aluno->data_nascimento)){{$aluno->data_nascimento->format('d-m-Y')}}@endif</p></td>
    </tr>
    <tr>
        <td style="text-align: right;"><p class="title">Nacionalidade: </p></td>
        <td><p class="title"> {{$aluno->nacionalidade}}</p></td>
    </tr>
    <tr>
        <td style="text-align: right;"><p class="title">Morada: </p></td>
        <td><p class="title"> {{$aluno->morada}}</p></td>
    </tr>
    
</table></center>
<br>
    
</div>

</center>

<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>


@endsection