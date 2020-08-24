<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\AnosLetivos;
use App\User;
use App\Disciplina;
use App\Turma;
use App\Modulo;
use Auth;
use Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Str;
use App\CursoDisciplina;
use App\DisciplinaTurma;
use App\TurmaUser;
use App\TurmaDisciplinaUser;
use App\DisciplinaUser;

class IndexController extends Controller
{
    public function index(Request $request){
        $uuid= Str::uuid();
        //dd($uuid);
        if(Auth()->check()){
            //Session::put('idUser',Auth::user()->id);
            //Session::save();
    
            //$idUser = Session::get('idUser');
            //dd($idUser);
            
            if(Gate::allows('admin')){
                return view('dashboard');
            }
            else{
                $idAnoLetivo = AnosLetivos::where('ativo','sim')->pluck('id_ano_letivo')->first();
                $idUser = Auth::user()->id;
                $cursosUsers = Curso::whereHas('users',function ($q) use ($idUser){
                    $q->where('users.id',$idUser);
                })->get('id_curso');

                $cursosUsers = $cursosUsers->pluck('id_curso')->toArray();

                $cursos = Curso::where('id_ano_letivo',$idAnoLetivo)->whereIn('id_curso', $cursosUsers)->get();

                return view('index', [
                    'cursos'=>$cursos
                ]);
            } 
        }
        else{
            return view('auth.login');
        }
    }
    
    

    public function obterDisciplinas(Request $request){
        $idCurso = $request->idcurso;
        $idUser = $request->iduser;

        $disciplinasCurso = Disciplina::whereHas('cursos',function ($q) use ($idCurso){
            $q->where('cursos.id_curso',$idCurso);
        })->get('id_disciplina');

        $disciplinasCurso = $disciplinasCurso->pluck('id_disciplina')->toArray();

        $disciplinasUsers = DisciplinaUser::where('id_user', $idUser)->get();

        $disciplinasUsers = $disciplinasUsers->pluck('id_disciplina')->toArray();

        $arrayvariavel = 0;

        $countDisciplinasCurso = count($disciplinasCurso);

        for($i=0;$i<$countDisciplinasCurso;$i++){

            if(in_array($disciplinasCurso[$i], $disciplinasUsers)){
                $arraydisciplina[$arrayvariavel] = $disciplinasCurso[$i];
                $arrayvariavel++;
            }
        }

        $disciplinas = Disciplina::whereIn('id_disciplina', $arraydisciplina)->get();
        //dd($disciplinas);
        //dd($disciplinasCurso, $disciplinasUsers, $arraydisciplina);

        return response()->json($disciplinas);
    }


    public function obterTurmas(Request $request){
        $uuid = $request->uuiddisciplina;
        $idDisciplina = Disciplina::where('uuid',$uuid)->pluck('id_disciplina')->first();
        $idUser = $request->iduser;
        $idCurso= $request->idcurso;

        //dd($idUser, $idCurso, $uuid, $idDisciplina);
        
        $turmasDisciplina = TurmaDisciplinaUser::where('id_disciplina',$idDisciplina)->where('id_user',$idUser)->get();

        $turmasDisciplina = $turmasDisciplina->pluck('id_turma')->toArray();

        $turmas = Turma::whereIn('id_turma',$turmasDisciplina)->get();

        //dd($turmasDisciplina, $turmas);

        
        // $turmasUsers = TurmaUser::whereIn('id_turma',$turmasDisciplina)->get();
        // $turmasUsers = $turmasUsers->pluck('id_turma')->toArray();

        // $turmas = Turma::whereIn('id_turma',$turmasUsers)->get();


        //dd($turmas);

        return response()->json($turmas);

    }

    public function obterModulos(Request $request){
        $uuidDisciplina = $request->uuiddisciplina;
        $idDisciplina = Disciplina::where('uuid',$uuidDisciplina)->pluck('id_disciplina')->first();
        $uuidTurma = $request->uuidturma;
        $ano = Turma::where('uuid',$uuidTurma)->pluck('ano')->first();

        $modulos = Modulo::where('id_disciplina',$idDisciplina)->where('ano',$ano)->get();
        //$modulosTurmas = $modulosTurmas->pluck('id_modulo');
        //dd($modulos);
        

        return response()->json($modulos);
    }
    

    public function testes(){
        $anos = AnosLetivos::all();

        if (is_null($anos)) {
            $alerta = "Percisa criar primeiro um ano letivo";
        }
    }
}
