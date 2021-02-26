<?php
use App\Http\Livewire\Home;
use App\Http\Livewire\Shop;
use App\Http\Livewire\ProductCart;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\ProductDetails;
use App\Http\Livewire\ProductCategory;
use App\Http\Livewire\SearchComponent;
Use App\Http\Livewire\User\UserDashboard;
Use App\Http\Livewire\Admin\AdminDashboard;
Use App\Http\Livewire\Admin\Products;
Use App\Http\Livewire\Admin\Categories;
Use App\Http\Livewire\Admin\AddCategory;
Use App\Http\Livewire\Admin\EditCategory;
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

//Route::get('/', function () {
    //return view('welcome');
//});

Route::get('/',Home::class);
Route::get('/shop',Shop::class);
Route::get('/cart',ProductCart::class)->name('product.cart');
Route::get('/checkout',Checkout::class);
Route::get('/product/{slug}',ProductDetails::class)->name('product.details');
Route::get('/category/{slug}',ProductCategory::class)->name('product.category');
Route::get('/search',SearchComponent::class)->name('product.search');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //return view('dashboard');
//})->name('dashboard');

//Route for the norma user
Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('user/dashboard',UserDashboard::class)->name('user.dashboard');

});

//Route for the admin user
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
    Route::get('admin/dashboard',AdminDashboard::class)->name('admin.dashboard');
    Route::get('admin/categories',Categories::class)->name('admin.categories');
    Route::get('admin/products',Products::class)->name('admin.products');
    Route::get('admin/category/add',AddCategory::class)->name('admin.addcategory');
    Route::get('admin/category/edit/{category_slug}',EditCategory::class)->name('admin.editcategory');
});
