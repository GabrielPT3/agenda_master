@extends('layout')


@section('titulo')
Painel
@endsection


@section('conteudo')
@if(Auth::user()->tipo_user=="professor")
<center>
<h1>Painel</h1>
<br><br>
<div class="container">
  <div class="row">
    <div class="col">
        


            <select id="curso" onchange="disciplina()" class="form-control">
                <option value="select" hidden disabled selected>Selecione o curso</option>
                @foreach($cursos as $curso)
                <option value="{{$curso->id_curso}}">{{$curso->designacao}}</option>
                @endforeach
            </select>
            <br>
            <select id="disciplina" style="display:none;" onchange="turma()" class="form-control">
                <option value="select" hidden disabled selected>Selecione a disciplina</option>
            </select>
            <br>
              <select id="turma" name="uuidTurma" style="display:none;" onchange="modulo()" class="form-control">
                <option value="select" hidden disabled selected>Selecione a turma</option>
              </select>
              <br>
              <select id="modulo" style="display:none;" onchange="btnturma()" class="form-control">
                <option value="select" hidden disabled selected>Selecione o modulo</option>
              </select>
              <br>
              <input class="btn btn-light" id="btnturma" style="display:none;" type="submit" value="Entrar" onclick="formsubmit()">
        

        
        
    </div>
  </div>
</div>
@else
    <br><br><br>
    <h2><center>Aguarde a sua conta ser confimarda por um administrador para poder ser utilizada!</center></h2>
    <br><br><br>
@endif


</center>


