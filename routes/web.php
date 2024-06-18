<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ArchivosPaginaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\PaginaSeccionArchivoController;
use App\Http\Controllers\PaginaSeccionController;
use App\Http\Controllers\PaginaSubSeccionArchivoController;
use App\Http\Controllers\PaginaSubSeccionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\SubSeccionController;
use App\Http\Controllers\RepositorioController;
use Illuminate\Support\Facades\Session;
use App\Models\PaginaSeccion;
use Spatie\Activitylog\Models\Activity;

// Route::get('/', function () {
//     return view('welcome');
// })->name('inicio');

Route::get('/', [SeccionController::class,'bienvenida'])->name('inicio');


// Vista al dashboard ó tablero principal
Route::get('tablero', [HomeController::class, 'index'])->middleware('can:admin.dashboard')->name('dashboard');

/* Rutas para iniciar sesión y cerrar sesión */
Route::get('iniciar-sesion', [AutenticarController::class, 'credenciales'])->name('login');
Route::post('validar', [AutenticarController::class, 'autenticar'])->name('validar');
Route::get('salir', [AutenticarController::class, 'salida'])->name('salir');

Route::resource('roles', RoleController::class)->names('roles');

Route::get('pruebinguis', [PaginaSubSeccionArchivoController::class, 'pruebinguis'])->name('pruebinguis');
// Route::get('buscar-paginas', [RoleController::class, 'role'])

// Ruta con ajax para obtener toda la data de paginas con datatables
Route::get('roles-data', [RoleController::class, 'rolesDatatables'])->name('roles-data');

// Ruta tipo resource para usuarios
Route::resource('usuarios', UsuarioController::class)->names('usuarios');

// Ruta tipo resource para usuarios
Route::resource('users', UserController::class)->names('users');

// Ruta con ajax para obtener toda la data de usuarios con datatables
Route::get('usuarios-data', [UsuarioController::class, 'usersDatatables'])->name('usuarios-data');

// Ruta con ajax para obtener toda la data de usuarios con datatables
Route::get('users-data', [UserController::class, 'usersDatatables'])->name('users-data');

// Ruta tipo resource para menu
Route::resource('menus', MenuController::class)->names('menus');

// Ruta con ajax para obtener toda la data del menu con datatables
Route::get('menus-data', [MenuController::class, 'menusDatatables'])->name('menus-data');

// Ruta tipo resource para footer
Route::resource('footers', FooterController::class)->names('footers');
Route::get('footer', [FooterController::class, 'inicio'])->name('footer.inicio');

// Ruta con ajax para obtener toda la data del footer con datatables
Route::get('footers-data', [FooterController::class, 'footersDataTables'])->name('footers-data');

// Ruta con AJAX para ver si un slug de menú está disponible ó no
Route::post('slug-check', [MenuController::class, 'check'])->name('menu.register-check');

// Ruta resource para las páginas
Route::resource('paginas', PaginaController::class)->names('paginas');
// Ruta para el listado de páginas que tiene asignadas un empleado
Route::get('listado-paginas',[PaginaController::class, 'paginasEmpleados'])->name('paginas.paginas-empleados');



// Ruta con ajax para obtener toda la data de archivos de una página con datatables
Route::get('paginas-data-archivos', [ArchivosPaginaController::class, 'paginasArchivosDatatables'])->name('paginas-data-archivos');

// Ruta con AJAX para encontrar archivos dentro con base a una poágina en especifica
Route::get('paginas-archivos-check', [ArchivosPaginaController::class, 'check'])->name('paginas-archivos.paginas-archivos-check');

// Ruta resource secion de inicio (welcome)
Route::resource('seccion-inicio', SeccionController::class)->names('seccion-inicio');

// Ruta con ajax para obtener toda la data de usuarios con datatables
Route::get('seccion-inicio-data', [SeccionController::class, 'seccionesDatatables'])->name('seccion-inicio-data');

//Ruta resource para las subsecciones que tenga una seccion de inicio
Route::resource('subseccion', SubSeccionController::class)->names('subseccion');

// Ruta resource para las actividades de los logs
Route::resource('activity-logs', ActivityLogController::class)->names('activity-logs');

// Ruta con ajax para obtener toda la data de archivos de una activitylogs con datatables
Route::get('activity-logs-data', [ActivityLogController::class, 'activityLogsDatatables'])->name('activity-logs-data');

