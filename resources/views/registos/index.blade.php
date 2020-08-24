@extends('layout')



@section('titulo')
Alunos
@endsection

@section('subtitulo')
    <center><h1>Alunos</h1></center>
@endsection

@section('conteudo')
<p>{{$disciplina}} --> {{$turma}} --> {{$modulo}} --> Licao nº{{$aula}}</p>
<br>
<table class="table table-striped table-dark"> 
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col" style="text-align: center;">Detalhes</th>
            <th scope="col" style="text-align: center;">Avaliar</th>
            <th scope="col" style="text-align: center;">Marcar Falta</th>
        </tr>
    </thead>
    <tbody>
         @foreach($alunos as $aluno)
        <tr>
            <th scope="row">{{$aluno->nome}}</th>
            <th style="text-align: center;"><a href="{{route('registos.show', ['uuid'=>$aluno->uuid,'uuidturma'=>$uuidturma,'uuidmodulo'=>$uuidmodulo,'uuidaula'=>$uuidaula])}}"><i class="fa fa-plus-circle"></i></a></th>
            <td style="text-align: center;">@if(!isset($aluno->faltas[0]->id_falta) || is_null($aluno->faltas[0]->id_falta)) <a href="{{route('registos.avaliacao', ['uuidaula'=>$uuidaula, 'uuidmodulo'=> $uuidmodulo, 'uuidaluno'=>$aluno->uuid])}}"><i class="fa fa-pen-square"></i></a> @else Faltou @endif</td>

            @if(isset($aluno->faltas[0]->id_falta))
            @if(!is_null($aluno->faltas[0]->id_falta))
            <td style="text-align: center;"><a href="javascript:;" data-toggle="modal" data-target="#ModalRemoverFalta"  onclick="RemoverFalta({{$aluno}})"><i class="fas fa-user-alt-slash" style="color:red"></i></a></td>
            
            @endif
            @else
            <td style="text-align: center;"><a href="javascript:;" data-toggle="modal" data-target="#ModalMarcarFalta"  onclick="MarcarFalta({{$aluno}})"><i class="fas fa-user-alt-slash"></i></a></td>
            @endif
            
        </tr>
        @endforeach
        
    </tbody>
</table> 
{{$alunos->render()}}


<div class="modal fade" id="ModalMarcarFalta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" id="formMarcarFalta" method="get">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Marcar Falta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="color: black">
                                {{ csrf_field() }}

                                <center>
                                    <h4>Deseja realmente marcar falta ao aluno?</h4>
                                    <strong style="color:red;">Aviso: Note que caso o aluno tenha avaliacoes dadas na aula serão apagadas.</strong>
                                </center>
                             </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success">Confirmar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>  




            <div class="modal fade" id="ModalRemoverFalta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" id="formRemoverFalta" method="get">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Remover Falta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="color: black">
                                {{ csrf_field() }}

                                <center>
                                    <h4>Deseja realmente remover falta ao aluno?</h4>
                                    <h6>Note que terá de avaliar o aluno.</h6>

                                </center>
                             </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success">Confirmar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>   



<br>
<input class="btn btn-light" id="voltar" type="submit" value="Voltar" onclick="location.href='{{route('registos.avaliar',['uuiddisciplina'=>$uuiddisciplina,'uuidturma'=>$uuidturma,'uuidmodulo'=>$uuidmodulo])}}'">

@endsection

<script>

    var hostName = window.location.hostname;
    function MarcarFalta(aluno){
        
       var uuidaluno = aluno.uuid;
       var uuidaula = '{{$uuidaula}}';
        
        
        var url = 'http://'+hostName+'/registos/falta/aluno/'+uuidaluno+'/aula/'+uuidaula;
        
        $("#formMarcarFalta").attr('action', url);

        
        
    }


    function RemoverFalta(aluno){
        
        var idfalta = aluno.faltas[0].id_falta;     
        console.log(idfalta); 
        
        var url = 'http://'+hostName+'/registos/removerfalta/falta/'+idfalta;
         
         $("#formRemoverFalta").attr('action', url);
 
         
         
     }
</script>