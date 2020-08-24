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
use App\Modulo;
use Auth;
use Gate;
use Str;


class ModulosController extends Controller
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
        elseif (Disciplina::all()->isEmpty()) {
            $alerta = "Percisa primeiro de adicionar disciplinas!";

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
            $disciplinas = Disciplina::whereIn('id_disciplina',$cursosDisciplinas)->orderBy('designacao','asc')->get();
            
            return view('modulos.index',['disciplinas'=>$disciplinas]);
        }
        else{
            abort(404);
        }
   }
    
    public function modulosPorDisciplina(Request $request){
        $disciplina = $request->disciplina;
        
        $modulos = Modulo::where('id_disciplina',$disciplina)->orderBy('numero','asc')->paginate(1);
        
        return response()->json($modulos);
        
    }
    
    public function ultimoModulo(Request $request){
        $disciplina = $request->disciplina;
        
        $modulo = Modulo::where('id_disciplina',$disciplina)->max('numero');
        
        return response()->json($modulo+1);
        
    }
    
    public function show(Request $request){
        if(Gate::allows('admin')){
            $modulo = Modulo::where('id_modulo',$request->id)->first();

            return view('modulos.show',[
               'modulo'=>$modulo
            ]);
        }
        else{
            abort(404);
        }
    }
    
    public function create(Request $request){
        if(Gate::allows('admin')){
            $anoletivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
            $cursos = Curso::where('id_ano_letivo',$anoletivo)->get()->pluck('id_curso');
            $cursosDisciplinas = CursoDisciplina::whereIn('id_curso',$cursos)->get()->pluck('id_disciplina');
            $disciplinas = Disciplina::whereIn('id_disciplina',$cursosDisciplinas)->orderBy('designacao','asc')->get();

            return view('modulos.create',['disciplinas'=>$disciplinas]); 
        }
        else{
            abort(404);
        }  
    }
    
    public function store(Request $request){
        if(Gate::allows('admin')){
            $modulo = $request->validate ([
                'numero'=>['numeric','min:1','max:300','required'],
                'designacao'=>['required','min:3','max:50'],  
                'num_aulas'=>['numeric','min:1','max:300','required'],
                'ano'=>['required','numeric'],
                'ficha_informativa'=>['nullable','file','mimes:pdf'],
                'id_disciplina'=>['required'],
            ],
            [
                'designacao.required' => 'Percisa de introduzir uma designação!',
                'designacao.min' => 'Designação muito curta! (Min:3)',
                'designacao.max' => 'Designação muito longa! (Max:50)',
                'numero.required' => 'Percisa de introduzir um numero!',
                'num_aulas.numeric' => 'Percisa de introduzir um numero!',
                'num_aulas.max' => 'Numero muito grande!',
                'ano.required' => 'Percisa de introduzir um ano!',
                'ano.numeric' => 'Percisa de introduzir um numero!',
                'id_disciplina.required' => 'Percisa de introduzir uma disciplina!',
            ]);
            
            if($request->hasFile('ficha_informativa')){
                $nomePdf = $request->file('ficha_informativa')->getClientOriginalName();
                $nomePdf = time().'_'.$nomePdf;
                
                $guardarPdf = $request->file('ficha_informativa')->storeAs('pdf/modulos/',$nomePdf);

                $curso['ficha_informativa'] = $nomePdf;
            }
            
            $uuid = Str::uuid();
            $modulo['uuid'] = $uuid;
            
            $novoModulo = Modulo::create($modulo); 
            
            return redirect()->route('modulos.show',[
                'id'=>$novoModulo->id_modulo
            ])->with('mensagem','Modulo criado com sucesso');
        }
        else{
            abort(404);
        }  
    }
    
    public function edit(Request $request){
        if(Gate::allows('admin')){
            $anoletivo = AnosLetivos::where('ativo',"sim")->get()->pluck('id_ano_letivo');
            $cursos = Curso::where('id_ano_letivo',$anoletivo)->get()->pluck('id_curso');
            $cursosDisciplinas = CursoDisciplina::whereIn('id_curso',$cursos)->get()->pluck('id_disciplina');
            $disciplinas = Disciplina::whereIn('id_disciplina',$cursosDisciplinas)->orderBy('designacao','asc')->get();
            $modulo = Modulo::findOrFail($request->id);
        
            return view('modulos.edit',['modulo'=>$modulo,'disciplinas'=>$disciplinas]);
        }
        else{
            abort(404);
        }


    }
    
    public function update(Request $request){
        if(Gate::allows('admin')){
            $modulo = Modulo::findOrFail($request->id);
            $campos = $request->validate ([
                'numero'=>['numeric','min:1','max:300'],
                'designacao'=>['required','min:3','max:50'],  
                'num_aulas'=>['numeric','min:1','max:300'],
                'ano'=>['required','numeric'],
                'ficha_informativa'=>['nullable','file','mimes:pdf'],
                'id_disciplina'=>['required'],
            ],
            [
                'designacao.required' => 'Percisa de introduzir uma designação!',
                'designacao.min' => 'Designação muito curta! (Min:3)',
                'designacao.max' => 'Designação muito longa! (Max:50)',
                'numero.required' => 'Percisa de introduzir um numero!',
                'num_aulas.numeric' => 'Percisa de introduzir um numero!',
                'num_aulas.max' => 'Numero muito grande!',
                'ano.required' => 'Percisa de introduzir um ano!',
                'ano.numeric' => 'Percisa de introduzir um numero!',
                'id_disciplina.required' => 'Percisa de introduzir uma disciplina!',
            ]);
            
            if($request->hasFile('ficha_informativa')){
                $nomePdfAntiga =  $modulo->ficha_informativa;
            
                if(!is_null($nomePdfAntiga)){
                    $eliminarPdf = Storage::delete('pdf/modulos/'.$nomePdfAntiga);
                }
                
                $nomePdf = $request->file('ficha_informativa')->getClientOriginalName();
                $nomePdf = time().'_'.$nomePdf;
                
                $guardarPdf = $request->file('ficha_informativa')->storeAs('pdf/modulos/',$nomePdf);

                $campos['ficha_informativa'] = $nomePdf;
            }
            
            $modulo->update($campos);
            
            
            
            return redirect()->route('modulos.show',[
                'id'=>$modulo->id_modulo
            ])->with('mensagem','Modulo editado com sucesso');
        }
        else{
            abort(404);
        }
    }

    public function delete(Request $request){
        if(Gate::allows('admin')){
            Modulo::findOrFail($request->id)->delete();  
            
            return redirect()->route('modulos.index')->with('mensagem','Modulo eliminado com sucesso');
        }
        else{
            abort(404);
        }
    }
}
