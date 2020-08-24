@extends('layout')


@section('titulo')
Mudar Password
@endsection


@section('conteudo')

<center>
<h1>Mudar Password</h1>
<br><br><br>


<form action="{{route('perfil.storepassword')}}" method="POST">
    @csrf()
    <table style="color:white;">
        <tr>
            <td><label>Password Atual:</label></td>
            <td><input name="atual" type="password" class="form-control" placeholder="Inserir password atual..."></td>
        </tr>
        <tr>
            <td><label>Nova Password:</label></td>
            <td><input name="nova" type="password" class="form-control" placeholder="Inserir nova password..."></td>
        </tr>
        <tr>
            <td><label>Confirmar Nova Password:</label></td>
            <td><input name="confirmarnova" type="password" class="form-control" placeholder="Repetir nova password..."></td>
        </tr>
    </table>
    <br>
    <input type="submit" class="form-control" value="Mudar Password" style="max-width:25%;">
</form>

</center>

@endsection