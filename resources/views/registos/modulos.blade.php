@extends('layout')



@section('titulo')
Avaliações
@endsection

@section('subtitulo')
    <center><h1>Avaliações</h1></center>
@endsection

@section('conteudo')
<center>
<br>    
<div id="app">
            <select id="disciplinas" onchange="modulos(event)" class="form-control">
                <option value="select">Selecione a disciplina</option>
                @foreach($disciplinas as $disciplina)
                <option value="{{$disciplina->id_disciplina}}">{{$disciplina->designacao}}</option>
                @endforeach
            </select> 
            <br>
            <select id="modulos" v-on:change="notasV()" v-model="modulo" class="form-control" style="display:none;">
                <option value="select">Selecione o modulo</option>
            </select> 
            
            <br><br>
            <p id="paragrafoNota"></p>
            
            <br><br>
            <form id="formpdf" action="{{route('registos.pdf')}}" method="POST">
                @csrf()
                <input id="notaCriterios" name="notaCriterioseee[]" type="text" hidden>
                <template >
                <select v-show="mostrar==true" name="notaCriterios[]" multiple="multiple" >
                    <option v-for="criterio in criterios.notaCriterios" selected>@{{criterio}}</option>
                </select>
                </template>
                <input id="media" name="media" type="text" v-model="criterios.mensagem" hidden>
                <input id="nome" name="nome" type="text" v-model="criterios.nome" hidden>
                <input id="modulo" name="modulo" type="text" v-model="criterios.modulo" hidden>
                <input id="turma" name="turma" type="text" v-model="criterios.turma" hidden>
                <input id="tpdf" class="btn btn-light" id="pdf" type="submit" value="Transferir PDF" style="display:none;">
            </form>
            <br>

</center>

<input class="btn btn-light" id="voltar" type="submit" value="Voltar" onclick="location.href='{{route('registos.alunos')}}'">

</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    new Vue({
        el:'#app',
        data () {
            return {
                nome:'Tony',
                criterios: [],
                modulo:'nada',
                mostrar : false
            }
        },
        methods : {
            notasV : function () {

                
                var idModulo = this.modulo;

                if(idModulo!="select"){
                    document.getElementById('tpdf').style.display = "block";
                    document.getElementById('paragrafoNota').style.display = "block";
                
                }
                else{
                    document.getElementById('tpdf').style.display = "none";
                    document.getElementById('paragrafoNota').style.display = "none";
                }

                var idAluno = '{{$idaluno}}';
                var idUser = '{{Auth::user()->id}}';
                var url = 'http://'+hostName+'/api/obternotas/'+idModulo+'/aluno/'+idAluno+'/user/'+idUser;
                var nota;
                var tmpCriterios=this;
                console.log(url);
                var pesquisa = new XMLHttpRequest();
                pesquisa.open('get',url,true);
                
                pesquisa.onreadystatechange = function(){
                    $rs = this.readyState; 
                    $s = this.status;

                    if($rs==4 && $s==200){
                        console.log(this.readyState+ ' '+ this.status);
                        tmpCriterios.criterios=JSON.parse(pesquisa.responseText);
                        criterios = JSON.parse(pesquisa.responseText);
                        document.getElementById('paragrafoNota').innerHTML = criterios.mensagem;
                        document.getElementById('tpdf').style.display = "block";
                        document.getElementById('tpdf').style.display = "block";
                        document.getElementById('paragrafoNota').style.display = "block";
                      
                    
                    }
                }
                
                pesquisa.send();
            
            }
            },

        mounted () {
           // this.notasV();
        }

            
        
       
    });
    </script>
@endsection


<script>
 
    var hostName = window.location.hostname;
    function modulos(event){


        var idDisciplina = event.target.value;

        if(idDisciplina!="select"){
                document.getElementById("modulos").style.display = "block";
                
            }
            else{
                document.getElementById('tpdf').style.display = "none";
                document.getElementById('paragrafoNota').style.display = "none";
                document.getElementById("modulos").style.display = "none";
                document.getElementById("modulos").selectedIndex = "select";
                document.getElementById("tablenotas").style.visibility = "hidden";
            }



        var url = 'http://'+hostName+'/api/obtermodulos/'+idDisciplina;
        var modulos;
        console.log(url);
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;

            if($rs==4 && $s==200){
                console.log(this.readyState+ ' '+ this.status);
                modulos=JSON.parse(pesquisa.responseText);
                modulosLength=modulos.length;
                
                $('#modulos')
                    .empty()
                    .append('<option selected="selected" value="select">Selecione o modulo</option>');
                
                
                for(i=0;i<modulosLength;i++){
                    var select = document.getElementById("modulos");
                    var option = document.createElement("option");
                    option.text = modulos[i].designacao;
                    option.value = modulos[i].id_modulo;
                    select.add(option);   
                }
                 

            }
        }
        
        pesquisa.send();
    }



    function notas(event){
        var idModulo = event.target.value;
        var idAluno = '{{$idaluno}}';
        var idUser = '{{Auth::user()->id}}';
        var url = 'http://'+hostName+'/api/obternotas/'+idModulo+'/aluno/'+idAluno+'/user/'+idUser;
        var nota;
        console.log(url);
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;

            if($rs==4 && $s==200){
                console.log(this.readyState+ ' '+ this.status);
                nota=JSON.parse(pesquisa.responseText);
                document.getElementById('paragrafoNota').innerHTML = nota.mensagem;
                var notaCriterios = nota.notaCriterios;
                var media = nota.mensagem;
                console.log(notaCriterios);
                //document.getElementById('notaCriterios').value = notaCriterios;
                document.getElementById('media').value = media;

                for( i = 0; i < notaCriterios.length; i++ ) {
                    console.log(notaCriterios[i]);
                    //document.getElementsByName('notaCriterios[]').value = notaCriterios[i];
                    
                }
                $("#notaCriterios").val(notaCriterios);
                //var testeee = document.getElementsByName('notaCriterios[]').value;
                
                //console.log(testeee);
            }
        }
        
        pesquisa.send();
    }
</script>

