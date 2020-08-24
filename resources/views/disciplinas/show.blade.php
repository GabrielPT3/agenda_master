@extends('layout')



@section('titulo')
Detalhes
@endsection



@section('conteudo')
<center><h1>Detalhes</h1></center>

<table class="table table-striped table-dark"> 
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col" style="text-align: center;">Designação</th>
            <th scope="col" style="text-align: center;">Numero de aulas</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{$disciplina->id_disciplina}}</th>
            <th style="text-align: center;">{{$disciplina->designacao}}</th>
            <th style="text-align: center;">{{$disciplina->numero_aulas}}</th>

        </tr>
    </tbody>
</table>

<br>
<button class="accordion">Turmas</button>
<div class="panel">
    <table class="table table-striped table-dark"> 
        <thead>
            <tr>
                <th scope="col">Turma</th>
                <th scope="col" style="text-align: center;">Remover</th>
            </tr>
        </thead>
        <tbody>            
            @foreach($disciplinaTurmas as $turma)
            <tr>
                <th scope="row">{{$turma->ano}}{{$turma->turma}}</th>
                <td style="text-align: center;"><a href="javascript:;" data-toggle="modal" onclick="removerTurma({{$disciplina->id_disciplina}},{{$turma->id_turma}})" data-target="#ModalRemoverTurma" ><i class="fa fa-minus-circle"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-light"  style="margin-left: 91%;" href="javascript:;" data-toggle="modal" data-target="#ModalAdicionarTurma">Adicionar</button>
</div>
<br>

 <div class="modal fade" id="ModalAdicionarTurma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" id="formAdicionar" method="get">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Adicionar turma</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}
            
            <center><select class="form-control" style="width:300px" id="turmas" onchange="FormAdicionarUrl({{$disciplina->id_disciplina}})">
                @if($turmas->isEmpty())
                <option disabled hidden selected>Sem turmas para adicionar</option>
                @else
                <option disabled hidden selected>Selecione uma turma</option>
                @foreach($turmas as $turma)<option value="{{$turma->id_turma}}">{{$turma->ano}}{{$turma->turma}}</option>@endforeach 
                @endif
            </select></center>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success" onclick="enviarFormAdicionar()">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div> 

 <div class="modal fade" id="ModalRemoverTurma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" id="formApagar" method="get">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Confirmar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}
            
            Deseja remover a turma?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success" onclick="enviarFormApagar()">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div> 


<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>


<script>
    
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
    
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } 
        else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}
    
function removerTurma(idDisciplina,idTurma){

    //console.log(idTurma,idDisciplina);
    var url = 'http://localhost/disciplinas/'+idDisciplina+'/show/remover/'+idTurma;
    console.log(url);
    $("#formApagar").attr('action', url);
}

function enviarFormApagar(){
    
    $("#formApagar").submit();
    
}
    
function FormAdicionarUrl(idDisciplina){
    var hostname = window.location.hostname;
    var select = document.getElementById("turmas");
    var idTurma = select.options[select.selectedIndex].value;
    var url = 'http://'+hostname+'/disciplinas/'+idDisciplina+'/show/adicionar/'+idTurma;

    console.log(url);
    $("#formAdicionar").attr('action', url);
}
    
function enviarFormAdicionar(){
    
    $("#formAdicionar").submit();
    
}
   
</script>

@endsection