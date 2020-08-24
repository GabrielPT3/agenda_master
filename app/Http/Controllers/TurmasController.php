<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;
use App\Turma;
use App\Curso;
use App\Aluno;
use App\User;
use App\Disciplina;
use App\AnosLetivos;
use App\TurmaDisciplinaUser;
use App\DisciplinaUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;
use Gate;
use Str;


class TurmasController extends Controller
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

	public function index(Request $request){
        if ($this->testes() != false) {
            return redirect()->route('index')->with('alerta',$this->testes());
        }
        

        if(Gate::allows('admin')){
            $turmas = Turma::with('curso')->get();
            $anosLetivos = AnosLetivos::orderBy('ano','desc')->get();
            
            return view('turmas.index',['turmas'=>$turmas,'anosLetivos'=>$anosLetivos]);
        }
        else{
            abort(404);
        }
   }
    
    public function turmasPorAno(Request $request){
        $anoletivo = $request->anoletivo;
        
        $cursos = Curso::where('id_ano_letivo',$anoletivo)->get()->pluck('id_curso');
        $turmas = Turma::whereIn('id_curso',$cursos)->paginate(10);
        //dd($turmas);
        return response()->json($turmas);
        
    }

    public function show(Request $request){
        if(Gate::allows('admin')){
            $idTurma = $request->id;
           	$alunos = Aluno::where('id_turma',$idTurma)->get();
            $turma = DB::table('turmas_disciplinas_users')
                                ->join('users','turmas_disciplinas_users.id_user','=','users.id')
                                ->join('disciplinas','turmas_disciplinas_users.id_disciplina','=','disciplinas.id_disciplina')
                                ->join('turmas',function ($join) use ($idTurma){
                                    $join->on('turmas_disciplinas_users.id_turma','=','turmas.id_turma')
                                         ->where('turmas.id_turma', '=' , $idTurma);
                                })->get();
            //dd($turma);

            return view('turmas.show',['turma'=>$turma,'alunos'=>$alunos,'idTurma'=>$idTurma]);
        }
        else{
            abort(404);
        }
   }
    
    public function obteraAlunosSemTurma(){
        
        $alunos = Aluno::where('id_turma',0)->get();
        
        //dd($alunos);
            
        return response()->json($alunos);
   }
    public function adicionarAluno(Request $request){
        if(Gate::allows('admin')){
            $idAluno = $request->idAluno;
            $idTurma = $request->idTurma;
            $aluno = Aluno::findOrFail($request->idAluno);
            $campo['id_turma'] = $idTurma;
            $aluno->update($campo);
            $alunos = Aluno::where('id_turma',$idTurma)->get();
            $turma = Turma::where('id_turma',$idTurma)->first();
           
            return redirect()->route('turmas.show',['id'=>$idTurma,'alunos'=>$alunos]);
        }
        else{
            abort(404);
        }
   }
    
   public function removerAluno(Request $request){
        if(Gate::allows('admin')){
            $idTurma = $request->idTurma;
            $aluno = Aluno::findOrFail($request->idAluno);
            $campo['id_turma'] = 0;
            $aluno->update($campo);
           
            $turma = Turma::where('id_turma',$idTurma)->first();
           
            return redirect()->route('turmas.show',['id'=>$idTurma]);
        }
        else{
            abort(404);
        }
   }
    
    public function professoresPorDisciplina(Request $request){
        $idDisciplina = $request->iddisciplina;

        $professores = DisciplinaUser::where('id_disciplina',$idDisciplina)->get()->pluck('id_user');
        $professores = User::whereIn('id',$professores)->get();
        
        return response()->json($professores);
    }
    
    public function editarProfessor(Request $request){
        if(Gate::allows('admin')){
            $idTurma = $request->idTurma;
            $idProfessor = $request->idProfessor;
            $idDisciplina = $request->idDisciplina;
            
            $turma = TurmaDisciplinaUser::where('id_turma',$idTurma)->where('id_disciplina',$idDisciplina)->first();
            $campo['id_user'] = $idProfessor;
            $turma->update($campo);
            
            return redirect()->route('turmas.show',['id'=>$idTurma]);
        }
        else{
            abort(404);
        }
    }
    
    public function create(){
        if(Gate::allows('admin')){
            $anoletivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
            $cursos = Curso::where('id_ano_letivo',$anoletivo)->get();
            
            return view('turmas.create',['cursos'=>$cursos]);
        }
        else{
            abort(404);
        }
   }

    public function store(Request $request){
        if(Gate::allows('admin')){
            //dd($request->all());
            $turma = $request->validate([
                'turma'=>['required','max:5'],  
                'ano'=>['required'],
                'id_curso'=>['required'],
            ],
            [
                'turma.required' => 'Percisa de introduzir um nome para a turma!',
                'nome.max' => 'Nome muito longo! (Max:5)',
                'ano.required' => 'Percisa de introduzir um ano!',
                'id_curso.required' => 'Percisa de introduzir um curso!',
            ]);

            $uuid = Str::uuid();
            $turma['uuid'] = $uuid;
            
            
            $novaTurma = Turma::create($turma);   
            
            return redirect()->route('turmas.show',[
                'id'=>$novaTurma->id_turma
            ])->with('mensagem','Turma criada com sucesso');
        }
        else{
            abort(404);
        }
   }
    
    public function edit(Request $request){
        if(Gate::allows('admin')){
            $turma = Turma::findOrFail($request->id);
            $idAluno = $request->id;
            $anoletivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
            $cursos = Curso::where('id_ano_letivo',$anoletivo)->get();

            return view('turmas.edit',[
                'turma'=>$turma,
                'cursos'=>$cursos
            ]);
        }
        else{
            abort(404);
        }
    }
    
    public function update(Request $request){
        if(Gate::allows('admin')){
            //dd($request->all());
            $turma = Turma::findOrFail($request->id);
            $campos = $request->validate([
                'turma'=>['required','max:5'],  
                'ano'=>['required'],
                'id_curso'=>['required'],
            ],
            [
                'turma.required' => 'Percisa de introduzir um nome para a turma!',
                'nome.max' => 'Nome muito longo! (Max:5)',
                'ano.required' => 'Percisa de introduzir um ano!',
                'id_curso.required' => 'Percisa de introduzir um curso!',
            ]);  
            
            $turma->update($campos);
            
            return redirect()->route('turmas.show',[
                'id'=>$turma->id_turma
            ])->with('mensagem','Turma editada com sucesso');
        }
        else{
            abort(404);
        }
    }
    
    public function delete(Request $request){
        if(Gate::allows('admin')){
            Turma::findOrFail($request->id)->delete();  
            
            return redirect()->route('turmas.index')->with('mensagem','Turma eliminada com sucesso');
        }
        else{
            abort(404);
        }
    }
}
