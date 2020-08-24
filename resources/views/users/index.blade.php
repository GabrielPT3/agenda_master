@extends('layout')
@section('titulo')
Utilizadores
@endsection

@section('subtitulo')
    <center><h1>Utilizadores</h1></center>
@endsection

@section('conteudo')
<center>
    <button type="button" class="btn btn-success" onclick="usersAprovados()">Aprovados</button>
    <button type="button" class="btn btn-success" onclick="usersPendentes()">Pendentes</button>
</center><br>
<table class="table table-striped table-dark" id="tabela" style="width: 100%;"> 
    <thead>
        <tr id="row">
            <th scope="col">Nome</th>
            <th scope="col" style="text-align: center;">Email</th>
            <th scope="col" style="text-align: center;">Tipo</th>
            <th scope="col" style="text-align: center;" id="detalhes">Detalhes</th>
            <th scope="col" style="text-align: center;" id="aprovar">Aprovar</th>
            <th scope="col" style="text-align: center;" id="recusar">Recusar</th>
        </tr>
    </thead>
</table>

<h2 style="display: none;" id="mensagem"><center>Não existem utilizadores a aguardar aprovação</center></h2>

<nav aria-label="Page navigation example" id="paginate">
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


<br><button type="button" class="btn btn-light" onclick="location.href='{{route('index')}}'">Voltar</button>

<script>
    function usersAprovados(){
        document.getElementById("mensagem").style.display = "none";
        document.getElementById("paginate").style.display = "block";
        var table = document.getElementById("tabela");
        table.style.display = "table";
        while(table.rows.length > 1) {
            table.deleteRow(1);
        }
        document.getElementById("aprovar").style.display = "none";
        document.getElementById("recusar").style.display = "none";
        var hostname = window.location.hostname;
        
        const urlParams  = new URLSearchParams(window.location.search);
        const page = urlParams.get('page');
        if(page == null){
            const page = "1";
        }
        var url = 'http://'+hostname+'/api/usersaprovados?page='+page;
        var users;
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;
            

            if($rs==4 && $s==200){

                //console.log(this.readyState+ ' '+ this.status);
                users=JSON.parse(pesquisa.responseText);
                usersLength=users.data.length;
                document.getElementById("detalhes").style.display = "table-cell";
                paginate(users);
                for(i=0;i<usersLength;i++){
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    
                    cell1.innerHTML = users.data[i].name;
                    cell2.innerHTML = users.data[i].email;
                    cell3.innerHTML = users.data[i].tipo_user;
                    
                    var idUser = users.data[i].id;
                    var urlShow = 'http://'+hostname+'/users/'+idUser+'/show';
                    

                    cell4.innerHTML = '<a href="'+urlShow+'"><i class="fas fa-plus-circle"></i></a>';     
                    
                    cell1.style.textAlign = "left";
                    cell2.style.textAlign = "center";
                    cell3.style.textAlign = "center";
                    cell4.style.textAlign = "center";
                    
                }      
                
            }
        }
        
        pesquisa.send();
    }
    usersAprovados();

    function usersPendentes(){
        var table = document.getElementById("tabela");
        while(table.rows.length > 1) {
            table.deleteRow(1);
        }
        document.getElementById("detalhes").style.display = "none";
        document.getElementById("paginate").style.display = "none";
        var hostname = window.location.hostname;
        var url = 'http://'+hostname+'/api/userspendentes';
        var users;
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;
            

            if($rs==4 && $s==200){

                //console.log(this.readyState+ ' '+ this.status);
                users=JSON.parse(pesquisa.responseText);
                usersLength=users.length;
                if (usersLength > 0) {
                    document.getElementById("aprovar").style.display = "table-cell";
                    document.getElementById("recusar").style.display = "table-cell";

                    for(i=0;i<usersLength;i++){
                        var row = table.insertRow(-1);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        cell1.innerHTML = users[i].name;
                        cell2.innerHTML = users[i].email;
                        cell3.innerHTML = users[i].tipo_user;
                        
                        var idUser = users[i].id;
                        
                        cell4.innerHTML = '<a href="javascript:;" onclick="aprovarUser('+idUser+')"><i class="fas fa-check-circle"></i></a>';
                        cell5.innerHTML = '<a href="javascript:;" onclick="recusarUser('+idUser+')"><i class="fas fa-times-circle"></i></a>';
                        
                        cell1.style.textAlign = "left";
                        cell2.style.textAlign = "center";
                        cell3.style.textAlign = "center";
                        cell4.style.textAlign = "center";
                        cell5.style.textAlign = "center";
                        
                    }      
                }
                else{
                    table.style.display = "none"
                    document.getElementById("mensagem").style.display = "block";
                }
            }
        }
        
        pesquisa.send();
    }

    function aprovarUser(idUser){
        var hostname = window.location.hostname;
        var url = 'http://'+hostname+'/api/users/'+idUser+'/aprovar';
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;
            

            if($rs==4 && $s==200){  
                usersPendentes();
            }
        }
        
        pesquisa.send();
    }
    
    function recusarUser(idUser){
        var hostname = window.location.hostname;
        var url = 'http://'+hostname+'/api/users/'+idUser+'/recusar';
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;
            

            if($rs==4 && $s==200){  
                usersPendentes();
            }
        }
        
        pesquisa.send();
    }
    
</script>


@endsection