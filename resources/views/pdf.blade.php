<img style="width:100%;height:auto;" src="https://www.aedah.pt/images/logoAEDAHpaginaCab.jpg">
<br><br><br><br>

Nome do Aluno: {{$nome}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Turma: {{$turma}}
<br><br>
Modulo: {{$modulo}} 

<br><br><br><br>
<center><h2>Média dos critérios</h2></center>
<br>
@foreach($notaCriterios as $nota)
    <p>{{$nota}}</p>
    <br>
@endforeach

<br><br><br>
<center><h2>Média Final</h2></center>
<br>
{{$media}}

