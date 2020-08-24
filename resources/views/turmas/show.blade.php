@extends('layout')
@section('titulo')
Detalhes
@endsection

@section('conteudo')

@section('subtitulo')
<center><h1>Detalhes</h1></center>
@endsection

<br><button class="accordion">Alunos</button>
<div class="panel">
    <table class="table table-striped table-dark"> 
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col" style="text-align: center;">Numero</th>
                @if(auth()->check())<th scope="col" style="text-align: center;">Remover</th>@endif
            </tr>
        </thead>
        <tbody>
             @foreach($alunos as $aluno)
            <tr>
                <th scope="row">{{$aluno->nome}}</th>
                <th style="text-align: center;">{{$aluno->numero}}</th>
                @if(auth()->check())<td style="text-align: center;"><a href="javascript:;" data-toggle="modal" onclick="apagarAluno({{$aluno->id_aluno}},{{$aluno->id_turma}})" data-target="#ModalRemoverAluno" ><i class="fa fa-minus-circle"></i></a></td>@endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-light"  style="margin-left: 91%;" href="javascript:;" data-toggle="modal" data-target="#ModalAdicionarAluno" onclick="adicionarAluno()">Adicionar</button>
</div>


<div class="modal fade" id="ModalAdicionarAluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" id="formAdicionar" method="get">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Adicionar alunos à turma</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}
            
            <center><select class="form-control" style="width:300px" id="alunos" onchange="FormAdicionarUrl({{$idTurma}})"></select></center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success" onclick="enviarFormAdicionar()">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div> 

 <div class="modal fade" id="ModalRemoverAluno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            
            Deseja remover o aluno da turma?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success" onclick="enviarFormApagar()">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div> 

<br>
<button class="accordion">Professores</button>
<div class="panel">
    <table class="table table-striped table-dark"> 
        <thead>
            <tr>
                <th scope="col">Disciplina</th>
                <th scope="col" style="text-align: center;">Professor</th>
                @if(auth()->check())<th scope="col" style="text-align: center;">Editar</th>@endif
            </tr>
        </thead>
        <tbody>            
            @foreach($turma as $professor)
            <tr>
                <th scope="row">{{$professor->designacao}}</th>
                <th style="text-align: center;">{{$professor->name}}</th>
                @if(auth()->check())<td style="text-align: center;"><a href="javascript:;" data-toggle="modal" onclick="editarProf({{$professor->id_disciplina}})" data-target="#ModalEditarProf" ><i class="fa fa-pen-square"></i></a></td>@endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="ModalEditarProf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" id="formEditarProf" method="get">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Editar professor da disciplina</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}
            <input type="hidden" id="id_disciplina" value="">
            <center><select class="form-control" style="width:300px" id="professores" onchange="FormEditarUrl({{$idTurma}})"></select></center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success" onclick="">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div> 

<br>

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

function apagarAluno(idAluno,idTurma){

    //console.log(idTurma,idAluno)
    var url = 'http://localhost/turmas/'+idTurma+'/show/remover/'+idAluno;
    //console.log(url)
    $("#formApagar").attr('action', url);
}

function enviarFormApagar(){
    
    $("#formApagar").submit();
    
}
    
function adicionarAluno(){
    var hostname = window.location.hostname;
    var url = 'http://'+hostname+'/api/obteralunossemturma/';
    var alunos;
    var pesquisa = new XMLHttpRequest();
    pesquisa.open('get',url,true);
        
    pesquisa.onreadystatechange = function(){
        $rs = this.readyState; 
        $s = this.status;
            

        if($rs==4 && $s==200){

            //console.log(this.readyState+ ' '+ this.status);
            alunos=JSON.parse(pesquisa.responseText);
            alunosLength=alunos.length;
            //console.log(alunosLength);
            $('#alunos')
                .empty()
                    
            if(alunosLength!=0){
                var select = document.getElementById("alunos");
                var option = document.createElement("option");
                option.text = "Selecione um aluno";
                option.disable = true;
                option.hidden = true;
                select.add(option);
                for(i=0;i<alunosLength;i++){
                    var select = document.getElementById("alunos");
                    var option = document.createElement("option");
                    option.text = alunos[i].nome;
                    option.value = alunos[i].id_aluno;
                    //console.log(alunos[i].id_aluno);
                    select.add(option);
                }    
            }
            else{
                var select = document.getElementById("alunos");
                var option = document.createElement("option");
                option.text = "Não existem alunos sem turma";
                option.disable = true;
                option.hidden = true;
                select.add(option);
            }
        }
    }
        
    pesquisa.send();
    
}

function FormAdicionarUrl(idTurma){
    var hostname = window.location.hostname;
    var select = document.getElementById("alunos");
    var idAluno = select.options[select.selectedIndex].value;
    var url = 'http://'+hostname+'/turmas/'+idTurma+'/show/adicionar/'+idAluno;

    //console.log(url);
    $("#formAdicionar").attr('action', url);
}
    
function enviarFormAdicionar(){
    
    $("#formAdicionar").submit();
}
    
function editarProf(idDisciplina){
    var hostname = window.location.hostname;
    var url = 'http://'+hostname+'/api/professorespordisciplina/'+idDisciplina;
    var professores;
    var input = document.getElementById("id_disciplina");
    input.value = idDisciplina;
    var pesquisa = new XMLHttpRequest();
    pesquisa.open('get',url,true);
        
    pesquisa.onreadystatechange = function(){
        $rs = this.readyState; 
        $s = this.status;
            

        if($rs==4 && $s==200){

            //console.log(this.readyState+ ' '+ this.status);
            professores=JSON.parse(pesquisa.responseText);
            professoresLength=professores.length;
            //console.log(professotesLength);
            $('#professores')
                .empty()
                    
            if(professoresLength!=0){
                var select = document.getElementById("professores");
                var option = document.createElement("option");
                option.text = "Selecione um professor";
                option.disable = true;
                option.hidden = true;
                select.add(option);
                for(i=0;i<professoresLength;i++){
                    var select = document.getElementById("professores");
                    var option = document.createElement("option");
                    option.text = professores[i].name;
                    option.value = professores[i].id;
                    select.add(option);
                }    
            }
            else{
                var select = document.getElementById("professores");
                var option = document.createElement("option");
                option.text = "Não existem professores";
                option.disable = true;
                option.hidden = true;
                select.add(option);
            }
        }
    }
        
    pesquisa.send();
    
}
    
function FormEditarUrl(idTurma){
    var hostname = window.location.hostname;
    var select = document.getElementById("professores");
    var idDisciplina = document.getElementById("id_disciplina").value;
    var idProfessor = select.options[select.selectedIndex].value;
    var url = 'http://'+hostname+'/turmas/'+idTurma+'/show/editar/'+idProfessor+'/'+idDisciplina;

    //console.log(url);
    $("#formEditarProf").attr('action', url);
}
    
function enviarFormEditar(){
    $("#formEditarProf").submit();
}
    
</script>

@endsection

