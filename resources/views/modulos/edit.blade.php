@extends('layout')
@section('titulo')
Modulos
@endsection
@section('subtitulo')
<center><h1>Editar Modulo</h1></center>
@endsection
@section('conteudo')
<center>
<form method="post" action="{{route('modulos.update',['id'=>$modulo->id_modulo])}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <table style="color: white; margin-left: 10%">
    <tr><td style="text-align: right;"><label>Disciplina:</label></td>
    <td><select id="id_disciplina" name="id_disciplina" onchange="obterModulo()" style="width:auto" class="form-control formsinputs"><option hidden disabled selected>Selecione a disciplina</option>
    @foreach($disciplinas as $disciplina)
        <option value="{{$disciplina->id_disciplina}}" @if($disciplina->id_disciplina == $modulo->id_disciplina)selected @endif>{{$disciplina->designacao}}</option>
    @endforeach
    </select></td></tr>
    <tr><td style="text-align: right;"><label>Numero:</label></td>
    <td><input id="numero" type="text" name="numero" value="{{$modulo->numero}}" class="form-control formsinputs"><br>
    @if($errors->has('nome'))
        {{$errors->first('nome')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Designação:</label></td>
    <td><input type="text" name="designacao" value="{{$modulo->designacao}}" class="form-control formsinputs"><br>
    @if($errors->has('designacao'))
        {{$errors->first('designacao')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Numero de aulas:</label></td>
    <td><input type="number" name="num_aulas" value="{{$modulo->num_aulas}}" class="form-control formsinputs" min="1"><br>
    @if($errors->has('num_aulas'))
        {{$errors->first('num_aulas')}}<br>
    @endif</td></tr>
    <tr><td style="text-align: right;"><label>Ano:</label></td>
    <td><select name="ano" id="ano" class="form-control formsinputs">
        <option value="10" @if($modulo->ano == 10)selected @endif>10</option>
        <option value="11" @if($modulo->ano == 11)selected @endif>11</option>
        <option value="12" @if($modulo->ano == 12)selected @endif>12</option>
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
    <br><input type="submit" name="editar" class="btn btn-success" value="Editar">
</form>
</center>
<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>

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
                document.getElementById("numero").value = modulo;
                
            }
        }
        
        pesquisa.send();
    }

    
</script>

@endsection