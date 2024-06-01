<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/wait-for-approval', function () {
    return view('auth.wait_for_approval');
})->name('wait-for-approval');

Route::get('qrLogin', ['uses' => 'App\Http\Controllers\QrLoginController@index']);
Route::post('qrLogin', ['uses' => 'App\Http\Controllers\QrLoginController@checkUser']);

Route::resource('users', UserController::class);

// Admin routes
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('users', UserController::class);
 
    
    // Department specific routes
    // Route::get('/admin/department/{department}', [UserController::class, 'departmentIndex'])->name('admin.department');
});
// Pending user routes
Route::get('/admin/pending-users', [UserController::class, 'pendingIndex'])->name('admin.pending_users.index');
Route::post('/admin/pending-users/approve/{id}', [UserController::class, 'approve'])->name('admin.pending_users.approve');
Route::delete('/admin/pending-users/reject/{id}', [UserController::class, 'destroyPending'])->name('admin.pending_users.reject');



// Dashboard route
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');

// Register routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Approval wait page
Route::get('/wait-for-approval', function () {
    return view('auth.wait_for_approval');
})->name('wait-for-approval');







Route::get('/report', [ReportController::class, 'generateReport'])->name('report.generate');

Route::post('/import', [UserController::class, 'import'])->name('import');
//dashboard routes

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/generate-report', [DashboardController::class, 'generateReport'])->name('admin.generateReport');


use App\Http\Controllers\BSITController;
use App\Http\Controllers\BSMATHController;


// Route::get('/users/bsit', [BSITController::class, 'index'])->name('Import Student Data via CSV');
// Route::get('/users/bsmath', [BSMATHController::class, 'index'])->name('users.bsmath');





// Route::get('/admin/bsit', [BSITController::class, 'index'])->name('admin.bsit');
Route::get('/admin/bsit/create', [BSITController::class, 'create'])->name('bsit.create');
Route::post('/admin/bsit', [BSITController::class, 'store'])->name('bsit.store');

// Route::get('/admin/bsmath', [BSMATHController::class, 'index'])->name('admin.bsmath');
Route::get('/admin/bsmath/create', [BSMATHController::class, 'create'])->name('bsmath.create');
Route::post('/admin/bsmath', [BSMATHController::class, 'store'])->name('bsmath.store');




// Other routes...


Route::prefix('admin')->group(function () {
    Route::get('bsit', [BSITController::class, 'index'])->name('admin.bsit');
    Route::post('bsit/import', [BSITController::class, 'import'])->name('bsit.import');
    Route::get('bsit/report', [BSITController::class, 'generateReport'])->name('bsit.report');

    Route::get('bsmath', [BSMATHController::class, 'index'])->name('admin.bsmath');
    Route::post('bsmath/import', [BSMATHController::class, 'import'])->name('bsmath.import');
    Route::get('bsmath/report', [BSMATHController::class, 'generateReport'])->name('bsmath.report');
});
