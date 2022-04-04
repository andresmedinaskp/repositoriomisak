<?php

use App\Http\Controllers\API\AreaController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EditorialController;
use App\Http\Controllers\API\Educational_LevelController;
use App\Http\Controllers\API\Type_MaterialController;
use App\Http\Controllers\API\RolController;
use App\Http\Controllers\API\Author_MaterialController;
use App\Http\Controllers\API\MaterialController;
use App\Http\Controllers\API\Material_UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Rutas de areas
Route::get('areas',[AreaController::class,'index']); // con esta ruta puedo ver todas la areas
Route::post('areas',[AreaController::class,'store']); //con esta ruta puedo registrar una nueva area
Route::get('areas/{area}',[AreaController::class,'show']); // con esta ruta puedo buscar un area especifica
Route::put('areas/{area}',[AreaController::class,'update']); // con esta ruta puedo actualizar un area
Route::delete('areas/{area}',[AreaController::class,'destroy']); // con esta ruta puedo eliminar un area

//rutas de author
Route::get('authors',[AuthorController::class,'index']); // con esta ruta puedo ver todos los autores  
Route::post('authors',[AuthorController::class,'store']); //con esta ruta puedo registrar una nuevo autor
Route::get('authors/{author}',[AuthorController::class,'show']); // con esta ruta puedo buscar un author especifico
Route::put('authors/{author}',[AuthorController::class,'update']); // con esta ruta puedo actualizar un autor
Route::delete('authors/{author}',[AuthorController::class,'destroy']); // con esta ruta puedo eliminar un autor      

//rutas de User
Route::get('users',[UserController::class,'index']); // con esta ruta puedo ver todos los usuarios
Route::post('users',[UserController::class,'store']); //con esta ruta puedo registrar una nuevo usuario
Route::get('users/{user}',[UserController::class,'show']); // con esta ruta puedo buscar un usuario especifico
Route::put('users/{user}',[UserController::class,'update']); // con esta ruta puedo actualizar un usuario
Route::delete('users/{user}',[UserController::class,'destroy']); // con esta ruta puedo eliminar un usuario 

//rutas de Editorial
Route::get('editorials',[EditorialController::class,'index']); // con esta ruta puedo ver todas las editoriales
Route::post('editorials',[EditorialController::class,'store']); //con esta ruta puedo registrar una nueva editorial
Route::get('editorials/{editorial}',[EditorialController::class,'show']); // con esta ruta puedo buscar una editorial especifica
Route::put('editorials/{editorial}',[EditorialController::class,'update']); // con esta ruta puedo actualizar una editorial
Route::delete('editorials/{editorial}',[EditorialController::class,'destroy']); // con esta ruta puedo eliminar una editorial

//rutas de Nivel de educacion
Route::get('educational_levels',[Educational_LevelController::class,'index']); 
Route::post('educational_levels',[Educational_LevelController::class,'store']); 
Route::get('educational_levels/{educational_Level}',[Educational_LevelController::class,'show']); 
Route::put('educational_levels/{educational_Level}',[Educational_LevelController::class,'update']); 
Route::delete('educational_levels/{educational_Level}',[Educational_LevelController::class,'destroy']);

//rutas de tipos de material
Route::get('type_materials',[Type_MaterialController::class,'index']);
Route::get('type_materials/{id}',[Type_MaterialController::class,'show']);
Route::post('type_materials',[Type_MaterialController::class,'store']);
Route::put('type_materials/{id}',[Type_MaterialController::class,'update']);
Route::delete('type_materials/{id}',[Type_MaterialController::class,'destroy']);
// Route::Apiresource('type_materials',[Type_MaterialController::class]);

//rutas de tipos de rol
Route::get('rols',[RolController::class,'index']);
Route::get('rols/{id}',[RolController::class,'show']);
Route::post('rols',[RolController::class,'store']);
Route::put('rols/{id}',[RolController::class,'update']);
Route::delete('rols/{id}',[RolController::class,'destroy']);

//rutas de tipos de autor material
Route::get('author_materials',[Author_MaterialController::class,'index']);
Route::get('author_materials/{id}',[Author_MaterialController::class,'show']);
Route::post('author_materials',[Author_MaterialController::class,'store']);
Route::put('author_materials/{id}',[Author_MaterialController::class,'update']);
Route::delete('author_materials/{id}',[Author_MaterialController::class,'destroy']);

//rutas de material
Route::get('materials',[MaterialController::class,'index']);
Route::get('materials/{id}',[MaterialController::class,'show']);
Route::post('materials',[MaterialController::class,'store']);
Route::put('materials/{id}',[MaterialController::class,'update']);
Route::delete('materials/{id}',[MaterialController::class,'destroy']);

//rutas de material_user
Route::get('material__users',[Material_UserController::class,'index']);
Route::get('material__users/{id}',[Material_UserController::class,'show']);
Route::post('material__users',[Material_UserController::class,'store']);
Route::put('material__users/{id}',[Material_UserController::class,'update']);
Route::delete('material__users/{id}',[Material_UserController::class,'destroy']);