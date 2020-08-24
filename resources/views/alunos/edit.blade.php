@extends('layout')
@section('titulo')
Alunos
@endsection
@section('subtitulo')
    <center><h1>Editar</h1></center>
@endsection

@section('conteudo')
<form method="post" action="{{route('alunos.update',['id'=>$aluno->id_aluno])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <center>
    <table style="color: white; margin-left: 15%">
    <tr><td style="text-align: right;"><label>Nome:</label></td>
    <td><input type="text" name="nome" value="{{$aluno->nome}}" class="form-control formsinputs"><br>
    @if($errors->has('nome'))
        {{$errors->first('nome')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Numero:</label></td>
    <td><input type="text" name="numero" value="{{$aluno->numero}}" class="form-control formsinputs"><br>
    @if($errors->has('numero'))
        {{$errors->first('numero')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Data de nascimento:</label></td>
    <td><input type="date" name="data_nascimento" value="{{$aluno->data_nascimento->format('Y-m-d')}}" class="form-control formsinputs"><br>
    @if($errors->has('data_nascimento'))
        {{$errors->first('data_nascimento')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Ano:</label></td>
    <td><select name="ano" id="ano" onchange="selecionarTurmas(event)" class="form-control formsinputs">
        <option @if($aluno->id_turma != 0) @if($aluno->turma->ano == 10)selected @endif @endif>10</option>
        <option @if($aluno->id_turma != 0) @if($aluno->turma->ano == 11)selected @endif @endif>11</option>
        <option @if($aluno->id_turma != 0) @if($aluno->turma->ano == 12)selected @endif @endif>12</option>
    </select><br>
    @if($errors->has('ano'))
        {{$errors->first('ano')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Turma:</label></td>
    <td><select name="id_turma" id="turma" class="form-control formsinputs" class="form-control formsinputs"></select><br>
    @if($errors->has('turma'))
        {{$errors->first('turma')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Nacionalidade:</label></td>
    <td><input type="text" name="nacionalidade" value="{{$aluno->nacionalidade}}" class="form-control formsinputs"><br>
    @if($errors->has('nacionalidade'))
        {{$errors->first('nacionalidade')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Morada:</label></td>
    <td><input type="text" name="morada" value="{{$aluno->morada}}" class="form-control formsinputs"><br>
    @if($errors->has('morada'))
        {{$errors->first('morada')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Email</label></td>
    <td><input type="text" name="email" value="{{$aluno->email}}" class="form-control formsinputs"><br>
    @if($errors->has('email'))
       {{$errors->first('email')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Fotografia</label></td>
    <td><input type="file" name="fotografia" value="{{$aluno->fotografia}}" onchange="mostrarImg(this);" ><br>
    @if($errors->has('fotografia'))
       {{$errors->first('fotografia')}}<br>
    @endif</td></tr>
    </table>
    @if(isset($aluno->fotografia))
        <img class="imgprofile" id="img" src="{{asset('imagens/alunos/'.$aluno->fotografia)}}"><br>
    @endif
    <br><input type="submit" name="criar" class="btn btn-success" value="Editar">
    </center>
</form>
<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>

<script>
    function selecionarTurmas(event){
        var selObj = document.getElementById("ano");
        var selValue = selObj.options[selObj.selectedIndex].value;
        var ano = selValue;
        //console.log(selValue,ano);
        var hostname = window.location.hostname;
        var url = 'http://'+hostname+'/api/obterturma/'+ano;
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
                    .empty()
                    
                
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

    function mostrarImg(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection