<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Disciplina;
use App\Turma;
use Illuminate\Support\Facades\Storage;
use Auth;
use Gate;
use Str;
use App\Modulo;
use App\Aula;
use App\Criterio;
use App\Avaliacao;
use App\AnosLetivos;
use App\Curso;
use App\Falta;
use PDF;
use Carbon;


class AlunosController extends Controller
{
    public function transferirPdfTurma(Request $request){
        $uuidTurma = $request->idturma;
        $uuidModulo = $request->idmodulo;

        $idTurma = Turma::where('uuid',$uuidTurma)->pluck('id_turma')->first();
        $idModulo = Modulo::where('uuid',$uuidModulo)->pluck('id_modulo')->first();
        $idUser = Auth::User()->id;

        //dd($idTurma,$idModulo);
       
        $idAlunos = Aluno::where('id_turma',$idTurma)->get()->pluck('id_aluno');

        //dd($idAlunos);
        for($i=0;$i<count($idAlunos);$i++){
            $nomeAluno[$i] = Aluno::where('id_aluno',$idAlunos[$i])->pluck('nome')->first();
        }
        $modulo = Modulo::where('id_modulo',$idModulo)->pluck('designacao')->first();
        $anoTurma = Turma::where('id_turma',$idTurma)->pluck('ano')->first();
        $turmaTurma = Turma::where('id_turma',$idTurma)->pluck('turma')->first();
        $turma = $anoTurma.$turmaTurma;
        //dd($nomeAluno,$modulo,$turma);
        

        $numAulasModulo = Modulo::where('id_modulo',$idModulo)->pluck('num_aulas')->first();
        $numAulasAtual = Aula::where('id_modulo',$idModulo)->where('id_turma',$idTurma)->pluck('licao')->last();

        if($numAulasModulo==$numAulasAtual){
            for($k=0;$k<count($idAlunos);$k++){
                $avaliacoes = Avaliacao::where('id_modulo',$idModulo)->where('id_aluno',$idAlunos[$k])->get();
                if($avaliacoes->isEmpty()){
                    //$mensagem = "O Aluno não tem avaliações.";
                    $medias[$k] = "0";
                }
                else{
                    $verTeste = Avaliacao::where('id_aluno',$idAlunos[$k])->where('id_criterio',4)->where('id_modulo',$idModulo)->get();
                    //dd($verTeste);
                    if($verTeste->isEmpty()){
                        $medias[$k] = "0";
                        //dd("teste");
                        //$mensagem = "O aluno não tem nenhuma nota de teste dada neste módulo.";
                    }
                    else{
                        $notaFinalModulo = 0;
                        $notaFinalCriterio = 0;
                        $contaAvaliacoes = count($avaliacoes);

                        //dd($contaAvaliacoes);
                        $aulas = Avaliacao::where('id_aluno',$idAlunos[$k])->where('id_criterio',1)->get();
                        $numAulas = count($aulas);
                        
                        $idDisciplina = Modulo::where('id_modulo',$idModulo)->pluck('id_disciplina')->first();
                        $idsCriterios = Criterio::where('id_user',$idUser)->where('id_disciplina',$idDisciplina)->get()->pluck('id_criterio');
                        //dd($idsCriterios);
                        $nc = 0;
                        foreach($idsCriterios as $idCriterio){
                            $avaliacoesCriterio = Avaliacao::where('id_criterio',$idCriterio)->where('id_modulo',$idModulo)->where('id_aluno',$idAlunos[$k])->get();
                            $contaAvaliacoesCriterio = count($avaliacoesCriterio);
                                if($contaAvaliacoesCriterio<=0){
                                    // $mensagem = "O aluno não foi avaliado em todos os critérios devido á alteração dos critérios.";
                                    // return response()->json($mensagem);
                                    $medias[$k] = "0";
                                }
                                else{
                                    $notaFinalCriterio = 0;
                                    $notaCriterio = 0;
                                    for($i=0;$i<$contaAvaliacoesCriterio;$i++){
                                        $notaAvaliacao = $avaliacoesCriterio[$i]->nota;
                                        $percentagem = Criterio::where('id_criterio',$idCriterio)->pluck('percentagem')->first();
                                        $percentagem = $percentagem/100;
                                        $nota = $notaAvaliacao * $percentagem;
                                        $notaFinalCriterio = $notaFinalCriterio + $nota;
                                        $notaCriterio = $notaCriterio+$notaAvaliacao;
                                    }
                                    $notaCriterio = $notaCriterio/$contaAvaliacoesCriterio;
                                    $nomeCriterio = Criterio::where('id_criterio',$idCriterio)->pluck('designacao')->first();
                                    $notasCriterios[$nc] = $nomeCriterio.": ".$notaCriterio;
                                    $nc=$nc+1;

                                    $notaFinalCriterio = $notaFinalCriterio/$contaAvaliacoesCriterio;

                                    
                                    $notaFinalModulo = $notaFinalModulo+$notaFinalCriterio;
                                    //$this->line('Nota Criterio somadas: '.$notaFinalCriterio. ' Nota Final : '.$notaFinalModulo);
                                }
                            

                        }
                        $medias[$k] = round($notaFinalModulo,2);
                        //$mensagem = "A média do aluno neste módulo é de ".round($notaFinalModulo,2)." Valores (Considerando que foi avaliado em ".$numAulas." de ".$numAulasModulo." aulas do módulo).";

                    }
            }

        }
            
        }
        else{
            return back()->with('permissoes','O módulo ainda não atingiu o limite de aulas.');
        }

        $pdf = PDF::loadView('pdfturma',[
            'medias'=>$medias,
            'nomeAlunos'=>$nomeAluno,
            'modulo'=>$modulo,
            'turma'=>$turma

        ]);
        
        return $pdf->download('Modulo.pdf');
    }
    public function transferirPdf(Request $request){
        $notaCriterios = $request->notaCriterios;
        $media = $request->media;
        $nome = $request->nome;
        $turma = $request->turma;
        $modulo = $request->modulo;
        //dd($notaCriterios,$media,$nome,$turma,$modulo);
        
        $pdf = PDF::loadView('pdf',[
            'notaCriterios'=>$notaCriterios,
            'media'=>$media,
            'nome'=>$nome,
            'modulo'=>$modulo,
            'turma'=>$turma

        ]);
        
        return $pdf->download('Modulo.pdf');
    }


