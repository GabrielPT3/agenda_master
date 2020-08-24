@extends('layout')
@section('titulo')
Modulos
@endsection
@section('subtitulo')
<center><h1>Criar Novo Modulo</h1></center>
@endsection
@section('conteudo')
<center>
<form method="post" action="{{route('modulos.store')}}" enctype="multipart/form-data">
    @csrf
    <table style="color: white; margin-left: 10%">
    <tr><td style="text-align: right;"><label>Disciplina:</label></td>
    <td><select id="id_disciplina" name="id_disciplina" onchange="obterModulo()" style="width:auto" class="form-control formsinputs"><option hidden disabled selected>Selecione a disciplina</option>
    @foreach($disciplinas as $disciplina)
        <option value="{{$disciplina->id_disciplina}}">{{$disciplina->designacao}}</option>
    @endforeach
    </select></td></tr>
    </table>
    <table style="color: white; margin-left: 10%; visibility:hidden" id="tabela">
    <tr><td style="text-align: right;"><label>Numero:</label></td>
    <td><input id="numero" type="text" name="numero" value="" class="form-control formsinputs"><br>
    @if($errors->has('nome'))
        {{$errors->first('nome')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Designação*:</label></td>
    <td><input type="text" name="designacao" value="{{@old('designacao')}}" class="form-control formsinputs" placeholder="Insira a designação do módulo..."><br>
    @if($errors->has('designacao'))
        {{$errors->first('designacao')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Numero de aulas*:</label></td>
    <td><input type="number" name="num_aulas" value="{{@old('num_aulas')}}" class="form-control formsinputs" placeholder="Insira o número de aulas do módulo..." min="1"><br>
    @if($errors->has('num_aulas'))
        {{$errors->first('num_aulas')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Ano*:</label></td>
    <td><select name="ano" id="ano" class="form-control formsinputs">
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select><br>
    @if($errors->has('ano'))
        {{$errors->first('ano')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Ficha Informativa:</label></td>
    <td><input type="file" name="ficha_informativa" value="{{@old('ficha_informativa')}}"><br>
    @if($errors->has('ficha_informativa'))
        {{$errors->first('ficha_informativa')}}<br>
        @endif</td></tr>
    </table>
    <div id="div" style="visibility: hidden;">(*) Campos obrigatorios<br>
    <br><input type="submit" name="criar" class="btn btn-success" value="Criar"></div>
</form>
</center>
<button type="button" class="btn btn-light" onclick="location.href='{{route('modulos.index')}}'">Voltar</button>

<script>
    function obterModulo(){
        var selObj = document.getElementById("id_disciplina");
        var selValue = selObj.options[selObj.selectedIndex].value;
        var disciplina = selValue;
        var hostname = window.location.hostname;
        var url = 'http://'+hostname+'/api/ultimomodulo/'+disciplina;
        var modulo;
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;
            if($rs==4 && $s==200){
                //console.log(this.readyState+ ' '+ this.status);
                modulo=JSON.parse(pesquisa.responseText);
                
                document.getElementById("tabela").style.visibility = "visible";
                document.getElementById("numero").value = modulo;
                document.getElementById("numero").readOnly = true;
                document.getElementById("div").style.visibility = "visible";
                
            }
        }
        
        pesquisa.send();
    }

    
</script>

@endsection