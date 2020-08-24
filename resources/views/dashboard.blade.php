@extends('layout')


@section('titulo')
Dashboard
@endsection


@section('conteudo')

<center>
<h1>Dashboard</h1>
<br><br>
<div class="container">
  <div class="row">
    <div class="col">
        <button type="button" class="btn btn-danger" onclick="location.href='{{route('alunos.index')}}'">Alunos</button>
        <button type="button" class="btn btn-danger" onclick="location.href='{{route('turmas.index')}}'">Turmas</button>
        <button type="button" class="btn btn-danger" onclick="location.href='{{route('cursos.index')}}'">Cursos</button>
        <button type="button" class="btn btn-danger" onclick="location.href='{{route('disciplinas.index')}}'">Disciplinas</button>
        <button type="button" class="btn btn-danger" onclick="location.href='{{route('modulos.index')}}'">Modulos</button>
        @if(Auth::user()->tipo_user=="superadmin")<button type="button" class="btn btn-danger" onclick="location.href='{{route('anosletivos.index')}}'">Anos Letivos</button>@endif
        <button type="button" class="btn btn-danger" onclick="location.href='{{route('users.index')}}'">Contas</button>
    </div>
  </div>
</div>

</center>


<div class="modal fade" id="ModalAlerta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Aviso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="color: black">
            
            {{session()->get('alerta')}}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success" data-dismiss="modal">Confirmar</button>
        </div>
    </div>
  </div>
</div> 
 @if(session()->has('alerta'))
<script>
    $(window).on('load',function(){
        $('#ModalAlerta').modal('show');
    })
</script>
@endif
@endsection

