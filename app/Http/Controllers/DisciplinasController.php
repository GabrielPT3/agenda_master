<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Exceptions\Handler;
use App\Disciplina;
use App\Aluno;
use App\AnosLetivos;
use App\DisciplinaDocente;
use App\Curso;
use App\CursoDisciplina;
use App\TurmaDisciplinaUser;
use App\Turma;
use Auth;
use Gate;
use Str;


class DisciplinasController extends Controller
{
    public function testes(){
        if (AnosLetivos::where('ativo','sim')->get()->isEmpty()) {
            $alerta = "Percisa primeiro de um ano letivo ativo!";

            return $alerta;            
        }
        elseif (Curso::all()->isEmpty()) {
            $alerta = "Percisa primeiro de adicionar cursos!";

            return $alerta;  
        }
    }

    public function index(){
        if ($this->testes() != false) {
            return redirect()->route('index')->with('alerta',$this->testes());
        }

        if(Gate::allows('admin')){
            $anoletivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
            $cursos = Curso::where('id_ano_letivo',$anoletivo)->get()->pluck('id_curso');
            $cursosDisciplinas = CursoDisciplina::whereIn('id_curso',$cursos)->get()->pluck('id_disciplina');
            $disciplinas = Disciplina::whereIn('id_disciplina',$cursosDisciplinas)->paginate(10);

            return view('disciplinas.index',['disciplinas'=>$disciplinas]);
        }
        else{
            abort(404);
        }
   }
    
    
    public function show(Request $request){
        if(Gate::allows('admin')){
            $idDisciplina = $request->id;
            
            $disciplina = Disciplina::where('id_disciplina',$idDisciplina)->first();
            $anoLetivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
            $cursos = Curso::where('id_ano_letivo',$anoLetivo)->get()->pluck('id_curso');
            $turmasporano = Turma::whereIn('id_curso',$cursos)->get();

            $disciplinaTurmas = TurmaDisciplinaUser::where('id_disciplina', $disciplina->id_disciplina)->get()->pluck('id_turma');
            $disciplinaTurmas = Turma::whereIn('id_turma',$disciplinaTurmas)->whereIn('id_curso',$cursos)->orderBy('ano','asc')->get();
            
            $turmas = collect($turmasporano->diff($disciplinaTurmas));
            
            //dd($turmas);
                
            return view('disciplinas.show',['disciplina'=>$disciplina,'disciplinaTurmas'=>$disciplinaTurmas,'turmas'=>$turmas]);
        }
        else{
            abort(404);
        }
   }
    
    public function removerTurma(Request $request){
        if(Gate::allows('admin')){
            $idTurma = $request->idTurma;
            $idDisciplina = $request->idDisciplina;
            $turma = TurmaDisciplinaUser::where('id_disciplina', $idDisciplina)->where('id_turma',$idTurma)->first();
            
            $turma->delete();
           
            return redirect()->route('disciplinas.show',['id'=>$idDisciplina]);
        }
        else{
            abort(404);
        }
   }
    
    public function adicionarTurma(Request $request){
        if(Gate::allows('admin')){
            $idTurma = $request->idTurma;
            $idDisciplina = $request->idDisciplina;
            
            $teste = TurmaDisciplinaUser::where('id_turma',$idTurma)->where('id_disciplina',$idDisciplina)->first();
            
            if($teste==null){
                $turmaDisciplina = ['id_turma'=>$idTurma,'id_disciplina'=>$idDisciplina,'id_user'=>"0",];
            
                TurmaDisciplinaUser::create($turmaDisciplina);
            }
            return redirect()->route('disciplinas.show',['id'=>$idDisciplina]);
        }
        else{
            abort(404);
        }
   }
    
    public function create(){
        if(Gate::allows('admin')){
            $anoLetivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
            $cursos = Curso::where('id_ano_letivo',$anoLetivo)->get();
            
            
            return view('disciplinas.create', [
                'cursos'=>$cursos
            ]);
        }
        else{
            abort(404);
        }
    }
    
    public function store(Request $request){
        if(Gate::allows('admin')){
            $disciplina = $request->validate ([
                'designacao'=>['required','min:3','max:50'],  
                'numero_aulas'=>['numeric','nullable','min:1','max:1000'],
            ],
            [
                'designacao.required' => 'Percisa de introduzir uma designação!',
                'designacao.min' => 'Designação muito curta! (Min:3)',
                'designacao.max' => 'Designação muito longa! (Max:50)',
                'numero_aulas.numeric' => 'Percisa de introduzir um numero!',
                'numero_aulas.max' => 'Numero muito grande!',
            ]);
            
            $uuid= Str::uuid();
            $disciplina['uuid'] = $uuid;
            
            $cursos = $request->id_curso;
            
            $novaDisciplina=Disciplina::create($disciplina);
            $novaDisciplina->cursos()->attach($cursos);
            
            return redirect()->route('disciplinas.show',[
                'id'=>$novaDisciplina->id_disciplina
            ])->with('mensagem','Disciplina criada com sucesso');
        }
        else{
            abort(404);
        }
    }

    public function edit(Request $request){
        if(Gate::allows('admin')){
            $disciplina = Disciplina::findOrFail($request->id);
            $id = $request->id;
            
            $anoLetivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
            $cursos = Curso::where('id_ano_letivo',$anoLetivo)->get();
            $cursosDisciplinas = Curso::where('id_ano_letivo',$anoLetivo)->whereHas('disciplinas',function($q) use($id){
                $q->where('disciplinas.id_disciplina',$id);
            })->get()->pluck('id_curso')->toArray();    
            
            if(Gate::allows('admin')){
                return view('disciplinas.edit',[
                    'disciplina'=>$disciplina,
                    'cursos'=>$cursos,
                    'cursosDisciplinas'=>$cursosDisciplinas,
                ]);
            }
            else{
                return redirect()->route('disciplinas.index')->with('permissoes','Não tem permicões para editar esta disciplina');
            }
        }
        else{
            abort(404);
        }

    }
    
    
    
    public function update(Request $request){
        if(Gate::allows('admin')){
            $disciplina = Disciplina::findOrFail($request->id);
            $campos = $request->validate ([
                'designacao'=>['required','min:3','max:50'],  
                'numero_aulas'=>['numeric','nullable','max:1000'],
            ],
            [
                'designacao.required' => 'Percisa de introduzir uma designacao!',
                'designacao.min' => 'Nome muito curto! (Min:3)',
                'designacao.max' => 'Nome muito longo! (Max:50)',
                'numero_aulas.numeric' => 'Percisa de introduzir um numero!',
                'numero_aulas.max' => 'Numero muito grande!',
            ]);
            
            $cursos = $request->id_curso;
            $disciplina->update($campos);
            $disciplina->cursos()->sync($cursos);
            
            return redirect()->route('disciplinas.show',[
                'id'=>$disciplina->id_disciplina
            ])->with('mensagem','Disciplina atualizada com sucesso');
        }
        else{
            abort(404);
        }
    }
    
    public function delete(Request $request){
        if(Gate::allows('admin')){
            $disciplina = Disciplina::findOrFail($request->id);
            $turmas = TurmaDisciplinaUser::where('id_disciplina', $disciplina->id_disciplina)->delete();
            $disciplina->delete();
            
            return redirect()->route('disciplinas.index')->with('mensagem','Disciplina eliminada com sucesso');
        }
        else{
            abort(404);
        }

    }
    
}
