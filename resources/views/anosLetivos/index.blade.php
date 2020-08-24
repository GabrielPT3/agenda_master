@extends('layout')

@section('titulo')
Anos Letivos
@endsection

@section('subtitulo')
    <center><h1>Anos Letivos</h1></center>
@endsection

@section('conteudo')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<button type="button" class="btn btn-light" data-toggle="modal" data-target="#ModalCriar">Criar Novo</button>
<table class="table table-striped table-dark" id="tabela"> 
    <thead>
        <tr>
            <th scope="col">Ano</th>
            <th scope="col" style="text-align: center;">Ativo</th>
        </tr>
    </thead>
    <tbody>
         @foreach($anosLetivos as $ano)
        <tr>
            <th scope="row">{{$ano->ano}}</th>
            <th style="text-align: center;"><input type="checkbox" href="javascript:;" @if($ano->ativo == 'sim') id="ativo" checked onclick="return false;" @else onclick="FormAlterarUrl({{$ano->id_ano_letivo}})" data-toggle="modal" data-target="#ModalAnoAtivo" @endif></th>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
$(document).ready(function(){
    $('input:checkbox').click(function() {
        $('input:checkbox').not(this).prop('checked', false);
    });

    
    $('#ModalAnoAtivo').on('hide.bs.modal', function (e) {
        $('input:checkbox').not(this).prop('checked', false);
        $('#ativo').prop('checked', true);
    });
    
});
</script>

<button type="button" class="btn btn-light" onclick="location.href='{{route('index')}}'">Voltar</button>

<div class="modal fade" id="ModalCriar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('anosletivos.create')}}" id="formCriar" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Confirmar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}
            <center>Deseja criar um novo ano letivo?<br><br>
            <label>Ano Letivo:</label>
            <input type="text" name="ano" value="{{ now()->year }}/{{ now()->year+1 }}" style="width:110px" class="form-control formsinputs"><br><br></center>
              
            
            <strong style="color:red">Aviso: Esta ação vai apenas criar um ano letivo novo depois será necessario criar os dados de alunos, turmas, curso, etc. manualmente!</strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success" onclick="enviarFormApagar()">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div> 

 <div class="modal fade" id="ModalAnoAtivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" id="formAlterar" method="get">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Confirmar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}

              
            Deseja alterar o ano letivo ativo?<br><br>
            <strong style="color:red">Aviso: Esta ação pode causar problemas com a manipulação de dados!</strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div> 

<script>
    function FormAlterarUrl(idAno){
        var hostname = window.location.hostname;
        var url = 'http://'+hostname+'/anosletivos/'+idAno+'/alteraranoativo';

        console.log(url);
        $("#formAlterar").attr('action', url);
    }
</script>
@endsection