<script>
    var hostName = window.location.hostname;

    var idCurso;
    var uuidDisciplina;
    var idModulo;
    var idTurma;
    var idModulo;

    function disciplina() {
            var selObj = document.getElementById("curso");
            var selValue = selObj.options[selObj.selectedIndex].value;
        
            document.getElementById("turma").selectedIndex = "select";
            document.getElementById("modulo").selectedIndex = "select";
            document.getElementById("btnturma").style.display = "none";
            document.getElementById("turma").style.display = "none";
            document.getElementById("modulo").style.display = "none";
        
            if(selValue!="select"){
                document.getElementById("disciplina").style.display = "block";
            }
            else{
                document.getElementById("disciplina").style.display = "none";
                
                document.getElementById("disciplina").selectedIndex = "select";

            }
        idCurso = event.target.value;
        var idUser = {{Auth::user()->id}};
        //console.log(idCurso);
        //console.log(idUser);
        var url = 'http://'+hostName+'/api/obterdisciplinas/curso/'+idCurso+'/user/'+idUser;
        var disciplinas;
        var pesquisadisciplinas = new XMLHttpRequest();
        pesquisadisciplinas.open('get',url,true);
        
        pesquisadisciplinas.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;

            if($rs==4 && $s==200){
                console.log(this.readyState+ ' '+ this.status);
                disciplinas=JSON.parse(pesquisadisciplinas.responseText);
                disciplinasLength=disciplinas.length;
                //console.log(cursosLength);
                $('#disciplina')
                    .empty()
                    .append('<option selected="selected" value="select" hidden disabled selected>Selecione a disciplina</option>');
                
                for(i=0;i<disciplinasLength;i++){
                    var select = document.getElementById("disciplina");
                    var option = document.createElement("option");
                    option.text = disciplinas[i].designacao;
                    option.value = disciplinas[i].uuid;
                    select.add(option);
                }

                
                 
                
            }
        }
        
        pesquisadisciplinas.send();
    }

    
    
    function turma() {
            var selObj = document.getElementById("disciplina");
            var selValue = selObj.options[selObj.selectedIndex].value;
        
            document.getElementById("btnturma").style.display = "none";
            document.getElementById("modulo").selectedIndex = "select";
            document.getElementById("modulo").style.display = "none";
        
            if(selValue!="select"){
                document.getElementById("turma").style.display = "block";
            }
            else{
                document.getElementById("turma").style.display = "none";
                document.getElementById("turma").selectedIndex = "select";
                
            }
        

        uuidDisciplina = event.target.value;
        //console.log(uuidDisciplina);
        var idUser = {{Auth::user()->id}};
        var turmas;
        //console.log(idCurso);
        //console.log(idUser);
        var url = 'http://'+hostName+'/api/obterturmas/curso/'+idCurso+'/disciplina/'+uuidDisciplina+'/user/'+idUser;
        
        var pesquisaturmas = new XMLHttpRequest();
        pesquisaturmas.open('get',url,true);
        
        pesquisaturmas.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;

            if($rs==4 && $s==200){
                console.log(this.readyState+ ' '+ this.status);
                turmas=JSON.parse(pesquisaturmas.responseText);
                turmasLength=turmas.length;
                //console.log(cursosLength);
                $('#turma')
                    .empty()
                    .append('<option selected="selected" value="select" hidden disabled selected>Selecione a turma</option>');
                
                for(i=0;i<turmasLength;i++){
                    var select = document.getElementById("turma");
                    var option = document.createElement("option");
                    option.text = turmas[i].ano+turmas[i].turma;
                    option.value = turmas[i].uuid;
                    select.add(option);
                }

                //cursos.forEach(element => console.log(element));
                //console.log(cursos[1].nome);
                 
                
            }
        }
        
        pesquisaturmas.send();
            
    }

    function modulo() {
            var selObj = document.getElementById("curso");
            var selValue = selObj.options[selObj.selectedIndex].value;
        

            document.getElementById("btnturma").style.display = "none";
            document.getElementById("modulo").selectedIndex = "select";
            document.getElementById("modulo").style.display = "none";
        
            if(selValue!="select"){
                document.getElementById("modulo").style.display = "block";
            }
            else{
                document.getElementById("modulo").style.display = "none";
                
                document.getElementById("modulo").selectedIndex = "select";

            }
        idTurma = event.target.value;

        var url = 'http://'+hostName+'/api/obtermodulos/disciplina/'+uuidDisciplina+'/turma/'+idTurma;
        var modulos;
        var pesquisamodulos = new XMLHttpRequest();
        pesquisamodulos.open('get',url,true);
        
        pesquisamodulos.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;

            if($rs==4 && $s==200){
                console.log(this.readyState+ ' '+ this.status);
                modulos=JSON.parse(pesquisamodulos.responseText);
                modulosLength=modulos.length;

                $('#modulo')
                    .empty()
                    .append('<option selected="selected" value="select" hidden disabled selected>Selecione o modulo</option>');
                
                for(i=0;i<modulosLength;i++){
                    var select = document.getElementById("modulo");
                    var option = document.createElement("option");
                    option.text = modulos[i].designacao;
                    option.value = modulos[i].uuid;
                    select.add(option);
                }

                 
                
            }
        }
        
        pesquisamodulos.send();
    }
    
    function btnturma(){
            var selObj = document.getElementById("turma");
            var selValue = selObj.options[selObj.selectedIndex].value;
            uuidModulo = event.target.value;

            if(selValue!="select"){
                document.getElementById("btnturma").style.display = "block";
            }
            else{
                document.getElementById("btnturma").style.display = "none";
            }
    }
    
    
    
    function formsubmit(){
        var select = document.getElementById("turma");
        var uuidTurma = select.options[select.selectedIndex].value;
        var selectDisciplina = document.getElementById("disciplina");
        var uuidDisciplina = selectDisciplina.options[selectDisciplina.selectedIndex].value;
        
        //idTurma = turmas[i].id_turma;
        //url = 'http://localhost/registos/'+uuidTurma+'/turma';
        window.location.href = "http://"+hostName+"/registos/avaliar/"+uuidDisciplina+"/turma/"+uuidTurma+'/modulo/'+uuidModulo;
        //window.close();
        //window.location.href("http://localhost/registos/"+idTurma+"/turma");
        //window.open(url);

    }
    
    


</script>
@endsection