<?php


use App\Http\Controllers\BlogController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FoodDairyController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


\Illuminate\Support\Facades\Auth::routes();



Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile/{user_name}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit/{user_name}', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/calories-calculate', [App\Http\Controllers\CalorieCalculatorController::class, 'index'])->name('calorie');
    Route::post('/calories-calculate/store', [App\Http\Controllers\CalorieCalculatorController::class, 'store'])->name('calorie.store');

    Route::get('/meals', [MealController::class, 'index'])->name('meals');

    Route::get('/food-dairy', [FoodDairyController::class, 'index'])->name('dairy');
    Route::get('/food-dairy/add-breakfast', [FoodDairyController::class, 'breakfast'])->name('dairy.breakfast');
    Route::post('/food-dairy/add-breakfast/store', [FoodDairyController::class, 'breakfastStore'])->name('dairy.breakfast.store');
    Route::get('/food-dairy/add-lunch', [FoodDairyController::class, 'lunch'])->name('dairy.lunch');
    Route::post('/food-dairy/add-lunch/store', [FoodDairyController::class, 'lunchStore'])->name('dairy.lunch.store');
    Route::get('/food-dairy/add-dinner', [FoodDairyController::class, 'dinner'])->name('dairy.dinner');
    Route::post('/food-dairy/add-dinner/store', [FoodDairyController::class, 'dinnerStore'])->name('dairy.dinner.store');
    Route::post('/food-dairy/store', [FoodDairyController::class, 'store'])->name('dairy.store');


    Route::get('/food-diary/{data}', [FoodDairyController::class, 'getData'])->name('diary.data');


    Route::get('/exercise-categories', [ExerciseController::class, 'categoryExercises'])->name('exercise.categories');
    Route::get('/exercise-categories/{type}', [ExerciseController::class, 'types'])->name('exercise.types');
    Route::get('/exercises/{id}', [ExerciseController::class, 'exerciseName'])->name('exercises');
//Route::get('/exercises/legs', [ExerciseController::class, 'legs'])->name('exercises.legs');

    Route::get('/membership', [MembershipController::class, 'index'])->name('membership');
    Route::post('/membership', [MembershipController::class, 'store'])->name('membership.store');
    Route::get('/membership/{slug}', [MembershipController::class, 'create'])->name('membership.register');
    Route::post('/membership/credit',[CreditController::class, 'credit'])->name('credit');
    Route::get('/membership/callback',[CreditController::class, 'callback']);


    Route::view('add-food', 'livewire.show_form')->name('add.food');

});





Auth::routes();





Route::get('/counter', \App\Http\Livewire\Counter::class);

/************ Blog ***************/

Route::get('/blog', [BlogController::class, 'index'])->name('blog');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
