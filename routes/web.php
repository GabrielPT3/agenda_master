<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('index');

Route::get('/registos/show/turma/{uuidturma}/modulo/{uuidmodulo}/aula/{uuidaula}', 'AlunosController@registosIndex')->name('registos.index');
Route::get('/registos/{uuid}/show/{uuidturma}/{uuidmodulo}/{uuidaula}', 'AlunosController@registosShow')->name('registos.show');
Route::get('/registos/avaliar/{uuiddisciplina}/turma/{uuidturma}/modulo/{uuidmodulo}', 'AlunosController@registosAvaliar')->name('registos.avaliar');
Route::get('/registos/aula/{uuiddisciplina}/modulo/{uuidmodulo}', 'AlunosController@registosAula')->name('registos.aula');
Route::post('/registos/store/aula/{uuiddisciplina}/modulo/{uuidmodulo}/turma/{uuidturma}', 'AlunosController@registosAulaStore')->name('registosaula.store');
Route::get('/registos/edit/aula/{uuidaula}', 'AlunosController@registosAulaEdit')->name('registosaula.edit');
Route::post('/registos/update/aula/{uuidaula}', 'AlunosController@registosAulaUpdate')->name('registosaula.update');
Route::get('/registos/aula/{uuidaula}/modulo/{uuidmodulo}/aluno/{uuidaluno}', 'AlunosController@registosAvaliarAula')->name('registos.avaliacao');
Route::post('/registos/avaliacao/aula', 'AlunosController@registosAvaliacaoAula')->name('registos.avaliacaoaula');
Route::get('/registos/turmas/alunos', 'AlunosController@registosAlunos')->name('registos.alunos');
Route::get('/registos/aluno/{uuidaluno}/modulos', 'AlunosController@registosModulosAluno')->name('registosaluno.modulos');
Route::get('/registos/criterios/disciplinas', 'AlunosController@registosCriterios')->name('registos.criterios');
Route::get('/registos/falta/aluno/{uuidaluno}/aula/{uuidaula}', 'AlunosController@registosFaltas')->name('registos.faltas');
Route::get('/registos/removerfalta/falta/{idfalta}', 'AlunosController@registosRemoverFaltas')->name('registosremover.faltas');
Route::delete('/registos/criterios/{idcriterio}/delete', 'AlunosController@criteriosDelete')->name('registoscriterios.delete');
Route::post('/registos/criterios/editar', 'AlunosController@criteriosEditar')->name('registoscriterios.editar');
Route::post('/registos/criterios/adicionar', 'AlunosController@criteriosAdicionar')->name('registoscriterios.adicionar');
Route::post('/registos/transferir/pdf', 'AlunosController@transferirPdf')->name('registos.pdf');
Route::post('/registos/transferir/pdf/turma', 'AlunosController@transferirPdfTurma')->name('registos.pdf.turma');

Route::get('/cursos', 'CursosController@index')->name('cursos.index');
Route::get('/cursos/{id}/show', 'CursosController@show')->name('cursos.show');
Route::get('/cursos/create', 'CursosController@create')->name('cursos.create')->middleware('auth');
Route::post('/cursos', 'CursosController@store')->name('cursos.store')->middleware('auth');
Route::get('/cursos/{id}/edit', 'CursosController@edit')->name('cursos.edit')->middleware('auth');
Route::patch('/cursos/{id}', 'CursosController@update')->name('cursos.update')->middleware('auth');
Route::delete('/cursos/{id}/delete', 'CursosController@delete')->name('cursos.delete')->middleware('auth');

Route::get('/alunos', 'AlunosController@index')->name('alunos.index');
Route::get('/alunos/{id}/show', 'AlunosController@show')->name('alunos.show');
Route::get('/alunos/create', 'AlunosController@create')->name('alunos.create')->middleware('auth');
Route::post('/alunos', 'AlunosController@store')->name('alunos.store')->middleware('auth');
Route::get('/alunos/{id}/edit', 'AlunosController@edit')->name('alunos.edit')->middleware('auth');
Route::patch('/alunos/{id}', 'AlunosController@update')->name('alunos.update')->middleware('auth');
Route::delete('/alunos/{id}/delete', 'AlunosController@delete')->name('alunos.delete')->middleware('auth');

