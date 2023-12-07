<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\RecuperarClaveController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route("home");
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* mis rutas */

//USUARIO
Route::get('usuario-index',[UsuarioController::class,'index'])->name('usuario.index')->middleware('verified');
Route::get('usuario-create',[UsuarioController::class,'create'])->name('usuario.create')->middleware('verified');
Route::post('usuario-store',[UsuarioController::class,'store'])->name('usuario.store')->middleware('verified');
Route::get('usuario-edit-{id}',[UsuarioController::class,'edit'])->name('usuario.edit')->middleware('verified');
Route::post('usuario-update',[UsuarioController::class,'update'])->name('usuario.update')->middleware('verified');
Route::get('usuario-destroy-{id}',[UsuarioController::class,'destroy'])->name('usuario.destroy')->middleware('verified');


//empresa
Route::get('empresa-index',[EmpresaController::class,'index'])->name('empresa.index')->middleware('verified');
Route::post('empresa-update-{id}',[EmpresaController::class,'update'])->name('empresa.update')->middleware('verified');

//ESPECIALIDAD
Route::get('especialidad-index',[EspecialidadController::class,'index'])->name('especialidad.index')->middleware('verified');
Route::get('especialidad-create',[EspecialidadController::class,'create'])->name('especialidad.create')->middleware('verified');
Route::post('especialidad-store',[EspecialidadController::class,'store'])->name('especialidad.store')->middleware('verified');
Route::get('especialidad-edit-{id}',[EspecialidadController::class,'edit'])->name('especialidad.edit')->middleware('verified');
Route::post('especialidad-update',[EspecialidadController::class,'update'])->name('especialidad.update')->middleware('verified');
Route::get('especialidad-destroy-{id}',[EspecialidadController::class,'destroy'])->name('especialidad.destroy')->middleware('verified');


//medico
Route::get('medico-index',[MedicoController::class,'index'])->name('medico.index')->middleware('verified');
Route::get('medico-create',[MedicoController::class,'create'])->name('medico.create')->middleware('verified');
Route::post('medico-store',[MedicoController::class,'store'])->name('medico.store')->middleware('verified');
Route::get('medico-edit-{id}',[MedicoController::class,'edit'])->name('medico.edit')->middleware('verified');
Route::post('medico-update',[MedicoController::class,'update'])->name('medico.update')->middleware('verified');
Route::get('medico-destroy-{id}',[MedicoController::class,'destroy'])->name('medico.destroy')->middleware('verified');

//paciente
Route::get('paciente-index',[PacienteController::class,'index'])->name('paciente.index')->middleware('verified');
Route::get('paciente-create',[PacienteController::class,'create'])->name('paciente.create')->middleware('verified');
Route::post('paciente-store',[PacienteController::class,'store'])->name('paciente.store')->middleware('verified');
Route::get('paciente-edit-{id}',[PacienteController::class,'edit'])->name('paciente.edit')->middleware('verified');
Route::post('paciente-update',[PacienteController::class,'update'])->name('paciente.update')->middleware('verified');
Route::get('paciente-destroy-{id}',[PacienteController::class,'destroy'])->name('paciente.destroy')->middleware('verified');


//cita
Route::get('cita-index',[CitaController::class,'index'])->name('cita.index')->middleware('verified');
Route::get('cita-create',[CitaController::class,'create'])->name('cita.create')->middleware('verified');
Route::post('cita-store',[CitaController::class,'store'])->name('cita.store')->middleware('verified');
Route::get('cita-edit-{id}-{id2}-{id3}-{id4}',[CitaController::class,'edit'])->name('cita.edit')->middleware('verified');
Route::post('cita-update',[CitaController::class,'update'])->name('cita.update')->middleware('verified');
Route::get('cita-destroy-{id}',[CitaController::class,'destroy'])->name('cita.destroy')->middleware('verified');

Route::get('cita-procesarCita-{id}',[CitaController::class,'procesarCita'])->name('cita.procesarCita')->middleware('verified');


/* cambiar clave usuario */
Route::get('cambiar-usuario',[UsuarioController::class,'cambiar'])->name('usuario.cambiar')->middleware('verified');
Route::post('cambiarClave-usuario',[UsuarioController::class,'cambiarClave'])->name('usuario.cambiarClave')->middleware('verified');

/* perfil de usuario */
Route::get('perfil-usuario',[UsuarioController::class,'perfil'])->name('usuario.perfil')->middleware('verified');
Route::post('cambiarPerfil-usuario',[UsuarioController::class,'cambiarPerfil'])->name('usuario.cambiarPerfil')->middleware('verified');

/* recuperar password */
Route::get("/recuperar-contraseña", [RecuperarClaveController::class, 'index'])->name("recuperar.index");
Route::post("/recuperar-contraseña-update", [RecuperarClaveController::class, 'update'])->name("recuperar.update");
Route::get("/nueva-contraseña-index-{id}", [RecuperarClaveController::class, 'nuevoClave'])->name("nuevo.clave");
Route::post("/nueva-contraseña-reset", [RecuperarClaveController::class, 'reset'])->name("reset.clave");
