<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Disciplina;
use App\AnosLetivos;
use Illuminate\Support\Facades\Storage;
use Auth;
use Gate;

class CursosController extends Controller
{
    public function testes(){
        if (AnosLetivos::where('ativo','sim')->get()->isEmpty()) {
            $alerta = "Percisa primeiro de um ano letivo ativo!";

            return $alerta;            
        }
    }

    public function index(){
        if ($this->testes() != false) {
            return redirect()->route('index')->with('alerta',$this->testes());
        }
        
        if(Gate::allows('admin')){
            $cursos = Curso::paginate(5);
            $anosLetivos = AnosLetivos::orderBy('ano','desc')->get();

            return view('cursos.index',['cursos'=>$cursos, 'anosLetivos'=>$anosLetivos]);
        }
        else{
            abort(404);
       }

    }
    
    public function cursosPorAno(Request $request){
        $anoletivo = $request->anoletivo;
        
        $cursos = Curso::where('id_ano_letivo',$anoletivo)->get();
        //dd($cursos);
        
        return response()->json($cursos);
        
    }
    
    public function show(Request $request){
        if(Gate::allows('admin')){
            $curso = Curso::findOrFail($request->id);

            return view('cursos.show',[
               'curso'=>$curso
            ]);
        }
        else{
            abort(404);
       }
    }
    

    public function create(Request $request){
        if(Gate::allows('admin')){
            return view('cursos.create'); 
        }
        else{
            abort(404);
       }   
    }
    
    public function store(Request $request){
        if(Gate::allows('admin')){
            $curso = $request->validate ([
                'nome'=>['required','min:2','max:50'],
                'designacao'=>['required','min:5','max:50'],
                'ficha_informativa'=>['nullable','file','mimes:pdf'],
            ],
            [
                'nome.required' => 'Percisa de introduzir um nome!',
                'nome.max' => 'Nome muito longo! (Max:50)',
                'nome.min' => 'Nome muito curto! (Min:2)',
                'designacao.required' => 'Percisa de introduzir uma designação!',
                'designacao.min' => 'Designação muito curta! (Min:5)',
                'designacao.max' => 'Designação muito longa! (Max:50)',
            ]);
            
            if($request->hasFile('ficha_informativa')){
                $nomePdf = $request->file('ficha_informativa')->getClientOriginalName();
                $nomePdf = time().'_'.$nomePdf;
                
                $guardarPdf = $request->file('ficha_informativa')->storeAs('pdf/cursos/',$nomePdf);

                $curso['ficha_informativa'] = $nomePdf;
            }
            
            $anoLetivo = AnosLetivos::where('ativo', "sim")->get();
            $anoLetivo = $anoLetivo->pluck('id_ano_letivo')->toArray();
            
            $curso['id_ano_letivo'] = $anoLetivo[0];
            
            $novocurso = Curso::create($curso);

            
            return redirect()->route('cursos.show',[
                'id'=>$novocurso->id_curso
            ])->with('mensagem','Curso Criado com sucesso');
        }
        else{
            abort(404);
        } 
    }


    public function edit(Request $request){
        if(Gate::allows('admin')){
            $curso = Curso::findOrFail($request->id);

            return view('cursos.edit',[
                'curso'=>$curso
            ]); 
        }
        else{
            abort(404);
        }


    }
    
    public function update(Request $request){
        if(Gate::allows('admin')){
            $curso = Curso::findOrFail($request->id);
            $campos = $request->validate ([
                'nome'=>['required','min:2','max:50'],
                'designacao'=>['required','min:5','max:50'],
                'ficha_informativa'=>['nullable','file','mimes:pdf'],
            ],
            [
                'nome.required' => 'Percisa de introduzir um nome!',
                'nome.max' => 'Nome muito longo! (Max:50)',
                'nome.min' => 'Nome muito curto! (Min:2)',
                'designacao.required' => 'Percisa de introduzir um designação!',
                'designacao.min' => 'Designação muito curta! (Min:5)',
                'designacao.max' => 'Designação muito longa! (Max:50)',
            ]);
            
            if($request->hasFile('ficha_informativa')){
                $nomePdfAntiga =  $curso->ficha_informativa;
            
                if(!is_null($nomePdfAntiga)){
                    $eliminarPdf = Storage::delete('pdf/cursos/'.$nomePdfAntiga);
                }
                
                $nomePdf = $request->file('ficha_informativa')->getClientOriginalName();
                $nomePdf = time().'_'.$nomePdf;
                
                $guardarPdf = $request->file('ficha_informativa')->storeAs('pdf/cursos/',$nomePdf);

                $campos['ficha_informativa'] = $nomePdf;
            }
            
            $curso->update($campos);
            
            
            
            return redirect()->route('cursos.show',[
                'id'=>$curso->id_curso
            ])->with('mensagem','Curso editado com sucesso');
        }
        else{
            abort(404);
        }
    }
    
    public function delete(Request $request){
        if(Gate::allows('admin')){
            $curso = Curso::findOrFail($request->id);
            
            $nomePdf =  $curso->ficha_informativa;
            
            if(!is_null($nomePdf)){
                    $eliminarPdf = Storage::delete('pdf/cursos/'.$nomePdf);
                }
            
            Curso::findOrFail($request->id)->delete();
            
            return redirect()->route('cursos.index')->with('mensagem','Curso Eliminado com sucesso');
        }
        else{
            abort(404);
        }

    }
    

}