Route::get('/turmas', 'TurmasController@index')->name('turmas.index');
Route::get('/turmas/{id}/show', 'TurmasController@show')->name('turmas.show');
Route::get('/turmas/{idTurma}/show/adicionar/{idAluno}', 'TurmasController@adicionarAluno')->name('turmas.adicionar')->middleware('auth');
Route::get('/turmas/{idTurma}/show/remover/{idAluno}', 'TurmasController@removerAluno')->name('turmas.removerAluno')->middleware('auth');
Route::get('/turmas/{idTurma}/show/editar/{idProfessor}/{idDisciplina}', 'TurmasController@editarProfessor')->name('turmas.editarProf')->middleware('auth');
Route::get('/turmas/create', 'TurmasController@create')->name('turmas.create')->middleware('auth');
Route::post('/turmas', 'TurmasController@store')->name('turmas.store')->middleware('auth');
Route::get('/turmas/{id}/edit', 'TurmasController@edit')->name('turmas.edit')->middleware('auth');
Route::patch('/turmas/{id}', 'TurmasController@update')->name('turmas.update')->middleware('auth');
Route::delete('/turmas/{id}/delete', 'TurmasController@delete')->name('turmas.delete')->middleware('auth');

Route::get('/disciplinas', 'DisciplinasController@index')->name('disciplinas.index');
Route::get('/disciplinas/{id}/show', 'DisciplinasController@show')->name('disciplinas.show');
Route::get('/disciplinas/{idDisciplina}/show/adicionar/{idTurma}', 'DisciplinasController@adicionarTurma')->name('disciplinas.adicionarturma');
Route::get('/disciplinas/{idDisciplina}/show/remover/{idTurma}', 'DisciplinasController@removerTurma')->name('disciplinas.removerturma');
Route::get('/disciplinas/create', 'DisciplinasController@create')->name('disciplinas.create')->middleware('auth');
Route::post('/disciplinas', 'DisciplinasController@store')->name('disciplinas.store')->middleware('auth');
Route::get('/disciplinas/{id}/edit', 'DisciplinasController@edit')->name('disciplinas.edit')->middleware('auth');
Route::patch('/disciplinas/{id}', 'DisciplinasController@update')->name('disciplinas.update')->middleware('auth');
Route::delete('/disciplinas/{id}/delete', 'DisciplinasController@delete')->name('disciplinas.delete')->middleware('auth');

Route::get('/modulos', 'ModulosController@index')->name('modulos.index');
Route::get('/modulos/{id}/show', 'ModulosController@show')->name('modulos.show');
Route::get('/modulos/create', 'ModulosController@create')->name('modulos.create')->middleware('auth');
Route::post('/modulos', 'ModulosController@store')->name('modulos.store')->middleware('auth');
Route::get('/modulos/{id}/edit', 'ModulosController@edit')->name('modulos.edit')->middleware('auth');
Route::patch('/modulos/{id}', 'ModulosController@update')->name('modulos.update')->middleware('auth');
Route::delete('/modulos/{id}/delete', 'ModulosController@delete')->name('modulos.delete')->middleware('auth');

Route::get('/contactos', 'ContactosController@index')->name('contactos.index');
Route::post('/contactos/enviar', 'ContactosController@enviar')->name('contactos.enviar')->middleware('auth');
Route::get('/contactos/email')->name('contactos.email')->middleware('auth');

Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/{id}/show', 'UsersController@show')->name('users.show');
Route::get('/users/{id}/show/tipo', 'UsersController@alterarTipo')->name('users.tipo');
Route::delete('/users/{id}/show/delete', 'UsersController@delete')->name('users.delete');
Route::get('/users/{id}/show/{idDisciplina}/adicionardisciplina', 'UsersController@adicionarDisciplina')->name('users.adicionardisciplina');
Route::delete('/users/{id}/show/{idDisciplina}/removerdisciplina', 'UsersController@removerDisciplina')->name('users.removerdisciplina');
Route::get('/users/{id}/show/{idCurso}/adicionarcurso', 'UsersController@adicionarCurso')->name('users.adicionarcurso');
Route::delete('/users/{id}/show/{idCurso}/removercurso', 'UsersController@removerCurso')->name('users.removercurso');
Route::get('/perfil', 'UsersController@profile')->name('perfil');
Route::get('/perfil/mudar/password', 'UsersController@mudarPassword')->name('perfil.mudarpassword');
Route::post('/perfil/mudar/password/professor', 'UsersController@storePassword')->name('perfil.storepassword');

Route::get('/anosletivos', 'AnosLetivosController@index')->name('anosletivos.index');
Route::get('/anosletivos/{id}/alteraranoativo', 'AnosLetivosController@alterarAnoAtivo')->name('anosletivos.alterarativo');
Route::post('/anosletivos/', 'AnosLetivosController@create')->name('anosletivos.create');


// Esqueci-me da password //

Route::get('/recuperar/password', 'UsersController@recuperarPassword')->name('recuperar.password');
Route::post('/recuperar/password/email', 'ContactosController@recuperarPassword')->name('contactos.recuperarpassword');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
