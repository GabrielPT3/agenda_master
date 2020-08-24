@extends('layout')



@section('titulo')
Criterios
@endsection

@section('subtitulo')
    <center><h1>Criterios</h1></center>
@endsection

@section('conteudo')
<center>
<br>

            <select id="disciplina" onchange="criterios(event)" class="form-control">
                <option value="select" selected hidden disabled>Selecione a disciplina</option>
                @foreach($disciplinas as $disciplina)
                <option value="{{$disciplina->uuid}}">{{$disciplina->designacao}}</option>
                @endforeach
            </select>
            <br>
</center>
            <input class="btn btn-light" id="adicionarCriterio" type="submit" value="Adicionar Criterio" href="javascript:;" data-toggle="modal" onclick="adicionarCriterio()" data-target="#ModalAdicionarCriterio"  style="display:none;">
<center>
            <form method="post" action="{{route('registoscriterios.editar')}}">
            @csrf()
            <table id="tablecriterios" class="table table-striped table-dark" style="width:100%;visibility:hidden"width="100%"> 
 
                    <tr>
                        <th scope="col" style="text-align: center;width:20%;" width="10%">Criterio</th>
                        <th scope="col" style="text-align: center;width:40%;" width="40%">Percentagem</th>
                        <th scope="col" style="text-align: center;width:10%;" width="10%">Eliminar</th>
                    </tr>
                    
            </table>
            <br><br>

            <input class="btn btn-light" id="editar" type="submit" value="Editar" onclick="" style="display:none;">

            </form>

            <div class="modal fade" id="ModalApagarCriterio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <h4>Deseja realmente apagar o Critério?</h4>
                            <br>
                            <strong style="color:red;">Aviso: As avaliações dos alunos serão afetadas. A percentagem do critério eliminado será acrescentado ao Critério "Teste".</strong>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success" onclick="enviarFormApagar()">Confirmar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div> 




            <div class="modal fade" id="ModalAdicionarCriterio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{route('registoscriterios.adicionar')}}" id="formAdicionar" method="post">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Adicionar Criterio</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="color: black">
                            {{ csrf_field() }}
                            <label>Designacao:</label><br>
                            <input name="designacao" type="text" style="resize: vertical;border-radius: 4px;border: 1px solid #ccc;padding:5px;" placeholder="Insira a designação...">
                            <input id="disciplinainput" name="disciplina" type="text" style="display:none;">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success" onclick="">Confirmar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div> 


</center>

@endsection

<script>
    function criterios(event){
        var uuidDisciplina = event.target.value;
        var idUser = '{{Auth::user()->id}}';

        document.getElementById('disciplinainput').value = uuidDisciplina;

        var table = document.getElementById("tablecriterios");

        while(table.rows.length > 1) {
            table.deleteRow(1);
        }


        if(uuidDisciplina!="select"){
                document.getElementById("tablecriterios").style.visibility = "visible";
                document.getElementById("editar").style.display = "block";
                document.getElementById("adicionarCriterio").style.display = "block";
            }
            else{
                document.getElementById("tablecriterios").style.visibility = "hidden";
                document.getElementById("editar").style.display = "none";
                document.getElementById("adicionarCriterio").style.display = "none";
            }



        var url = 'http://'+hostName+'/api/obtercriterios/'+uuidDisciplina+'/user/'+idUser;
        var criterios;
        console.log(url);
        var pesquisa = new XMLHttpRequest();
        pesquisa.open('get',url,true);
        
        pesquisa.onreadystatechange = function(){
            $rs = this.readyState; 
            $s = this.status;

            if($rs==4 && $s==200){
                console.log(this.readyState+ ' '+ this.status);
                criterios=JSON.parse(pesquisa.responseText);
                criteriosLength=criterios.length;
                

                for(i=0;i<criteriosLength;i++){
                    var row = table.insertRow(1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);

                    cell1.innerHTML = criterios[i].designacao;
                    var percentagem = criterios[i].percentagem;
                    console.log(percentagem);
                    cell2.innerHTML = '<input name="percentagem[]" type="number" min="1" max="100" style="resize: vertical;border-radius: 4px;border: 1px solid #ccc;padding:5px;" value="'+percentagem+'">'+'<input name="idcriterio[]" type="number" min="1" max="100" style="display:none;" value="'+criterios[i].id_criterio+'">';
                    
                    if(criterios[i].designacao!="Teste"){
                        cell3.innerHTML = '<a href="javascript:;" data-toggle="modal" onclick="apagarCriterio('+criterios[i].id_criterio+')" data-target="#ModalApagarCriterio" ><i class="fas fa-minus-circle" color="red"></i></a>';
                    }
                    

                    cell1.style.textAlign = "center";
                    cell2.style.textAlign = "center";
                    cell3.style.textAlign = "center";
                    
                }
                 

            }
        }
        
        pesquisa.send();
    }

    function apagarCriterio(idCriterio){

        //console.log(idTurma)
        var url = 'http://localhost/registos/criterios/'+idCriterio+'/delete';
        
        $("#formApagar").attr('action', url);
        }

    function enviarFormApagar(){

        $("#formApagar").submit();

    }
</script>