    public function criteriosAdicionar(Request $request){
        if(Gate::allows('professor')){
            $designacao = $request->designacao;
            $uuidDisciplina = $request->disciplina;
            $idDisciplina = Disciplina::where('uuid',$uuidDisciplina)->pluck('id_disciplina')->first();
            $idUser = Auth::User()->id;

            $check = Criterio::where('designacao',$designacao)->where('id_disciplina',$idDisciplina)->where('id_user',$idUser)->first();
            if(is_null($check)){
                $criterio['designacao'] = $designacao;
                $criterio['percentagem'] = 0;
                $criterio['id_user'] = $idUser;
                $criterio['id_disciplina'] = $idDisciplina;

                $novoCriterio = Criterio::create($criterio);

                return back()->with('mensagem','Criterio criado com sucesso');
            }
            else{
                return back()->with('permissoes','O criterio ja existe');
            }
        }
        else{
            return redirect()->route('index');
        }
        

    }

    public function criteriosEditar(Request $request){
        if(Gate::allows('professor')){
            $idCriterios = $request->idcriterio;
            $percentagem = $request->percentagem;
            $length = count($idCriterios);
            $somaPercentagem = 0;

            for($i=0;$i<$length;$i++){
                $somaPercentagem = $somaPercentagem + $percentagem[$i];
            }
            if($somaPercentagem==100){
                for($i=0;$i<$length;$i++){
                    $criterio = Criterio::where('id_criterio',$idCriterios[$i])->first();
            
                    $campos['percentagem'] = $percentagem[$i];
        
                    $criterio->update($campos);
                }
                return back()->with('mensagem','Criterios editados com sucesso');
            }
            else{
                return back()->with('permissoes','A soma das percentagens dos criterios nao e igual a 100%');
            }
        }
        else{
            return redirect()->route('index');
        }



    }
    public function criteriosDelete(Request $request){
        if(Gate::allows('professor')){
            $idCriterio = $request->idcriterio;

            $percentagem = Criterio::where('id_criterio',$idCriterio)->pluck('percentagem');
            $idUser = Criterio::where('id_criterio',$idCriterio)->pluck('id_user');
            $idDisciplina = Criterio::where('id_criterio',$idCriterio)->pluck('id_disciplina');

            $teste = Criterio::where('designacao','Teste')->where('id_user',$idUser)->where('id_disciplina',$idDisciplina)->first();
            //dd($teste,$percentagem);
            $percentagemNova = $percentagem[0] + $teste->percentagem;

            $campos['percentagem'] = $percentagemNova;

            $teste->update($campos);

            Criterio::findOrFail($idCriterio)->delete();

            $avaliacao = Avaliacao::where('id_criterio',$idCriterio)->delete();

            return back()->with('mensagem','Criterio eliminado com sucesso');
        }
        else{
            return redirect()->route('index');
        }

    }
    public function obterCriterios(Request $request){
        $uuidDisciplina = $request->uuiddisciplina;
        $idUser = $request->iduser;
        $idDisciplina = Disciplina::where('uuid',$uuidDisciplina)->pluck('id_disciplina')->first();

        $criterios = Criterio::where('id_user',$idUser)->where('id_disciplina',$idDisciplina)->get();
        //dd($criterios);
        if(count($criterios)<1){
            //dd('teste');
            $campos = [
                'designacao' => 'Teste',
                'percentagem' => '100',
                'id_user' => $idUser,
                'id_disciplina' => $idDisciplina
            ];
            Criterio::create($campos);
            $criterios = Criterio::where('id_user',$idUser)->where('id_disciplina',$idDisciplina)->get();
        }

        return response()->json($criterios);
    }
    public function registosRemoverFaltas(Request $request){
        if(Gate::allows('professor')){
            $idFalta = $request->idfalta;

            $falta = Falta::findOrFail($idFalta);

            $falta->delete();

            return back();
        }
        else{
            return redirect()->route('index');
        }
    }
    public function registosFaltas(Request $request){
        if(Gate::allows('professor')){
            $uuidAluno = $request->uuidaluno;
            $uuidAula = $request->uuidaula;
            
            
            $idAluno = Aluno::where('uuid',$uuidAluno)->pluck('id_aluno')->first();
            $idAula = Aula::where('uuid',$uuidAula)->pluck('id_aula')->first();

            $avaliacao = Avaliacao::where('id_aula',$idAula)->where('id_aluno',$idAluno)->delete();
        
            $falta['id_aluno'] = $idAluno;
            $falta['id_aula'] = $idAula;

            $novaFalta=Falta::create($falta);

            return back();
        }
        else{
            return redirect()->route('index');
        }
    }
    public function registosCriterios(Request $request){
        if(Gate::allows('professor')){
            $idUser = Auth::user()->id;
            $disciplinasUsers = Disciplina::whereHas('Users',function ($q) use($idUser){
                $q->where('users.id',$idUser);
            })->get();

            //dd($disciplinasUsers);

            return view('registos.criterios',[
                'disciplinas'=>$disciplinasUsers
            ]);
        }
        else{
            return redirect()->route('index');
        }
        
    }

