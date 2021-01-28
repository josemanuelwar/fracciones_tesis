<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//ruta del home para el profesor
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//ruta del registrar alumnos
Route::get('/alumnos', [App\Http\Controllers\HomeController::class, 'registroAlumnos'])->name('Alumnos');
//ingresa a la base de datos
Route::post('/registroalum', [App\Http\Controllers\HomeController::class, 'GusrdarAlumno'])->name('Agregar');
//temarios
Route::get('/AgregarTema', [App\Http\Controllers\HomeController::class, 'Agregartemarios'])->name('temas');
//preguntas
Route::get('/Agregarpreguntas', [App\Http\Controllers\HomeController::class, 'preguntas'])->name('temas1');
//retornamos la vista del formulario para cargar el archivo exel
Route::get('/importar-excel',[App\Http\Controllers\HomeController::class, 'FormulariocargarExel'])->name('Cargr-exel');
//ruta para importar el exel
Route::post('/importar-excel',[App\Http\Controllers\HomeController::class, 'ImportarExel'])->name('importar-excel');
//ruta para mostra la lista de alumnos al profesor
Route::get('/Lista-alumno',[App\Http\Controllers\HomeController::class, 'ListaUsuarios'])->name('ListaAlum');
//ruta para cargar el formulario para editar 
Route::get('/EditarAulm/{id}',[App\Http\Controllers\HomeController::class, 'editarview'])->name('EditarAlum');
Route::post('/Actulizar',[App\Http\Controllers\HomeController::class, 'editarAlumnos'])->name("actulizar_alumnos");
//rutas para vue
Route::get('/lista',[App\Http\Controllers\HomeController::class, 'ListaGardosVue']);
Route::get('/listaTemas',[App\Http\Controllers\HomeController::class, 'verListatemas']);
Route::post('/guardarTemas',[App\Http\Controllers\HomeController::class, 'guardarTemas']);
Route::get('/listatemasgrado/{id}',[App\Http\Controllers\HomeController::class, 'ListaTemas']);
Route::post('/EditarTema',[App\Http\Controllers\HomeController::class,'EditarTema']);
Route::post('/GuardarPreguntas',[App\Http\Controllers\HomeController::class,'GuardarPreguntas']);
Route::get('/RegisrarEscuela', [App\Http\Controllers\ProfesorController::class, 'index'])->name('Escuela');
Route::post('/GuardarEscuela', [App\Http\Controllers\ProfesorController::class, 'GaudarEscuela'])->name('guardar_escuela');
Route::get('/listaEscuela',[App\Http\Controllers\ProfesorController::class, 'ListaEscuela'])->name('listaEscuela');
Route::get('/AsignarEscuela/{id}',[App\Http\Controllers\ProfesorController::class, 'AsignacionEscuela'])->name('listaEscuela');
Route::get('/GetEscuela/{id}',[App\Http\Controllers\ProfesorController::class, 'getEscuela'])->name('UnaEscuela');
Route::post('/UpdateEscuela',[App\Http\Controllers\ProfesorController::class, 'UpdateEscuela'])->name('updateEscuela');
/**cargamos la vista para registrar la materia */
Route::get('/agregarmaterisa',[App\Http\Controllers\ProfesorController::class,'Matreria'])->name('Materia');
/**guardamos la materia */
Route::post('/guardarmateria',[App\Http\Controllers\ProfesorController::class,'GuardarMateria'])->name('GuardarMateria');
/** retornamos la lista de materias  */
Route::get('/listamateria',[App\Http\Controllers\ProfesorController::class,'ListaMaterias'])->name('ListaMaterias');