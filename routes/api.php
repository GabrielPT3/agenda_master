<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/obtermodulos/disciplina/{uuiddisciplina}/turma/{uuidturma}', 'IndexController@obterModulos')->name('api.obtermodulos');
Route::get('/obterdisciplinas/curso/{idcurso}/user/{iduser}', 'IndexController@obterDisciplinas')->name('api.obterdisciplina');
Route::get('/obterturmas/curso/{idcurso}/disciplina/{uuiddisciplina}/user/{iduser}', 'IndexController@obterTurmas')->name('api.obterturma');
Route::get('/obteraulas/{idmodulo}/user/{iduser}','AlunosController@obterAulas')->name('api.obteraulas.modulo');


Route::get('/obteralunos/{idturma}','AlunosController@obterAlunos')->name('api.obteralunos');
Route::get('/obtermodulos/{iddisciplina}','AlunosController@obterModulos')->name('api.obtermodulos');
Route::get('/obternotas/{idmodulo}/aluno/{idaluno}/user/{iduser}','AlunosController@obterNotas')->name('api.obternotas');


Route::get('/obtercriterios/{uuiddisciplina}/user/{iduser}','AlunosController@obterCriterios')->name('api.obtercriterios');

Route::get('/darkmode/{darkmode}/user/{iduser}','UsersController@darkMode')->name('api.darkmode');


///////////////////////////////////////////////////////////////////////////DASHBOARD///////////////////////////////////////////////////////////////////////////////////


Route::get('/obterturma/{ano}/','AlunosController@obterTurmas')->name('api.obterturma.ano');

Route::get('/obteralunossemturma/','TurmasController@obteraAlunosSemTurma')->name('api.alunossemturma');

Route::get('/professorespordisciplina/{iddisciplina}','TurmasController@professoresPorDisciplina')->name('api.alunossemturma');

Route::get('/alunosporano/{anoletivo}','AlunosController@alunosPorAno')->name('api.alunosporano');

Route::get('/turmasporano/{anoletivo}','TurmasController@turmasPorAno')->name('api.turmasporano');

Route::get('/cursosporano/{anoletivo}','CursosController@cursosPorAno')->name('api.cursosporano');

Route::get('/modulospordisciplina/{disciplina}','ModulosController@modulosPorDisciplina')->name('api.modulospordisciplinas');

Route::get('/ultimomodulo/{disciplina}','ModulosController@ultimoModulo')->name('api.ultimomodulo');

Route::get('/usersaprovados','UsersController@usersAprovados')->name('api.usersaprovados');

Route::get('/userspendentes','UsersController@usersPendentes')->name('api.userspendentes');

Route::get('/users/{id}/aprovar', 'UsersController@aprovarUser')->name('users.aprovar');

Route::get('/users/{id}/recusar', 'UsersController@recusarUser')->name('users.recusar');
 