    public function obterNotas(Request $request){
        $idUser = $request->iduser;
        //dd($idUser);
        $uuidModulo = $request->idmodulo;
        $idModulo = Modulo::where('uuid',$uuidModulo)->pluck('id_modulo')->first();
        $idAluno = $request->idaluno;
        $idTurma = Aluno::where('id_aluno',$idAluno)->pluck('id_turma')->first();

        $anoTurma = Turma::where('id_turma',$idTurma)->pluck('ano')->first();
        $turmaTurma = Turma::where('id_turma',$idTurma)->pluck('turma')->first();
        $turma = $anoTurma.$turmaTurma;

        $nomeAluno = Aluno::where('id_aluno',$idAluno)->pluck('nome')->first();

        $modulo = Modulo::where('id_modulo',$idModulo)->pluck('designacao')->first();

        $numAulasModulo = Modulo::where('id_modulo',$idModulo)->pluck('num_aulas')->first();
        $numAulasAtual = Aula::where('id_modulo',$idModulo)->where('id_turma',$idTurma)->pluck('licao')->last();

        if($numAulasModulo==$numAulasAtual){
            $avaliacoes = Avaliacao::where('id_modulo',$idModulo)->where('id_aluno',$idAluno)->get();
            if($avaliacoes->isEmpty()){
                $mensagem = "O Aluno não tem avaliações.";
            }
            else{
                $verTeste = Avaliacao::where('id_aluno',$idAluno)->where('id_criterio',4)->where('id_modulo',$idModulo)->get();
                //dd($verTeste);
                if($verTeste->isEmpty()){
                    $mensagem = "O aluno não tem nenhuma nota de teste dada neste módulo.";
                }
                else{
                    $notaFinalModulo = 0;
                    $notaFinalCriterio = 0;
                    $contaAvaliacoes = count($avaliacoes);

                    //dd($contaAvaliacoes);
                    $aulas = Avaliacao::where('id_aluno',$idAluno)->where('id_criterio',1)->get();
                    $numAulas = count($aulas);
                    
                    $idDisciplina = Modulo::where('id_modulo',$idModulo)->pluck('id_disciplina')->first();
                    $idsCriterios = Criterio::where('id_user',$idUser)->where('id_disciplina',$idDisciplina)->pluck('id_criterio')->all();
                    //dd($idsCriterios);
                    $nc = 0;
                    foreach($idsCriterios as $idCriterio){
                        $avaliacoesCriterio = Avaliacao::where('id_criterio',$idCriterio)->where('id_modulo',$idModulo)->where('id_aluno',$idAluno)->get();
                        $contaAvaliacoesCriterio = count($avaliacoesCriterio);
                        if($contaAvaliacoesCriterio<=0){
                            $mensagem = "O aluno não foi avaliado em todos os critérios devido á alteração dos critérios.";
                            return response()->json($mensagem);
                        }
                        $notaFinalCriterio = 0;
                        $notaCriterio = 0;
                        for($i=0;$i<$contaAvaliacoesCriterio;$i++){
                            $notaAvaliacao = $avaliacoesCriterio[$i]->nota;
                            $percentagem = Criterio::where('id_criterio',$idCriterio)->pluck('percentagem')->first();
                            $percentagem = $percentagem/100;
                            $nota = $notaAvaliacao * $percentagem;
                            $notaFinalCriterio = $notaFinalCriterio + $nota;
                            $notaCriterio = $notaCriterio+$notaAvaliacao;
                        }
                        $notaCriterio = $notaCriterio/$contaAvaliacoesCriterio;
                        $nomeCriterio = Criterio::where('id_criterio',$idCriterio)->pluck('designacao')->first();
                        $notasCriterios[$nc] = $nomeCriterio.": ".$notaCriterio;
                        $nc=$nc+1;

                        $notaFinalCriterio = $notaFinalCriterio/$contaAvaliacoesCriterio;

                        
                        $notaFinalModulo = $notaFinalModulo+$notaFinalCriterio;
                        //$this->line('Nota Criterio somadas: '.$notaFinalCriterio. ' Nota Final : '.$notaFinalModulo);

                    }
                    
                    $mensagem = "A média do aluno neste módulo é de ".round($notaFinalModulo,2)." Valores (Considerando que foi avaliado em ".$numAulas." de ".$numAulasModulo." aulas do módulo).";

                }

        }
            
        }
        else{
            $mensagem = "O módulo ainda não atingiu o limite de aulas.";
        }

        if(isset($notasCriterios)){
            return response()->json([
                'mensagem'=>$mensagem,
                'notaCriterios'=>$notasCriterios,
                'nome'=>$nomeAluno,
                'turma'=>$turma,
                'modulo'=>$modulo
                ]);
        }
        else{
            return response()->json([
                'mensagem'=>$mensagem,
                'nome'=>$nomeAluno,
                'turma'=>$turma,
                'modulo'=>$modulo
                ]);
        }

            


    }