Route::get('prueba', function() {
   // session()->flush();
   // Session::forget('paginaSeccionSelectedSlug');
   // Session::forget('paginaSeccionSelectedId');
   // Session::forget('pgSecParaSubId');
   // Session::forget('paginaSelectedSlug');
   // Session::forget('paginaSelectedId');
   // Session::forget('pgId');
   // Session::forget('paginaSubSeccionSelectedSlug');
   // Session::forget('paginaSubSeccionSelectedId');
   // Session::forget('pagSecSubArchId');
   //Session::forget('menuSelectId');
   dd(session()->all());
   // $test = PaginaSeccion::with('paginasSeccionesArchivos','paginasSeccionesSubsecciones')->get();
   // dd($test);
   // return Activity::all();
   // return Activity::orderBy('id','desc')->get();
   });

// Ruta con ajax para obtener toda las secciones de paginas con datatables
Route::get('paginas-subsecciones-archivos-data', [PaginaSubSeccionArchivoController::class, 'paginasSubSeccionesArchivosDatatables'])->name('paginas-subsecciones-archivos-data');

// Ruta con ajax para obtener toda las secciones de paginas con datatables
Route::get('paginas-subsecciones-data', [PaginaSubSeccionController::class, 'paginasSubSeccionesDatatables'])->name('paginas-subsecciones-data');

// Ruta con ajax para obtener toda las secciones de paginas con datatables
// Route::get('paginas-secciones-data', [PaginaSeccionController::class, 'paginasSeccionesDatatables'])->name('paginas-secciones-data');

Route::post('menuSessionSelectId', [PaginaController::class, 'menuSessionSelectId'])->name('menuSessionSelectId');

// Ruta con ajax para obtener toda las secciones de paginas con datatables
// Route::get('paginas-secciones-archivos-data', [PaginaSeccionArchivoController::class, 'paginasSeccionesArchivosDatatables'])->name('paginas-secciones-archivos-data');

// Ruta resource para el repositorio de archivos
Route::resource('repositorio', RepositorioController::class)->names('repositorios');

// Ruta con ajax para obtener toda la data de paginas con datatables
Route::get('repositorios-data', [RepositorioController::class, 'repositoriosDatatables'])->name('repositorios-data');

// Ruta con ajax para obtener toda la data de paginas con datatables
Route::get('paginas-data', [PaginaController::class, 'paginasDatatables'])->name('paginas-data');

// Ruta get para visualziar las páginas
Route::get('{pagina?}', [PaginaController::class, 'tipoPagina'])->name('pagina');

// Ruta para subir imagen
Route::post('image/upload', [PaginaController::class, 'upload'])->name('image.upload');

// Ruta para mostrar la vista principal de archivos de una página
Route::get('paginas/{pagina}/archivos',[ArchivosPaginaController::class, 'index'])->name('paginas.archivos');


// Ruta resource para el CRUD de archivos
Route::resource('archivos', ArchivosPaginaController::class)->names('paginas-archivos');


// ruta para crear archivos de paginas
Route::get('archivos/create/{pagina}/archivo', [ArchivosPaginaController::class, 'create'])->name('paginas-archivos.create');

// Ruta para ajax - buscar un paginas con select2 
// Route::get('pagina-search', [RoleController::class, 'paginaSearch'])->name('paginas.paginaSearch');

//Ruta resource para las secciones de una pagina
Route::resource('pagina-seccion', PaginaSeccionController::class)->names('paginas.pagina-seccion');

//------------INICIO RUTA RESOURCE PARA CRUD DE SECCIONES------------------
// Ruta index para la sección de una página
Route::get('paginas/{pagina}/seccion', [PaginaSeccionController::class, 'index'])->name('paginas.pagina-seccion-index');

// Ruta create para la sección de una página
Route::get('paginas/{pagina}/seccion/create', [PaginaSeccionController::class, 'create'])->name('paginas.pagina-seccion-create');

// Ruta store para sección de una página
Route::post('paginas/{pagina}/seccion/store', [PaginaSeccionController::class, 'store'])->name('paginas.pagina-seccion-store');

// Ruta edit para la sección de una página 
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/edit', [PaginaSeccionController::class, 'edit'])->name('paginas.pagina-seccion-edit');

// Ruta update para la sección de una página 
Route::put('paginas/{pagina}/seccion/{paginaSeccion}/update', [PaginaSeccionController::class, 'update'])->name('paginas.pagina-seccion-update');

// Ruta delete para la sección de una página 
Route::delete('paginas/{pagina}/seccion/{paginaSeccion}/delete', [PaginaSeccionController::class, 'destroy'])->name('paginas.pagina-seccion-destroy');
//------------FIN RUTA RESOURCE PARA CRUD DE SECCIONES------------------


//------------INICIO RUTA RESOURCE PARA CRUD DE ARCHIVOS SECCIONES------------------
// Ruta index para los archivos de una sección de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/archivos', [PaginaSeccionArchivoController::class, 'index'])->name('paginas.seccion-archivos-index');

