@extends('layout')



@section('titulo')
Alunos
@endsection

@section('subtitulo')
    <center><h1>Alunos</h1></center>
@endsection

@section('conteudo')
<center>
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
              <select id="modulo" style="display:none;" onchange="alunos(event)" class="form-control">
                <option value="select" hidden disabled selected>Selecione o modulo</option>
              </select>
              
            <br><br>

            <form id="formpdf" action="{{route('registos.pdf')}}" method="POST">
            @csrf()
                <select id="notaCriterios" name="notaCriterios[]" multiple="multiple" hidden>
                    
                </select>

                <input id="media" name="media" type="text" hidden>
                <input id="nome" name="nome" type="text" hidden>
                <input id="moduloform" name="modulo" type="text" hidden>
                <input id="turmaform" name="turma" type="text" hidden>
            </form>

            <table id="tablealunos" class="table table-striped table-dark" style="visibility:hidden;width:100%;"width="100%"> 
 
                    <tr>
                        <th scope="col" style="text-align: center;width:20%;" width="40%">Fotografia</th>
                        <th scope="col" style="text-align: center;width:40%;" width="10%">Nome</th>
                        <th scope="col" style="text-align: center;width:20%;" width="40%">Numero</th>
                        <th scope="col" style="text-align: center;width:20%;" width="10%">Avaliações</th>                                                                                                                                                                                                                                                                              
                    </tr>
                
            </table> 
            
            <br><br><br>
            <form action="{{route('registos.pdf.turma')}}" method="POST">
            @csrf()
                <input id="idturma" name="idturma" type="text" hidden>
                <input id="idmodulo" name="idmodulo" type="text" hidden>
                <input href="tpdfturma()" id="tpdf" class="btn btn-light" id="pdf" type="submit" value="Transferir PDF" style="display:none;">
            </form>

</center>



@endsection
<script>
    
    var hostName = window.location.hostname;

    var idCurso;
    var uuidDisciplina;
    var idModulo;
    var idTurma;
    var idModulo;
    var notaCriterios;
    var media;
    var nome;
    var turma;
    var modulo;

    function disciplina() {
            var selObj = document.getElementById("curso");
            var selValue = selObj.options[selObj.selectedIndex].value;
        
            document.getElementById("turma").selectedIndex = "select";
            document.getElementById("modulo").selectedIndex = "select";
            
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

                //cursos.forEach(element => console.log(element));
                //console.log(cursos[1].nome);
                 
                
            }
        }
        
        pesquisadisciplinas.send();
    }

    
    
    function turma() {
            var selObj = document.getElementById("disciplina");
            var selValue = selObj.options[selObj.selectedIndex].value;
        
          
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

                document.getElementById("idturma").value = idTurma;
                 
                
            }
        }
        
        pesquisamodulos.send();
    }


    
    function alunos(event){
        
        idModulo = event.target.value;

        //document.getElementById('tpdf').onclick = "location.href='http://'+hostName+'/registos/transferir/pdf/turma/'+idTurma";

        var table = document.getElementById("tablealunos");

        while(table.rows.length > 1) {
            table.deleteRow(1);
        }

        

        if(idTurma!="select"){
                document.getElementById("tablealunos").style.visibility = "visible";
                document.getElementById("tpdf").style.display = "block";
            }
            else{
                document.getElementById("tablealunos").style.visibility = "hidden";
                document.getElementById("tpdf").style.display = "none";
            }

        

        var url = 'http://'+hostName+'/api/obteralunos/'+idTurma;
        
        var alunos;
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);


        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;

            if($rs==4 && $s==200){
                console.log(this.readyState+ ' '+ this.status);
                alunos=JSON.parse(pesquisa.responseText);
                alunosLength=alunos.length;
                
                
                
                for(i=0;i<alunosLength;i++){
                    var row = table.insertRow(1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var fotografia = alunos[i].fotografia;
                    var src = 'http://'+hostName+'/imagens/alunos/'+fotografia;
                    // var src = '{{asset("img/alunos/'+fotografia+'")}}';
                    cell1.innerHTML = '<img src="'+src+'" style="width:75px;height:auto;">';
                    cell2.innerHTML = alunos[i].nome;
                    cell3.innerHTML = alunos[i].numero;
                    var uuidAluno = alunos[i].uuid;
                    idAluno = alunos[i].id_aluno;
                    var url = 'http://'+hostName+'/registos/aluno/'+uuidAluno+'/modulos';
                    cell4.innerHTML = '<a onclick="notas('+idAluno+')" style="cursor:pointer;"><i class="fas fa-file-pdf"></i></a>';

                    

                    //var route = 'route("registos.aluno.modulos", ["uuidaluno"=>":uuid"])';
                    //route = route.replace(':uuid',uuidAluno);
                    //console.log(route);

                    //cell4.innerHTML = '<a href="{{'+route+'}}" ><i class="far fa-eye"></i></a>';
                    
                    
                   // var urlShow = 'teste';
                    //var urlUpdate = 'teste';

                    //cell3.innerHTML = '<a href="'+urlUpdate+'"><i class="fa fa-pen-square"></i><a/>';
                    //cell4.innerHTML = '<a href="'+urlShow+'"><i class="fa fa-pen-square"></i><a/>';

                    cell1.style.textAlign = "center";
                    cell2.style.textAlign = "center";
                    cell3.style.textAlign = "center";
                    cell4.style.textAlign = "center";

                    document.getElementById("idmodulo").value = idModulo;
                    
                }
                 

            }
        }
        
        pesquisa.send();

}

function notas(idAluno){
        
        var idUser = '{{Auth::user()->id}}';
        var url = 'http://'+hostName+'/api/obternotas/'+idModulo+'/aluno/'+idAluno+'/user/'+idUser;
        var nota;
        //console.log(idAluno);
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;

            if($rs==4 && $s==200){
                console.log(this.readyState+ ' '+ this.status);
                nota=JSON.parse(pesquisa.responseText);
                
                notaCriterios = nota.notaCriterios;
                media = nota.mensagem;
                nome = nota.nome;
                turma = nota.turma;
                modulo = nota.modulo;

                //console.log(notaCriterios);

                if(notaCriterios!=null){
                    $('#notaCriterios')
                    .empty();
                    for(i=0;i<notaCriterios.length;i++){
                    // var select = document.getElementById("notaCriterios");
                    // var option = document.createElement("option");
                    // option.text = notaCriterios[i];
                    // option.value = notaCriterios[i];
                    // select.add(option);
                    $('#notaCriterios')
                    .append('<option selected="selected" value="'+notaCriterios[i]+'" selected>'+notaCriterios[i]+'</option>');
                    }
                    //console.log(media,nome,turma,modulo);
                    document.getElementById("media").value = media;
                    document.getElementById("nome").value = nome;
                    document.getElementById("turmaform").value = turma;
                    document.getElementById("moduloform").value = modulo;
                    //console.log(document.getElementById('turma').value);

                    //console.log(notaCriterios);
                    //document.getElementById('notaCriterios').value = notaCriterios;
                    tranferirPdf();
                }
                else{
                    //console.log('nao tem avaliacoes');
                    document.getElementById('notificationbody').innerHTML = 'O aluno não tem avaliações.';
                    
                    $('#notification').toast('show');
                }
                

            }
        }
        
        pesquisa.send();
    }


    function tranferirPdf(){
        document.getElementById("formpdf").submit();
    }

    function tpdfturma(){
        console.log('teste');
    }
</script>