    public function registosAlunos(Request $request){
        if(Gate::allows('professor')){
            $idUser = Auth::user()->id;
            $idAnoLetivo = AnosLetivos::where('ativo','sim')->pluck('id_ano_letivo')->first();

            $idCursosLetivo = Curso::where('id_ano_letivo',$idAnoLetivo)->pluck('id_curso')->all();

            $cursosUser = Curso::whereHas('Users',function ($q) use ($idCursosLetivo){
                $q->whereIn('users.id',$idCursosLetivo);
            })->get();
            $idCursosUser = $cursosUser->pluck('id_curso')->toArray();

            $idCursos =  array_intersect ($idCursosLetivo,$idCursosUser);

            $cursos = Curso::whereIn('id_curso',$idCursos)->get();
            
            return view('registos.alunos',['cursos'=>$cursos]);
        }
        else{
            return redirect()->route('index');
        }
    }

    public function registosModulosAluno(Request $request){
        if(Gate::allows('professor')){
            $uuidAluno = $request->uuidaluno;
            $idUser = Auth::user()->id;
            $idTurma = Aluno::where('uuid',$uuidAluno)->pluck('id_turma')->first();
            $disciplinasTurma = Disciplina::whereHas('turmas',function ($q) use ($idTurma){
                $q->where('turmas.id_turma',$idTurma);
            })->get();
            $dt = $disciplinasTurma->pluck('id_disciplina')->toArray();

            $disciplinasUser = Disciplina::whereHas('users',function ($q) use ($idUser){
                $q->where('users.id',$idUser);
            })->get();
            $du = $disciplinasUser->pluck('id_disciplina')->toArray();
            
            $idDisciplinas = array_intersect ($dt,$du);

            $disciplinas = Disciplina::whereIn('id_disciplina',$idDisciplinas)->get();

            $idAluno = Aluno::where('uuid',$uuidAluno)->pluck('id_aluno')->first();

            //$disciplinasTurma = $disciplinasTurma->pluck('id_disciplina');

            //dd($disciplinasTurma);

            return view('registos.modulos',[
                'disciplinas'=>$disciplinasTurma,
                'idaluno'=>$idAluno
            ]);
            }
            else{
                return redirect()->route('index');
            }
    }

    public function obterModulos(Request $request){
        $idDisciplina = $request->iddisciplina;
        $modulos = Modulo::where('id_disciplina',$idDisciplina)->get();
        return response()->json($modulos);
    }



    public function registosIndex(Request $request){
        if(Gate::allows('professor')){
       
                $uuidTurma = $request->uuidturma;
                $uuidModulo= $request->uuidmodulo;
                $uuidAula = $request->uuidaula;
                    
                $idDisciplina = Modulo::where('uuid', $uuidModulo)->pluck('id_disciplina')->first();
                $uuidDisciplina = Disciplina::where('id_disciplina', $idDisciplina)->pluck('uuid')->first();
                //$uuid= Str::uuid();
                //dd($uuid);
                    //dd($idAluno);
                    $idTurma = Turma::where('uuid', $uuidTurma)->pluck('id_turma')->first();
                    $idAula = Aula::where('uuid',$uuidAula)->pluck('id_aula')->first();

                    $alunos = Aluno::where('id_turma', $idTurma)->with(['faltas' => function ($q) use ($idAula){
                        $q->where('id_aula',$idAula);
                    }])->paginate(5);
                
                
                    //dd($alunos);


                    $disciplina = Disciplina::where('id_disciplina',$idDisciplina)->pluck('designacao')->first();
                    $turmaAno = Turma::where('uuid',$uuidTurma)->pluck('ano')->first();
                    $turmaLetra = Turma::where('uuid',$uuidTurma)->pluck('turma')->first();
                    $turma = $turmaAno . $turmaLetra;
                    $modulo = Modulo::where('uuid',$uuidModulo)->pluck('designacao')->first();
                    $aula = Aula::where('uuid',$uuidAula)->pluck('licao')->first();
                
                return view('registos.index',[
                    'uuidaula'=>$uuidAula,
                    'uuidturma'=>$uuidTurma,
                    'uuidmodulo'=>$uuidModulo,
                    'uuiddisciplina'=>$uuidDisciplina,
                    'alunos'=>$alunos,
                    'disciplina'=>$disciplina,
                    'modulo'=>$modulo,
                    'aula'=>$aula,
                    'turma'=>$turma
                ]);
            }
            else{
                return redirect()->route('index');
            }
    }
    
