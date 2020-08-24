@extends('layout')



@section('titulo')
Cursos
@endsection

@section('subtitulo')
    <center><h1>Cursos</h1></center>
@endsection

@section('conteudo')
<center><select id="anoletivo" onchange="selecionarCursos()" class="form-control" style="width:150px">
    @foreach($anosLetivos as $anos)
        <option value="{{$anos->id_ano_letivo}}">{{$anos->ano}}</option>
    @endforeach
</select></center>

<button type="button" class="btn btn-light" onclick="location.href='{{route('cursos.create')}}'">Criar Novo</button>
<table class="table table-striped table-dark" id="tabela">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col" style="text-align: center;">Designação</th>
      <th scope="col" style="text-align: center;">Detalhes</th>
      <th scope="col" style="text-align: center;">Editar</th>
      <th scope="col" style="text-align: center;">Apagar</th>
    </tr>
  </thead>
</table>

{{$cursos->render()}}

<button type="button" class="btn btn-light" onclick="location.href='{{route('index')}}'">Voltar</button>

 <div class="modal fade" id="ModalApagarCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              
            Deseja apagar o curso?
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
    function selecionarCursos(){
        var table = document.getElementById("tabela");
        while(table.rows.length > 1) {
            table.deleteRow(1);
        }
        var selObj = document.getElementById("anoletivo");
        var selValue = selObj.options[selObj.selectedIndex].value;
        var ano = selValue;
        //console.log(selValue,ano);
        var hostname = window.location.hostname;
        var url = 'http://'+hostname+'/api/cursosporano/'+ano;
        var cursos;
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;
            

            if($rs==4 && $s==200){

                //console.log(this.readyState+ ' '+ this.status);
                cursos=JSON.parse(pesquisa.responseText);
                cursosLength=cursos.length;
                //console.log(cursosLength);
                for(i=0;i<cursosLength;i++){
                    var row = table.insertRow(1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    cell1.innerHTML = cursos[i].nome;
                    cell2.innerHTML = cursos[i].designacao;          

                    var idCurso = cursos[i].id_curso;
                    var urlShow = 'http://'+hostname+'/cursos/'+idCurso+'/show';
                    var urlUpdate = 'http://'+hostname+'/cursos/'+idCurso+'/edit';
                    
                    
                    cell3.innerHTML = '<a href="'+urlShow+'"><i class="fa fa-plus-circle"></i><a/>';
                    cell4.innerHTML = '<a href="'+urlUpdate+'"><i class="fa fa-pen-square"></i><a/>';
                    cell5.innerHTML = '<a href="javascript:;" data-toggle="modal" onclick="apagarCurso('+cursos[i].id_curso+')" data-target="#ModalApagarCurso" ><i class="fa fa-minus-circle"></i><a/>';
                    
                    cell1.style.textAlign = "left";
                    cell2.style.textAlign = "center";
                    cell3.style.textAlign = "center";
                    cell4.style.textAlign = "center";
                    cell5.style.textAlign = "center";
                    
                }      
                
            }
        }
        
        pesquisa.send();
    }
    selecionarCursos();
    
    function apagarCurso(idCurso){

        //console.log(idCurso)
        var url = 'http://localhost/cursos/'+idCurso+'/delete';
        //console.log(url);
        $("#formApagar").attr('action', url);
    }

    function enviarFormApagar(){

        $("#formApagar").submit();

    }
</script>


@endsection