<style>
    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
        padding: 10px;
    }
</style>

<img style="width:100%;height:auto;" src="https://www.aedah.pt/images/logoAEDAHpaginaCab.jpg">
<br><br><br><br>
Turma: {{$turma}}
<br><br>
Modulo: {{$modulo}} 
<br><br><br><br><br>

<table style="border: 1px solid black;">
    <tr style="border: 1px solid black;">
            <th style="text-align:center;">Nome</th>
            <th style="text-align:center;">Nota Final</th>
    </tr>
@foreach($nomeAlunos as $key=>$nomeAluno)
    <tr style="border: 1px solid black;">
            <td style="text-align:center;">{{$nomeAluno}}</td>
            <td style="text-align:center;">{{$medias[$key]}}</td>
    </tr>
@endforeach
</table>
<br><br>
Data: {{ Carbon::now()->format('m-d-Y') }}