    public function registosShow(Request $request){
        if(Gate::allows('professor')){
        
                $uuidAluno = $request->uuid;
                $uuidModulo = $request->uuidmodulo;
                $uuidAula = $request->uuidaula;
                $aluno = Aluno::where('uuid',$uuidAluno)->first();
                $idTurma = Aluno::where('uuid',$uuidAluno)->pluck('id_turma')->first();
                $uuidTurma = Turma::where('id_turma', $idTurma)->pluck('uuid')->first();
                
                return view('registos.show',['aluno'=>$aluno,'uuidturma'=>$uuidTurma,'uuidmodulo'=>$uuidModulo,'uuidaula'=>$uuidAula]);
        }
        else{
            return redirect()->route('index');
        }
   }
    
    public function registosAvaliar(Request $request){
        if(Gate::allows('professor')){
                $uuid= (string) Str::uuid();

                $uuidTurma = $request->uuidturma;
                $uuidDisciplina= $request->uuiddisciplina;
                $uuidModulo = $request->uuidmodulo;
                $idModulo = Modulo::where('uuid',$uuidModulo)->pluck('id_modulo')->first();
                $idTurma = Turma::where('uuid',$uuidTurma)->pluck('id_turma')->first();

                $aulas = Aula::where('id_modulo',$idModulo)->where('id_turma',$idTurma)->orderBy('licao', 'desc')->get();
                //dd($aulas);
                $idDisciplina = Disciplina::where('uuid',$uuidDisciplina)->pluck('id_disciplina')->first();
                


                $disciplina = Disciplina::where('id_disciplina',$idDisciplina)->pluck('designacao')->first();
                $turmaAno = Turma::where('uuid',$uuidTurma)->pluck('ano')->first();
                $turmaLetra = Turma::where('uuid',$uuidTurma)->pluck('turma')->first();
                $turma = $turmaAno . $turmaLetra;
                $modulo = Modulo::where('uuid',$uuidModulo)->first();

                $numAulasAtual = Aula::where('id_modulo',$idModulo)->where('id_turma',$idTurma)->pluck('licao')->last();
                $numAulaSeguinte = $numAulasAtual+1;

                

                return view('registos.avaliar',[
                    'uuidDisciplina'=>$uuidDisciplina,
                    'uuidTurma'=>$uuidTurma,
                    'uuidModulo'=>$uuidModulo,
                    'disciplina'=>$disciplina,
                    'turma'=>$turma,
                    'modulo'=>$modulo,
                    'aulas'=>$aulas,
                    'numAulasAtual'=>$numAulasAtual,
                    'numAulaSeguinte'=>$numAulaSeguinte
                ]);

        }
        else{
            return redirect()->route('index');
        }

    }

    public function registosAvaliarAula(Request $request){
        if(Gate::allows('professor')){

                    $uuidAula = $request->uuidaula;
                    $uuidModulo = $request->uuidmodulo;
                    $uuidAluno = $request->uuidaluno;
                    
                    $idDisciplina = Modulo::where('uuid',$uuidModulo)->pluck('id_disciplina')->first();
                    $idUser = Auth::User()->id;

                    $criteriosCount = Criterio::where('id_disciplina', $idDisciplina)->where('id_user', $idUser)->get();
                    if(count($criteriosCount)<1){
                        return redirect()->route('registos.criterios')->with('mensagem', 'Tem de adicionar critérios à disciplina antes de avaliar.');
                    }
                    
                    $idAula = Aula::where('uuid',$uuidAula)->pluck('id_aula')->first();
                    $idModulo = Modulo::where('uuid',$uuidModulo)->pluck('id_modulo')->first();
                    $idAluno = Aluno::where('uuid',$uuidAluno)->pluck('id_aluno')->first();
                    //\DB::enableQueryLog();
                    $criterios = Criterio::with(['avaliacoes' => function ($query) use($idAluno,$idAula){
                        $query->where('id_aluno', $idAluno)->where('id_aula',$idAula);
                    }])->get();
                    // dd(\DB::getQueryLog());

                    //dd($idAula,$idModulo,$idAluno, $criterios,$avaliacoes);

                    $aluno = Aluno::where('id_aluno',$idAluno)->pluck('nome')->first();
                    
                    $idTurma = Aluno::where('id_aluno',$idAluno)->pluck('id_turma')->first();
                    $uuidTurma = Turma::where('id_turma',$idTurma)->pluck('uuid')->first();
                    //$avaliacoes = Avaliacao::where('id_aula',$idAula)->where('id_aluno',$idAluno)->where('id_modulo',$idModulo)->get();
                    //dd($avaliacoes);


                    $modulo = Modulo::where('uuid',$uuidModulo)->pluck('designacao')->first();
                    $licao = Aula::where('uuid',$uuidAula)->pluck('licao')->first();
                    $turma = Turma::where('id_turma',$idTurma)->pluck('turma')->first();
                    $ano = Turma::where('id_turma',$idTurma)->pluck('ano')->first();

                    return view('registos.avaliacao',[
                        'uuidTurma'=>$uuidTurma,
                        'uuidModulo'=>$uuidModulo,
                        'uuidAula'=>$uuidAula,
                        'criterios'=>$criterios,
                        'idAula'=>$idAula,
                        'idModulo'=>$idModulo,
                        'idAluno'=>$idAluno,
                        'aluno'=>$aluno,
                        'modulo'=>$modulo,
                        'turma'=>$turma,
                        'ano'=>$ano,
                        'licao'=>$licao
                    ]);
        }
        else{
            return redirect()->route('index');
        }
    }
    
