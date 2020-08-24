@extends('layout')

@section('titulo')
Contactos
@endsection

@section('subtitulo')
    <center><h1>Contacto</h1></center>
@endsection

@section('conteudo')


@if(!auth()->check())<br><br><h3><center>Percisa de estar logado para contactar um administrador!</center></h3>
@else
<form method="post" action="{{route('contactos.enviar')}}">
    @csrf
    <div class="form-group" >
        <label for="exampleFormControlInput1">Endereço de email</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" value="{{auth()->user()->email}}" name="email" readonly>
        @if($errors->has('email'))
        {{$errors->first('email')}}<br>
    @endif
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Assunto</label>
        <select class="form-control" id="exampleFormControlSelect1" name="assunto">
            <option value="Suporte">Suporte</option>
            <option value="Feedback">Feedback</option>
            <option value="Outro">Outro</option>
        </select>
        @if($errors->has('assunto'))
            {{$errors->first('assunto')}}<br>
        @endif
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Mensagem</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="mensagem" placeholder="Insira uma mensagem..."></textarea>
        @if($errors->has('mensagem'))
            {{$errors->first('mensagem')}}<br>
        @endif
    </div>
    <input type="submit" name="criar" value="Enviar" class="btn btn-outline-light">
</form>
@endif
@endsection