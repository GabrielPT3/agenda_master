<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnosLetivos;
use Illuminate\Support\Facades\Storage;
use Auth;
use Gate;

class AnosLetivosController extends Controller
{
    public function index(){
        if(Gate::allows('admin')){
            if(Auth::user()->tipo_user=="superadmin"){
                $anosLetivos = AnosLetivos::all();

                return view ('anosletivos.index',['anosLetivos'=>$anosLetivos]);
            }
            else{
                abort(403,'Não tem permissões para aceder a esta pagina!');
           }
        }
        else{
            abort(404);
        }
    }
    
    public function alterarAnoAtivo(Request $request){
        if(Auth::user()->tipo_user=="superadmin"){
            $ano = AnosLetivos::where('ativo',"sim")->first();
            if(!is_null($ano)){
                $campo['ativo'] = null;
                $ano->update($campo);
            }
            
            $ano = AnosLetivos::where('id_ano_letivo',$request->id)->first();    
            $campo['ativo'] = "sim";
            $ano->update($campo);
            
            return redirect()->route('anosletivos.index')->with('mensagem','Ano letivo ativo alterado com sucesso');
        }
        else{
            abort(404);
        }
   }
    
    public function create(Request $request){
        if(Auth::user()->tipo_user=="superadmin"){    
            $campos['ano'] = $request->ano;
            AnosLetivos::create($campos);
                
            return redirect()->route('anosletivos.index')->with('mensagem','Ano letivo criado com sucesso');
        }
        else{
            abort(404);
        } 
    }
}