    public function registosAvaliacaoAula(Request $request){
        if(Gate::allows('professor')){
                //dd($request->nota);
                $notas = $request->nota;
                $arrayNotaLenght = count($notas);
                $idCriterio = $request->id_criterio;
                //dd($arrayNotaLenght);
                //dd($idAvaliacao);
                $cri=0;
                //dd($idCriterio, $notas);

                $idAula = $request->id_aula;
                $idModulo = $request->id_modulo;

                $avaliacoes = Avaliacao::where('id_aula',$idAula)->where('id_modulo',$idModulo)->delete();


                    for($i=0;$i<$arrayNotaLenght;$i++){
                        $avaliacao = $request->validate([
                        //'nota'=>['required','min:3','max:25'],  
                        'id_aula'=>['required'],
                        'id_modulo'=>['required'],
                        'id_aluno'=>['required']
                        ]);
                        $avaliacao['nota'] = $notas[$i];
                        $avaliacao['id_criterio'] = $idCriterio[$cri]; 
            
                        $novaAvaliacao = Avaliacao::create($avaliacao);
            
                        $cri++;
                    }
                



                
                return redirect()->route('index');
        }
        else{
            return redirect()->route('index');
        }
        
        
    }

    public function obterAlunos(Request $request){
        $uuidTurma = $request->idturma;
        $idTurma = Turma::where('uuid',$uuidTurma)->pluck('id_turma')->first();

        $alunos = Aluno::where('id_turma',$idTurma)->get();
        //dd($alunos);

        return response()->json($alunos);
    }

    public function obterAulas(Request $request){
        $uuidModulo= $request->idmodulo;
        
        $idModulo = Modulo::where('uuid', $uuidModulo)->pluck('id_modulo')->first();
        
        $idUser= $request->iduser;

        $aulas = Aula::where('id_modulo',$idModulo)->get();
        //dd($aulas);
        return response()->json($aulas);
    }

    public function registosAula(Request $request){
        if(Gate::allows('professor')){
                $uuidDisciplina= $request->uuiddisciplina;
                $uuidModulo= $request->uuidmodulo;

                $idDisciplina = Disciplina::where('uuid',$uuidDisciplina)->pluck('id_disciplina')->first();
                $idModulo = Modulo::where('uuid',$uuidModulo)->pluck('id_modulo')->first();

                $ultimaLicao = Aula::where('id_modulo',$idModulo)->pluck('licao')->last();
                $novaLicao = $ultimaLicao + 1;
                //dd($novaLicao);
                
                $numAulasModulo = Modulo::where('id_modulo',$idModulo)->pluck('num_aulas')->first();


                if($novaLicao<=$numAulasModulo){
                    return view('registos.aula',[
                        'uuiddisciplina'=>$uuidDisciplina,
                        'uuidmodulo'=>$uuidModulo,
                        'novalicao'=>$novaLicao
                    ]);
                }
                else{
                    return back()->with('permissoes', 'Número limite de aulas do módulo');
                }
            }
        else{
            return redirect()->route('index');
        }

    }

    public function registosAulaStore(Request $request){
        if(Gate::allows('professor')){
                $uuidDisciplina = $request->uuiddisciplina;
                $uuidModulo = $request->uuidmodulo;
                $uuidTurma = $request->uuidturma;
                $idTurma = Turma::where('uuid',$uuidTurma)->pluck('id_turma')->first();
                $idDisciplina = Disciplina::where('uuid',$uuidDisciplina)->pluck('id_disciplina')->first();
                $idModulo = Modulo::where('uuid',$uuidModulo)->pluck('id_modulo')->first();
                $aula = $request->validate([
                    'licao'=>['required', 'unique:aulas','max:11'],
                    'observacoes'=>['required','max:255']
                ],
                [
                    'licao.required' => 'Precisa de introduzir um nome!',
                    'licao.max' => 'Nome muito longo! (Max:11)',
                    'licao.unique'=>'Licao já criada',
                    'observacoes.required' => 'Precisa de introduzir uma observacao!',
                    'observacao.max' => 'Observacao muito longa! (Max:11)',

                ]);
                $uuid= (string) Str::uuid();
                //dd($uuid);
                $aula['uuid'] = $uuid;
                $aula['id_disciplina'] = $idDisciplina;
                $aula['id_modulo'] = $idModulo;
                $aula['id_turma'] = $idTurma;
                
                
                $novaAula=Aula::create($aula);   
                
                return redirect()->route('index')->with('mensagem','Aula criada com sucesso');
        }
        else{
            return redirect()->route('index');
        }

    }


