<?php

use App\User;

use App\Image;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;



Route::get('/prueba', function () {

    Gate::authorize('haveaccess','role.show');
    $user = User::find(1);



    return $user;
    
    

});
    
//mostrar resultados
Route::get('/resultados', function () {

   $image = App\Image::orderBy('id','Desc')->get();
   return  $image; 
});




Route::get('/', function () {

/*$prod= Product::findOrFail(2);

$prod->slug= 'producto-3';

$prod->save();

return $prod;
*/
/*$prod = new Product();
$prod->nombre = 'Producto 3';
$prod->slug = 'Producto 3';
$prod->category_id = 2;
$prod->descripcion_corta = 'Producto ';
$prod->descripcion_larga = 'Producto ';
$prod->especificaciones = 'Producto ';
$prod->datos_de_interes = 'Producto ';
$prod->estado = 'Nuevo';
$prod->activo = 'Si';
$prod->sliderprincipal = 'No'; 
$prod->save();
return $prod;
*/
    //return view('welcome');


/*$cat = Category::find(1)->products;

return $cat;
*/

return view('tienda.index');
});




Route::resource('/role', RoleController::class)->names('role');

Route::resource('/user', UserController::class, ['except'=>[
    'create','store']])->names('user');


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin', function () {
    return view('plantilla.admin');
})->name('admin');

Route::resource('admin/category', AdminCategoryController::class)->names('admin.category');

Route::resource('admin/product', AdminProductController::class)->names('admin.product');


Route::get('cancelar/{ruta}', function($ruta) {
    return redirect()->route($ruta)->with('cancelar','Acción Cancelada!');
})->name('cancelar');