// Ruta create para los archivos de una sección de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/archivos/create', [PaginaSeccionArchivoController::class, 'create'])->name('paginas.seccion-archivos-create');

// Ruta store para los archivos de una sección de página
Route::post('paginas/{pagina}/seccion/{paginaSeccion}/archivos/store', [PaginaSeccionArchivoController::class, 'store'])->name('paginas.seccion-archivos-store');

// Ruta create para los archivos de una sección de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/archivos/{paginaSeccionArchivo}/edit', [PaginaSeccionArchivoController::class, 'edit'])->name('paginas.seccion-archivos-edit');

Route::put('paginas/{pagina}/seccion/{paginaSeccion}/archivos/{paginaSeccionArchivo}/update', [PaginaSeccionArchivoController::class, 'update'])->name('paginas.seccion-archivos-update');

Route::delete('paginas/{pagina}/seccion/{paginaSeccion}/archivos/{paginaSeccionArchivo}/delete',[PaginaSeccionArchivoController::class, 'destroy'])->name('paginas.seccion-archivos-destroy');
//------------FIN RUTA RESOURCE PARA CRUD DE ARCHIVOS SECCIONES------------------


//------------INICIO RUTA RESOURCE PARA CRUD DE SUBSECCIONES------------------

// Ruta index para las subsecciones de una sección de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/subseccion', [PaginaSubSeccionController::class, 'index'])->name('paginas.pagina-subseccion-index');

// Ruta create para las subsecciones de una sección de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/create', [PaginaSubSeccionController::class, 'create'])->name('paginas.pagina-subseccion-create');

// Ruta store para guardar una subseccion de una seccion de página
Route::post('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/store', [PaginaSubSeccionController::class, 'store'])->name('paginas.pagina-subseccion-store');

// Ruta edit para mostrar la vista de una subseccion de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/edit', [PaginaSubSeccionController::class, 'edit'])->name('paginas.pagina-subseccion-edit');

// Ruta update para actualizar una subseccionn de una seccion de página
Route::put('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/updated', [PaginaSubSeccionController::class, 'update'])->name('paginas.pagina-subseccion-update');

Route::delete('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/destroy', [PaginaSubSeccionController::class, 'destroy'])->name('paginas.pagina-subseccion-destroy');

//------------FIN RUTA RESOURCE PARA CRUD DE SUBSECCIONES------------------


//------------INICIO RUTA RESOURCE PARA CRUD DE ARCHIVOS DE SUBSECCIONES------------------

// Ruta index para archivos de una subsección de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/archivos', [PaginaSubSeccionArchivoController::class, 'index'])->name('paginas.subseccion-archivos-index');

// Ruta create para archivos de una subsección de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/archivos/create', [PaginaSubSeccionArchivoController::class, 'create'])->name('paginas.subseccion-archivos-create');

// Ruta store para archivos de una subsección de página
Route::post('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/archivos/store', [PaginaSubSeccionArchivoController::class, 'store'])->name('paginas.subseccion-archivos-store');

// Ruta edit para archivos de una subseccion de página
Route::get('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/archivos/{pagina_subseccion_archivo}/edit', [PaginaSubSeccionArchivoController::class, 'edit'])->name('paginas.subseccion-archivos-edit');

Route::put('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/archivos/{pagina_subseccion_archivo}/update', [PaginaSubSeccionArchivoController::class, 'update'])->name('paginas.subseccion-archivos-update');

Route::delete('paginas/{pagina}/seccion/{paginaSeccion}/subseccion/{pagina_subseccion}/archivos/{pagina_subseccion_archivo}/destroy', [PaginaSubSeccionArchivoController::class, 'destroy'])->name('paginas.subseccion-archivos-destroy');

//------------fin RUTA RESOURCE PARA CRUD DE ARCHIVOS DE SUBSECCIONES------------------


// Ruta resource para crear archivos de una subseccion de una sección para una página
Route::resource('pagina-subseccion-archivos', PaginaSubSeccionArchivoController::class)->names('paginas.pagina-subseccion-archivos');

// Ruta para mostrar la vista index/listado de secciones de una página
// Route::get('seccion/{seccion}/subseccion/{paginaSubSeccion}/archivos', [PaginaSubSeccionArchivoController::class, 'index'])->name('paginas.pagina-subseccion-archivos-index');

// Ruta para mostrar la vista index/listado de secciones de una página
// Route::get('seccion/{seccion}/subseccion/{paginaSubSeccion}/archivos/create', [PaginaSubSeccionArchivoController::class, 'create'])->name('paginas.pagina-subseccion-archivos-create');

// Route::get('mneh', [PaginaSubSeccionArchivoController::class, 'mneh']);

