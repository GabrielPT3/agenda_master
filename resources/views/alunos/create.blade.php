@extends('layout')
@section('titulo')
Alunos
@endsection

@section('subtitulo')
<center><h1>Criar Novo Aluno</h1></center>
@endsection

@section('conteudo')

<form method="post" action="{{route('alunos.store')}}" enctype="multipart/form-data">
    @csrf
    <center>
    <table style="color: white; margin-left: 15%">
    <tr><td style="text-align: right;"><label>Nome*:</label></td>
    <td><input type="text" name="nome" value="{{@old('nome')}}" class="form-control formsinputs" placeholder="Inserir o nome do aluno..."><br>
    @if($errors->has('nome'))
        {{$errors->first('nome')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Data de nascimento*:</label></td>
    <td><input type="date" name="data_nascimento" class="form-control formsinputs" value="{{@old('data_nascimento')}}"><br>
    @if($errors->has('data_nascimento'))
        {{$errors->first('data_nascimento')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Ano*:</label></td>
    <td><select name="ano" id="ano" onchange="selecionarTurmas(event)" class="form-control formsinputs">
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select><br>
    @if($errors->has('ano'))
        {{$errors->first('ano')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Turma*:</label></td>
    <td><select name="id_turma" id="turma" class="form-control formsinputs"></select><br>
    @if($errors->has('turma'))
        {{$errors->first('turma')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Numero*:</label></td>
    <td><input type="number" min="1" name="numero" class="form-control formsinputs" value="{{@old(numero)}}" placeholder="Inserir o número do aluno..."><br>
    @if($errors->has('numero'))
        {{$errors->first('numero')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Nacionalidade*:</label></td>
    <td><input type="text" name="nacionalidade" value="{{@old('nacionalidade')}}" class="form-control formsinputs" placeholder="Inserir a nacionalidade do aluno..."><br>
    @if($errors->has('nacionalidade'))
        {{$errors->first('nacionalidade')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Morada*:</label></td>
    <td><input type="text" name="morada" value="{{@old('morada')}}" class="form-control formsinputs" placeholder="Inserir a morada do aluno..."><br>
    @if($errors->has('morada'))
        {{$errors->first('morada')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Email</label></td>
    <td><input type="email" name="email" value="{{@old('email')}}" class="form-control formsinputs" placeholder="Inserir o email do aluno..."><br>
    @if($errors->has('email'))
       {{$errors->first('email')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Fotografia</label></td>
    <td><input type="file" name="fotografia"><br>
    @if($errors->has('fotografia'))
       {{$errors->first('fotografia')}}<br>
    @endif</td></tr>
    </table>
    (*) Campos obrigatorios<br>
    <br><input type="submit" name="criar" class="btn btn-success" value="Criar">
    </center>
</form>
<button type="button" class="btn btn-light" onclick="location.href='{{route('alunos.index')}}'">Voltar</button>


<script>
    function selecionarTurmas(event){
        var selObj = document.getElementById("ano");
        var selValue = selObj.options[selObj.selectedIndex].value;
        var ano = selValue;
        //console.log(selValue,ano);
        var url = 'http://localhost/api/obterturma/'+ano;
        var turmas;
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;
            

            if($rs==4 && $s==200){

                //console.log(this.readyState+ ' '+ this.status);
                turmas=JSON.parse(pesquisa.responseText);
                turmasLength=turmas.length;
                //console.log(turmasLength);
                $('#turma')
                    .empty();
                    //.append('<option selected="selected" value="select"> </option>');
                
                for(i=0;i<turmasLength;i++){
                    var select = document.getElementById("turma");
                    var option = document.createElement("option");
                    option.text = turmas[i].turma;
                    option.value = turmas[i].id_turma;
                    select.add(option);
                }      
                
            }
        }
        
        pesquisa.send();
    }
    selecionarTurmas();
</script>

@endsection