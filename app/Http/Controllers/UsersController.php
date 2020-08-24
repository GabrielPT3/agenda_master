<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disciplina;
use App\User;
use App\DisciplinaUser;
use Auth;
use Gate;
use Hash;
use App\CursoUser;
use App\Curso;

class UsersController extends Controller
{
    public function recuperarPassword(){
        if(Auth::check()){
            return redirect()->route('index');
        }
        else{
            return view('users.recuperarPassword');
        }
    }

    public function storePassword(Request $request){
        $atual = $request->atual;
        $nova = $request->nova;
        $confirmarNova = $request->confirmarnova;
        
        if (Hash::check($atual, Auth::user()->password))
        {
            if($atual == $nova || $atual == $confirmarNova){
                return back()->with('mensagem','A password atual é igual à nova.');
            }
            if($nova == $confirmarNova && strlen($nova)>=8){
                $user = User::where('id',Auth::user()->id)->first();
                $campo['password'] = bcrypt($nova);
                $user->update($campo); 
                return redirect()->route('index')->with('mensagem','Password alterada com sucesso.');
            }
            else{
                return back()->with('mensagem','As passwords nao coincidem ou não é superior a 8 carateres.');
            }
        }
        else{
            return back()->with('mensagem','A password atual nao coincide.');;
        }
        
    }
    public function mudarPassword(){

        return view('users.mudarPassword');
    }

    public function profile(){
        //$pwd=bcryp('JJJJJ');
        $idUser = Auth::user()->id;
        //dd($idUser);

        $disciplinasUsers = Disciplina::whereHas('users',function ($q) use ($idUser){
            $q->where('users.id',$idUser);
        })->get('id_disciplina');

        $disciplinasUsers = $disciplinasUsers->pluck('id_disciplina')->toArray();
        
        //dd($disciplinasUsers);
        
        $disciplinas = Disciplina::wherein('id_disciplina',$disciplinasUsers)->get();
        
        //dd($disciplinas);
            
        return view('users.profile',[
            'disciplinas'=>$disciplinas
        ]);
    }

    public function darkMode(Request $request){
        $darkMode = $request->darkmode;
        $idUser = $request->iduser;
        $user = User::findOrFail($idUser);
        if($darkMode=='s'){
            $campo['dark_mode'] = 'n';
        }
        else{
            $campo['dark_mode'] = 's';
        }

        $user->update($campo);

        return response()->json();
    }
    
    public function index(){
        if(Gate::allows('admin')){
            return view('users.index');
        }
        else{
            abort(404);
        }
    }

    public function usersAprovados(){
        $users = User::where('id','>','0')->where('tipo_user','!=','pendente')->where('tipo_user','!=','superadmin')->orderBy('tipo_user','asc')->paginate(10);

        return response()->json($users);
    }

    public function usersPendentes(){
        $users = User::where('id','>','0')->where('tipo_user','pendente')->where('tipo_user','!=','superadmin')->orderBy('tipo_user','asc')->get();

        return response()->json($users);
    }

    public function aprovarUser(Request $request){
        $user = User::findOrFail($request->id);
        $campo['tipo_user'] = "professor";
        $user->update($campo);

        return response()->json();
    }

    public function recusarUser(Request $request){
        User::findOrFail($request->id)->delete();

        return response()->json();
    }
    
    public function show(Request $request){
        $user = User::where('id',$request->id)->first();
        
        if(Gate::allows('admin') && $user->tipo_user!="superadmin" && $user->tipo_user!="pendente" && $user->id>0){
            $disciplinasProf = DisciplinaUser::where('id_user',$request->id)->get()->pluck('id_disciplina');
            $disciplinas = Disciplina::whereNotIn('id_disciplina',$disciplinasProf)->orderBy("designacao")->get();
            $disciplinasProf = Disciplina::whereIn('id_disciplina',$disciplinasProf)->get();

            $cursosProf = CursoUser::where('id_user',$request->id)->get()->pluck('id_curso');
            $cursos = Curso::whereNotIn('id_curso', $cursosProf)->orderBy("designacao")->get();
            $cursosProf = Curso::whereIn('id_curso', $cursosProf)->get();

            return view('users.show',[
                'user'=>$user,
                'disciplinas'=>$disciplinas,
                'disciplinasProf'=>$disciplinasProf,
                'cursos' => $cursos,
                'cursosProf' => $cursosProf,
            ]);
        }
        else{
            abort(404);
        }
    }
    
    public function alterarTipo(Request $request){
        if(Gate::allows('admin') && $request->tipo!="superadmin" && $request->id>0){
            
            $user = User::where('id',$request->id)->first();
            $campo['tipo_user'] = $request->tipo;
            $user->update($campo);
            
            return redirect()->route('users.show',[
                'id'=>$user->id
            ])->with('mensagem','Utilizador editado com sucesso');
        }
        else{
            abort(404);
        }
    }
    
    public function adicionarDisciplina(Request $request){
        if(Gate::allows('admin') && $request->id>0){
            
            $campos['id_user'] = $request->id;
            $campos['id_disciplina'] = $request->idDisciplina;
            DisciplinaUser::create($campos);
            
            return redirect()->route('users.show',[
                'id'=>$request->id
            ])->with('mensagem','Utilizador editado com sucesso');
        }
        else{
            abort(404);
        }
    }
    
    public function removerDisciplina(Request $request){
        if(Gate::allows('admin') && $request->id>0){
            
            DisciplinaUser::where('id_user',$request->id)->where('id_disciplina',$request->idDisciplina)->delete();
            
            return redirect()->route('users.show',[
                'id'=>$request->id
            ])->with('mensagem','Utilizador editado com sucesso');
        }
        else{
            abort(404);
        }
    }

    public function adicionarCurso(Request $request){
        if(Gate::allows('admin') && $request->id>0){
            
            $campos['id_user'] = $request->id;
            $campos['id_curso'] = $request->idCurso;
            CursoUser::create($campos);
            
            return redirect()->route('users.show',[
                'id'=>$request->id
            ])->with('mensagem','Utilizador editado com sucesso');
        }
        else{
            abort(404);
        }
    }

    public function removerCurso(Request $request){
        if(Gate::allows('admin') && $request->id>0){
            
            CursoUser::where('id_user',$request->id)->where('id_curso',$request->idCurso)->delete();
            
            return redirect()->route('users.show',[
                'id'=>$request->id
            ])->with('mensagem','Utilizador editado com sucesso');
        }
        else{
            abort(404);
        }
    }
    
    public function delete(Request $request){
        if(Gate::allows('admin')){
            User::findOrFail($request->id)->delete();  
            
            return redirect()->route('users.index')->with('mensagem','Utilizador eliminado com sucesso');
        }
        else{
            abort(404);
        }
    }
}
