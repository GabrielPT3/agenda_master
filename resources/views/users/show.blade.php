@extends('layout')
@section('titulo')
Utilizador
@endsection

@section('subtitulo')
    <center><h1>Utilizador</h1></center>
@endsection

@section('conteudo')

<center>    

<div class="card">
<br>
  <center>
    @if(isset($user->fotografia))<img class="imgprofile" src="{{asset('imagens/users/'.$user->fotografia)}}">
    @else<img src="{{asset('img/logo2.png')}}" style="width:75px;height:auto;">@endif
</center>
<br>
<h3 class="black">{{$user->name}}</h3>
<br>
<center><table style="margin-left:10%;">
    <tr>
        <td style="text-align: right;"><p class="title">Email: </p></td>
        <td><p class="title"> {{$user->email}}</p></td>
    </tr>
    <tr>
        <td style="text-align: right;"><p class="title">Tipo: </p></td>
        <td><p class="title"> {{$user->tipo_user}} @if(Auth::user()->tipo_user=="superadmin")<a href="javascript:void(0)" data-toggle="modal" data-target="#ModalAlterarTipo"><i class="fas fa-edit"></i></a>@endif</p></td>
    </tr>
    <tr>
        <td style="text-align: right;"><p class="title">Criado: </p></td>
        <td><p class="title"> {{$user->created_at->format('d/m/Y')}}</p></td>
    </tr>

</table>
@if($user->tipo_user=="professor")
<p class="title">Cursos: <a href="javascript:void(0)" data-toggle="modal" data-target="#ModalCursos"><i class="fas fa-edit"></i></a></p>
@foreach($cursosProf as $curso)
    <p class="title">{{$curso->designacao}} <a href="javascript:void(0)" data-toggle="modal" onclick="FormRemoverCursoUrl({{$user->id}},{{$curso->id_curso}})" data-target="#ModalRemoverCurso"><i class="fas fa-minus-circle"></i></a></p>
@endforeach

<p class="title">Disciplinas: <a href="javascript:void(0)" data-toggle="modal" data-target="#ModalDisciplinas"><i class="fas fa-edit"></i></a></p>
@foreach($disciplinasProf as $disciplina)
    <p class="title">{{$disciplina->designacao}} <a href="javascript:void(0)" data-toggle="modal" onclick="FormRemoverUrl({{$user->id}},{{$disciplina->id_disciplina}})" data-target="#ModalRemoverDisciplina"><i class="fas fa-minus-circle"></i></a></p>
@endforeach
@endif
</center>
<br>
@if(Auth::user()->tipo_user=="superadmin")
<input type="button" class="userbutton btn btn-outline-danger"  value="Eliminar Utilizador" href="javascript:void(0)" data-toggle="modal" data-target="#ModalEliminarUser">
@endif
    
</div>

</center>

<button type="button" class="btn btn-light" onclick="location.href='{{url()->previous()}}'">Voltar</button>

 <div class="modal fade" id="ModalAlterarTipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('users.tipo', ['id'=>$user->id])}}" method="get">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Alterar Tipo de Utilizador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}

            <center><select class="form-control" style="width:300px" name="tipo">
                <option value="admin">Admin</option>
                <option value="professor">Professor</option>
            </select></center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div>

 <div class="modal fade" id="ModalEliminarUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('users.delete', ['id'=>$user->id])}}" method="post">
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
              
            Deseja apagar o utilizador?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div>

 <div class="modal fade" id="ModalDisciplinas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" method="get" id="formDisciplinas">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Adicionar Disciplina</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}

            <center><select class="form-control" style="width:300px" id="disciplinas" onchange="FormDisciplinasUrl({{$user->id}})">
                <option hidden disabled selected>Selecione uma disciplina</option>
                @foreach($disciplinas as $disciplina)
                <option value="{{$disciplina->id_disciplina}}">{{$disciplina->designacao}}</option>
                @endforeach
            </select></center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div>

 <div class="modal fade" id="ModalRemoverDisciplina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" method="post" id="formRemover">
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
              
            Deseja remover a disciplina?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div>



<div class="modal fade" id="ModalCursos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" method="get" id="formCursos">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: black">Adicionar Curso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="color: black">
            {{ csrf_field() }}

            <center><select class="form-control" style="width:300px" id="cursos" onchange="FormCursosUrl({{$user->id}})">
                <option hidden disabled selected>Selecione um Curso</option>
                @foreach($cursos as $curso)
                <option value="{{$curso->id_curso}}">{{$curso->designacao}}</option>
                @endforeach
            </select></center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div>


<div class="modal fade" id="ModalRemoverCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" method="post" id="formRemoverCurso">
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
              
            Deseja remover o Curso?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-outline-success">Confirmar</button>
          </div>
        </div>
    </form>
  </div>
</div>

<script>
    function FormDisciplinasUrl(idUser){
        var hostname = window.location.hostname;
        var select = document.getElementById("disciplinas");
        var idDisciplina = select.options[select.selectedIndex].value;
        var url = 'http://'+hostname+'/users/'+idUser+'/show/'+idDisciplina+'/adicionardisciplina';
        
        $("#formDisciplinas").attr('action', url);
    }
    
    function FormRemoverUrl(idUser, idDisciplina){
        var hostname = window.location.hostname;
        
        var url = 'http://'+hostname+'/users/'+idUser+'/show/'+idDisciplina+'/removerdisciplina';
        console.log(url);
        $("#formRemover").attr('action', url);
    }


    function FormCursosUrl(idUser){
        var hostname = window.location.hostname;
        var select = document.getElementById("cursos");
        var idCurso = select.options[select.selectedIndex].value;
        var url = 'http://'+hostname+'/users/'+idUser+'/show/'+idCurso+'/adicionarcurso';
        
        $("#formCursos").attr('action', url);
    }

    function FormRemoverCursoUrl(idUser, idCurso){
        var hostname = window.location.hostname;
        
        var url = 'http://'+hostname+'/users/'+idUser+'/show/'+idCurso+'/removercurso';
        console.log(url);
        $("#formRemoverCurso").attr('action', url);
    }
</script>

@endsection