@extends('layout')



@section('titulo')
Alunos
@endsection

@section('subtitulo')
    <center><h1>Avaliar Aluno</h1></center>
@endsection

@section('conteudo')
    <p>Aluno: {{$aluno}}      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Turma: {{$ano}}{{$turma}}</p>
    <p>Modulo: {{$modulo}}    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Licao: {{$licao}}</p>
    <br>
    <center>
        <input class="btn btn-light" id="adicionarteste" name="adicionarteste" onclick="teste()" type="submit" value="Adicionar Teste" style="display:block;float:right;">
        <input class="btn btn-light" id="removerteste" name="removerteste" onclick="removerteste()" type="submit" value="Remover Teste" style="display:none;float:right;">
        <form method="post" action="{{route('registos.avaliacaoaula')}}">
            @csrf()
            <table id="tableaula" class="table table-striped table-dark"> 
                <tr>
                    <td scope="col">Designação</td>
                    <td scope="col" style="text-align: center;">Valor (0-20)</td>
                </tr>

                @foreach($criterios as $criterio)

                @if($criterio->designacao!='Teste')
                <tr>
                
                    <td scope="col">{{$criterio->designacao}}</td>
                    <td scope="col" style="text-align: center;"><input name="nota[]" type="number" min="0" max="20" style="resize: vertical;border-radius: 4px;border: 1px solid #ccc;padding:5px;" @if(isset($criterio->avaliacoes[0]->id_avaliacao)) value="{{$criterio->avaliacoes[0]->nota}}" @endif></td>

                </tr>
                @endif
                    <input value="{{$criterio->id_criterio}}" name="id_criterio[]" style="display:none;">
                    <input value="{{$idAula}}" name="id_aula" style="display:none;">
                    <input value="{{$idModulo}}" name="id_modulo" style="display:none;">
                    <input value="{{$idAluno}}" name="id_aluno" style="display:none;">
                   

                @endforeach
            </table> 
            <br>
            <input class="btn btn-light" type="submit" value="Avaliar">
        </form>
    </center>
    <br>
    <input class="btn btn-light" id="voltar" type="submit" value="Voltar" onclick="location.href='{{route('registos.index',['uuidturma'=>$uuidTurma,'uuidmodulo'=>$uuidModulo,'uuidaula'=>$uuidAula])}}'">
@endsection


<script>
    function teste(){
                    var table = document.getElementById("tableaula");
                    var row = table.insertRow(-1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);

                    cell1.innerHTML ='Teste';
                    cell2.innerHTML = '<input name="nota[]" type="number" min="0" max="20" style="resize: vertical;border-radius: 4px;border: 1px solid #ccc;padding:5px;" @if(isset($criterio->avaliacoes[0]->id_avaliacao)) value="{{$criterio->avaliacoes[0]->nota}}" @endif>';
                    

                    


                    cell2.style.textAlign = "center";

                    document.getElementById("adicionarteste").style.display = "none";
                    document.getElementById("removerteste").style.display = "block";
    }   
    function removerteste(){
                    var table = document.getElementById("tableaula");

                    document.getElementById("adicionarteste").style.display = "block";
                    document.getElementById("removerteste").style.display = "none";
                    table.deleteRow(-1);

    }                      
</script>