    public function registosAulaEdit(Request $request){
        if(Gate::allows('professor')){
            $uuidAula= $request->uuidaula;
            
            $aula = Aula::where('uuid',$uuidAula)->first();  
            
            return view('registos.edit',['aula'=>$aula,'uuidaula'=>$uuidAula]);
        }
        else{
            return redirect()->route('index');
        }
    }

    public function registosAulaUpdate(Request $request){
        if(Gate::allows('professor')){
            $uuidAula= $request->uuidaula;
            
            $idAula = Aula::where('uuid',$uuidAula)->pluck('id_aula')->first();  

            $aula = Aula::findOrFail($idAula);

            $campos = $request->validate([
                'licao'=>['required','max:11'],
                'observacoes'=>['required','max:255']
            ],
            [
                'licao.required' => 'Precisa de introduzir um nome!',
                'licao.max' => 'Nome muito longo! (Max:11)',
                'licao.unique'=>'Licao já criada',
                'observacoes.required' => 'Precisa de introduzir uma observacao!',
                'observacao.max' => 'Observacao muito longa! (Max:11)',

            ]);

            $aula->update($campos);
            
            return redirect()->route('index')->with('mensagem','Aula editada com sucesso');
        }
        else{
            return redirect()->route('index');
        }

    }

    public function testes(){
        if (AnosLetivos::where('ativo','sim')->get()->isEmpty()) {
            $alerta = "Percisa primeiro de um ano letivo ativo!";

            return $alerta;            
        }
        elseif (Curso::all()->isEmpty()) {
            $alerta = "Percisa primeiro de adicionar cursos!";

            return $alerta;  
        }
        elseif (Turma::all()->isEmpty()) {
            $alerta = "Percisa primeiro de adicionar turmas!";

            return $alerta;  
        }
    }

    
    public function index(Request $request){
        if ($this->testes() != false) {
            return redirect()->route('index')->with('alerta',$this->testes());
        }
        
        if(Gate::allows('admin')){
           $alunos = Aluno::paginate(5);
           $anosLetivos = AnosLetivos::orderBy('ano','desc')->get();
           
           return view('alunos.index',['alunos'=>$alunos,'anosLetivos'=>$anosLetivos]);
        }
        else{
            abort(404);
        }
   }
    
    public function show(Request $request){
        if(Gate::allows('admin')){
            $idAluno = $request->id;
        
            $aluno = Aluno::findOrFail($idAluno);

            return view('alunos.show',['aluno'=>$aluno]);
        }
       else{
            abort(404);
       }
   }
    
    public function create(){
        if(Gate::allows('admin')){
            $turmas = Turma::all();

            return view('alunos.create',[
                'turmas'=>$turmas,
            ]);
        }
       else{
            abort(404);
       }
    }
    
    public function store(Request $request){
        if(Gate::allows('admin')){
            //dd($request->all());
            $aluno = $request->validate([
                'nome'=>['required','min:3','max:25'],  
                'data_nascimento'=>['required'],
                'numero'=>['required','max:2'],
                'id_turma'=>['required'],
                'nacionalidade'=>['required','min:3','max:25'],
                'morada'=>['required','min:3','max:25'],
                'email'=>['nullable','min:3','max:50'],
                'fotografia'=>['image','nullable','max:2048']
            ],
            [
                'nome.required' => 'Percisa de introduzir um nome!',
                'nome.min' => 'Nome muito curto! (Min:3)',
                'nome.max' => 'Nome muito longo! (Max:25)',
                'data_nascimento.required' => 'Percisa de introduzir uma data!',
                'numero.required' => 'Percisa de introduzir um numero!',
                'numero.max' => 'Numero muito longo! (Max:5)',
                'id_turma.required' => 'Percisa de introduzir uma turma!',
                'nacionalidade.required' => 'Percisa de introduzir uma nacionalidade!',
                'nacionalidade.min' => 'Nacionalidade muito curta! (Min:3)',
                'nacionalidade.max' => 'Nacionalidade muito longa! (Max:25)',
                'morada.required' => 'Percisa de introduzir uma morada!',
                'morada.min' => 'Morada muito curta! (Min:3)',
                'morada.max' => 'Morada muito longa! (Max:50)',
                'email.min' => 'Email muito curto! (Min:3)',
                'email.max' => 'Email muito longo! (Max:25)',
                'fotografia.image' => 'Ficheiro selecionado não é uma imagem!',
                'fotografia.max' => 'Imagem muito pesada! (Max:2 MB)',
            ]);
            
            if($request->hasFile('fotografia')){
                $nomeImagem = $request->file('fotografia')->getClientOriginalName();
                $nomeImagem = time().'_'.$nomeImagem;
                $guardarImagem = $request->file('fotografia')->storeAs('imagens/alunos',$nomeImagem);
                $aluno['fotografia'] = $nomeImagem;
            }


            $uuid= Str::uuid();
            $aluno['uuid'] = $uuid;
            
            
            $novoAluno=Aluno::create($aluno);   
            
            return redirect()->route('alunos.show',[
                'id'=>$novoAluno->id_aluno
            ])->with('mensagem','Aluno criado com sucesso');
        
        }
       else{
            abort(404);
       }
    }

