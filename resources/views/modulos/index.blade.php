@extends('layout')
@section('titulo')
Modulos
@endsection

@section('subtitulo')
    <center><h1>Modulos</h1></center>
@endsection

@section('conteudo')
<center><select id="disciplina" onchange="obterModulos()" class="form-control" style="width:350px">
    @foreach($disciplinas as $disciplina)
        <option value="{{$disciplina->id_disciplina}}">{{$disciplina->designacao}}</option>
    @endforeach
</select></center>
<button type="button" class="btn btn-light" onclick="location.href='{{route('modulos.create')}}'">Criar Nova</button>
<table class="table table-striped table-dark" id="tabela"> 
    <thead>
        <tr>
            <th scope="col">Numero</th>
            <th scope="col" style="text-align: center;">Nome</th>
            <th scope="col" style="text-align: center;">Detalhes</th>
            <th scope="col" style="text-align: center;">Editar</th>
            <th scope="col" style="text-align: center;">Apagar</th>
        </tr>
    </thead>
</table> 

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous" id="anterior">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <div id="paginas">
        
    </div>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next" id="seguinte">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

<button type="button" class="btn btn-light" onclick="location.href='{{route('index')}}'">Voltar</button>

<div class="modal fade" id="ModalApagarModulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              
            Deseja apagar o modulo?
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
    function obterModulos(){
        var table = document.getElementById("tabela");
        while(table.rows.length > 1) {
            table.deleteRow(1);
        }
        var selObj = document.getElementById("disciplina");
        var selValue = selObj.options[selObj.selectedIndex].value;
        var disciplina = selValue;
        var hostname = window.location.hostname;
        const urlParams  = new URLSearchParams(window.location.search);
        const page = urlParams.get('page');
        if(page == null){
            const page = "1";
        }
        var url = 'http://'+hostname+'/api/modulospordisciplina/'+disciplina+'?page='+page;
        var modulos;
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;
            

            if($rs==4 && $s==200){

                //console.log(this.readyState+ ' '+ this.status);
                modulos=JSON.parse(pesquisa.responseText);
                modulosLength=modulos.data.length;
                paginate(modulos);
                for(i=0;i<modulosLength;i++){
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    cell1.innerHTML = "Mod. "+modulos.data[i].numero;
                    cell2.innerHTML = modulos.data[i].designacao;
                    

                    var idModulo = modulos.data[i].id_modulo;
                    var urlShow = 'http://'+hostname+'/modulos/'+idModulo+'/show';
                    var urlUpdate = 'http://'+hostname+'/modulos/'+idModulo+'/edit';

                    cell3.innerHTML = '<a href="'+urlShow+'"><i class="fa fa-plus-circle"></i><a/>';
                    cell4.innerHTML = '<a href="'+urlUpdate+'"><i class="fa fa-pen-square"></i><a/>';
                    cell5.innerHTML = '<a href="javascript:;" data-toggle="modal" onclick="apagarModulo('+modulos.data[i].id_modulo+')" data-target="#ModalApagarModulo" ><i class="fa fa-minus-circle"></i><a/>';

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
    obterModulos();
    
    

    function apagarModulo(idModulo){

        var url = 'http://localhost/modulos/'+idModulo+'/delete';
        //console.log(url)
        $("#formApagar").attr('action', url);
    }

    function enviarFormApagar(){

        $("#formApagar").submit();

    }
    
</script>

@endsection