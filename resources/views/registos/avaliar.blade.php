@extends('layout')



@section('titulo')
Aulas
@endsection

@section('subtitulo')
    <center><h1>Aulas</h1></center>
@endsection

@section('conteudo')
            <p>{{$disciplina}} --> {{$turma}} --> {{$modulo->designacao}}</p>
            <br>


            
            @if($numAulasAtual<$modulo->num_aulas)<button type="button" class="btn btn-light" href="javascript:;" data-toggle="modal" data-target="#ModalAdicionarAula">Adicionar Aula</button>@endif

            <div class="modal fade" id="ModalAdicionarAula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{route('registosaula.store',['uuiddisciplina'=>$uuidDisciplina,'uuidmodulo'=>$uuidModulo,'uuidturma'=>$uuidTurma])}}" id="formAdicionar" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Adicionar Aula</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="color: black">
                                {{ csrf_field() }}

                                <center>
                                    <label>Lição:</label>
                                    <input value="{{$numAulaSeguinte}}" style="resize: vertical;border-radius: 4px;border: 1px solid #ccc;padding:5px;" disabled><br>
                                    <input type="number" name="licao" value="{{$numAulaSeguinte}}" hidden>
                                    <label>Observacoes:</label>
                                    <input type="text" name="observacoes" style="resize: vertical;border-radius: 4px;border: 1px solid #ccc;padding:5px;" placeholder="Insira a observação..."><br>

                                </center>
                             </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success" >Confirmar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div> 

            <table id="tableaula" class="table table-striped table-dark" style="width:100%;"width="100%"> 
 
                    <tr>
                        <th scope="col" style="text-align: center;width:20%;" width="10%">Lição</th>
                        <th scope="col" style="text-align: center;width:40%;" width="50%">Observações</th>
                        <th scope="col" style="text-align: center;width:20%;" width="20%">Editar</th>                                                                                                                                                                                                                                                                            
                        <th scope="col" style="text-align: center;width:20%;" width="20%">Avaliar</th>
                    </tr>
                    @foreach ($aulas as $aula) 
                    <tr>
                        <td scope="col" style="text-align: center;width:20%;" width="10%">{{$aula->licao}}</td>
                        <td scope="col" style="text-align: center;width:20%;" width="10%">{{$aula->observacoes}}</td>
                        <td scope="col" style="text-align: center;width:20%;" width="10%"><a href="javascript:;" data-toggle="modal" data-target="#ModalEditarAula" onclick="EditarAula({{$aula}})"><i class="fa fa-pen-square"></a></td>
                        <td scope="col" style="text-align: center;width:20%;" width="10%"><a href="{{route('registos.index',['uuidturma'=>$uuidTurma,'uuidmodulo'=>$uuidModulo,'uuidaula'=>$aula->uuid])}}"><i class="fa fa-pen-square"></a></td>
                    </tr>
                    @endforeach
                
            </table>

            <div class="modal fade" id="ModalEditarAula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" id="formEditar" method="post">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Editar Aula</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="color: black">
                                {{ csrf_field() }}

                                <center>
                                    <label>Lição:</label>
                                    <input id="LicaoEdit" value="" style="resize: vertical;border-radius: 4px;border: 1px solid #ccc;padding:5px;" disabled><br>
                                    <input id="LicaoEdit2" type="number" name="licao" value="" hidden>
                                    <label>Observacoes:</label>
                                    <input id="ObservacoesEdit" type="text" name="observacoes" value="" style="resize: vertical;border-radius: 4px;border: 1px solid #ccc;padding:5px;"><br>

                                </center>
                             </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success" >Confirmar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>   

            <br>
            <input class="btn btn-light" id="voltar" type="submit" value="Voltar" onclick="location.href='{{route('index')}}'">

            


@endsection

<script>

    var hostName = window.location.hostname;
    function EditarAula(aula){
        
        var uuidAula = aula.uuid;
        var licao = aula.licao;
        var observacoes = aula.observacoes
        
        var url = 'http://'+hostName+'/registos/update/aula/'+uuidAula;
        
        $("#formEditar").attr('action', url);

        document.getElementById('LicaoEdit').value = licao;
        document.getElementById('LicaoEdit2').value = licao;
        document.getElementById('ObservacoesEdit').value = observacoes;
        
        
    }
</script>


