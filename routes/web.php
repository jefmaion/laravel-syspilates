<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\ExperimentalClassController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InstructorModalityController;
use App\Http\Controllers\ModalityController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckTenant;
use Illuminate\Support\Facades\Artisan;
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

//Clear config cache
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return redirect()->back();
}); 

// Clear application cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache cleared';
});

// Clear cache using reoptimized class
Route::get('/optimize-clear', function() {
    Artisan::call('optimize:clear');
    return 'View cache cleared';
});

Route::get('/optimize', function() {
    Artisan::call('optimize');
    return 'Config cache cleared';
});

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/transfer', [TestController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'tenant'])->group(function() {

    Route::get('/welcome', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/tenant/{tenant}/change', [TenantController::class, 'change'])->withoutMiddleware([CheckTenant::class])->name('tenant.change');

    Route::resource('/student', StudentController::class);
    Route::resource('/student/{student}/registration', StudentRegistrationController::class)->names('student.registration');
    Route::get('/student/{student}/registration/{registration}/renew',[StudentRegistrationController::class, 'renew'])->name('student.registration.renew');
    Route::post('/student/{student}/registration/{registration}/renew',[StudentRegistrationController::class, 'renewStore'])->name('student.registration.renew.store');
    Route::resource('/student/{student}/registration/{registration}/class', StudentClassController::class)->names('student.registration.class');

    Route::resource('/instructor', InstructorController::class);
    Route::resource('/instructor{instructor}/modality', InstructorModalityController::class)->names('instructor.modality');
    
    Route::resource('/modality', ModalityController::class);
    Route::resource('/exercice', ExerciceController::class);
    Route::resource('/category', CategoryController::class);

    Route::get('/receive/{id}/pay', [ReceiveController::class, 'pay'])->name('receive.pay');
    Route::post('/receive/get',     [ReceiveController::class, 'receive'])->name('receive.receve');
    Route::post('/receive/delete', [ReceiveController::class, 'delete'])->name('receive.delete');
    Route::resource('/receive', ReceiveController::class);
    
    Route::post('/calendar/event', [CalendarController::class, 'event'])->name('calendar.event');
    Route::get('/calendar/list', [CalendarController::class, 'list'])->name('calendar.list');
    Route::get('/calendar/day/{day}', [CalendarController::class, 'day'])->name('calendar.day');
    Route::get('/calendar/renew/{id}', [CalendarController::class, 'renew'])->name('calendar.renew');
    Route::get('/calendar/experimental', [CalendarController::class, 'showExperimental'])->name('calendar.show.experimental');
    Route::get('/calendar/remark', [CalendarController::class, 'showRemark'])->name('calendar.show.remark');
    Route::post('/calendar/remark', [CalendarController::class, 'remark'])->name('calendar.remark');
    Route::post('/calendar/class/list-not-remark', [CalendarController::class, 'listNotRemark'])->name('calendar.listNotRemark');
    Route::resource('/calendar', CalendarController::class);

    Route::post('/class/experimental', [ClassesController::class, 'storeExperimental'])->name('classes.experimental.store');
    Route::post('/class/reset', [ClassesController::class, 'reset'])->name('class.reset');
    Route::put('/class/{id}/absense', [ClassesController::class, 'absense'])->name('class.absense');
    Route::put('/class/{id}/presence', [ClassesController::class, 'presence'])->name('class.presence');
    Route::resource('/class', ClassesController::class);

    // Route::resource('class/experimental', ExperimentalClassController::class);

    
    Route::get('/files', [FilesController::class, 'index'])->name('files.index');
    Route::get('/files/add', [FilesController::class, 'create'])->name('files.create');
    Route::post('/files/add', [FilesController::class, 'store'])->name('files.store');
    Route::delete('/files/{id}', [FilesController::class, 'destroy'])->name('files.delete');

    Route::resource('/registration', RegistrationController::class);




    
});

require __DIR__.'/auth.php';