    public function edit(Request $request){
        if(Gate::allows('admin')){
            $aluno = Aluno::findOrFail($request->id);
            $idAluno = $request->id;
           
            return view('alunos.edit',[
                'aluno'=>$aluno,
            ]);
        }
        else{
            abort(404);
        }


    }
    
    
    
    public function update(Request $request){
        if(Gate::allows('admin')){
            //dd($request->all());
            $aluno = Aluno::findOrFail($request->id);
            $campos = $request->validate([
                'nome'=>['required','min:3','max:25'],  
                'data_nascimento'=>['required'],
                'numero'=>['required','max:2'],
                'id_turma'=>['required'],
                'nacionalidade'=>['required','min:3','max:25'],
                'morada'=>['required','min:3','max:25'],
                'email'=>['nullable','min:3','max:50'],
                'fotografia'=>['image','nullable','max:2048']
            ],
            [
                'nome.required' => 'Percisa de introduzir um nome!',
                'nome.min' => 'Nome muito curto! (Min:3)',
                'nome.max' => 'Nome muito longo! (Max:25)',
                'data_nascimento.required' => 'Percisa de introduzir uma data!',
                'numero.required' => 'Percisa de introduzir um numero!',
                'numero.max' => 'Numero muito longo! (Max:5)',
                'id_turma.required' => 'Percisa de introduzir uma turma!',
                'nacionalidade.required' => 'Percisa de introduzir uma nacionalidade!',
                'nacionalidade.min' => 'Nacionalidade muito curta! (Min:3)',
                'nacionalidade.max' => 'Nacionalidade muito longa! (Max:25)',
                'morada.required' => 'Percisa de introduzir uma morada!',
                'morada.min' => 'Morada muito curta! (Min:3)',
                'morada.max' => 'Morada muito longa! (Max:50)',
                'email.min' => 'Email muito curto! (Min:3)',
                'email.max' => 'Email muito longo! (Max:25)',
                'fotografia.image' => 'Ficheiro selecionado não é uma imagem!',
                'fotografia.max' => 'Imagem muito pesada! (Max:2 MB)',
            ]);
            
            if($request->hasFile('fotografia')){
                $foto_anterior = $aluno->fotografia;
            
                if(!is_null($foto_anterior)){
                    Storage::Delete('imagens/alunos/'.$foto_anterior);
                }
                
                $nomeImagem = $request->file('fotografia')->getClientOriginalName();
                $nomeImagem = time().'_'.$nomeImagem;
                $guardarImagem = $request->file('fotografia')->storeAs('imagens/alunos',$nomeImagem);   
                
                $campos['fotografia'] = $nomeImagem;
                
            }
        
            $aluno->update($campos);
        
            return redirect()->route('alunos.show',[
                'id'=>$aluno->id_aluno
            ])->with('mensagem','Aluno editado com sucesso');
        }
        else{
            abort(404);
        }
    }
    
    public function delete(Request $request){
        if(Gate::allows('admin')){
            $aluno = Aluno::findOrFail($request->id);
            
            
            $foto_antiga =  $aluno->fotografia;
            
            if(!is_null($foto_antiga)){
                    Storage::delete('imagens/alunos/'.$foto_antiga);
            }
            
            Aluno::findOrFail($request->id)->delete();

            return redirect()->route('alunos.index')->with('mensagem','Aluno eliminado com sucesso');
        }
        else{
            abort(404);
        }

    }
    
    
    public function obterTurmas(Request $request){
        $anoletivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
        $ano = $request->ano;
         
        $cursos = Curso::where('id_ano_letivo',$anoletivo)->get()->pluck('id_curso');
        $turmasAno = Turma::where('ano',$ano)->whereIn('id_curso',$cursos)->get();
        
        return response()->json($turmasAno);
    }
    
    public function alunosPorAno(Request $request){
        $anoletivo = $request->anoletivo;
        
        $cursos = Curso::where('id_ano_letivo',$anoletivo)->get()->pluck('id_curso');
        $turmas = Turma::whereIn('id_curso',$cursos)->get()->pluck('id_turma');
        $alunos = Aluno::whereIn('id_turma',$turmas)->orderBy('nome',"asc")->with('turma')->paginate(10);
        
        //dd($alunos);
        
        return response()->json($alunos);
    }


    
}
