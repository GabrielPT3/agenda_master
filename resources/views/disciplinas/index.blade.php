@extends('layout')



@section('titulo')
Disciplinas
@endsection

@section('subtitulo')
    <center><h1>Disciplinas</h1></center>
@endsection

@section('conteudo')
<button type="button" class="btn btn-light" onclick="location.href='{{route('disciplinas.create')}}'">Criar Nova</button>
<table class="table table-striped table-dark" id="tabela"> 
    <thead>
        <tr>
            <th scope="col">Designação</th>
            <th scope="col" style="text-align: center;">Detalhes</th>
            @if(auth()->check())<th scope="col" style="text-align: center;">Editar</th>@endif
            @if(auth()->check())<th scope="col" style="text-align: center;">Apagar</th>@endif
        </tr>
    </thead>
    <tbody>
         @foreach($disciplinas as $disciplina)
        <tr>
            <th scope="row">{{$disciplina->designacao}}</th>
            <th style="text-align: center;"><a href="{{route('disciplinas.show', ['id'=>$disciplina->id_disciplina])}}"><i class="fa fa-plus-circle"></i></a></th>
            <td style="text-align: center;"><a href="{{route('disciplinas.edit', ['id'=>$disciplina->id_disciplina])}}"><i class="fa fa-pen-square"></i></a></td>
            <td style="text-align: center;"><a href="javascript:;" data-toggle="modal" onclick="apagarDisciplina({{$disciplina->id_disciplina}})" data-target="#ModalApagarDisciplina"><i class="fa fa-minus-circle"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$disciplinas->render()}}
<button type="button" class="btn btn-light" onclick="location.href='{{route('index')}}'">Voltar</button>

 <div class="modal fade" id="ModalApagarDisciplina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" id="formApagar" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Confirmar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
              
            Deseja apagar a disciplina?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success" onclick="enviarFormApagar()">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div> 

<script>
    function apagarDisciplina(idDisciplina){

        //console.log(idDisciplina)
        var url = 'http://localhost/disciplinas/'+idDisciplina+'/delete';
        //console.log(url)
        $("#formApagar").attr('action', url);
    }

    function enviarFormApagar(){

        $("#formApagar").submit();

    }
</script>
@endsection