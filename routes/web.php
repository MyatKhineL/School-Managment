<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentManageController;

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



Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
        Route::post('/update-info', [ProfileController::class, 'updateProfileInfo'])->name('profile.profile-edit');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    });

    // Department
    Route::get('/department/datatable/ssd', [DepartmentController::class, 'ssd'])->name('department.ssd');
    Route::resource('/department', DepartmentController::class)->except('show');

    // Admin Management
    Route::get('/user/datatable/ssd', [UserController::class, 'ssd'])->name('user.ssd');
    Route::resource('/user', UserController::class);

    // Student Management
    Route::get('/student/datatable/ssd', [StudentManageController::class, 'ssd'])->name('student.ssd');
    Route::get('/student', [StudentManageController::class, 'index'])->name('student.index');
    Route::get('/student/{id}', [StudentManageController::class, 'show'])->name('student.show');
    Route::get('/student/course/create', [StudentManageController::class, 'create'])->name('student.take-course');
    Route::get('/student/{id}/edit', [StudentManageController::class, 'edit'])->name('student.edit');
    Route::post('/student/course/store', [StudentManageController::class, 'storeCourses'])->name('student.store-courses');
    Route::post('/student/{id}', [StudentManageController::class, 'update'])->name('student.update');

    Route::prefix('setup')->group(function(){
        // Course
        Route::get('/course/datatable/ssd', [CourseController::class, 'ssd'])->name('course.ssd');
        Route::resource('/course', CourseController::class);

        // Shift
        Route::get('/shift/datatable/ssd', [ShiftController::class, 'ssd'])->name('shift.ssd');
        Route::resource('/shift', ShiftController::class);

         // ClassRoom
         Route::get('/classroom/datatable/ssd', [ClassroomController::class, 'ssd'])->name('classroom.ssd');
         Route::resource('/classroom',ClassroomController::class);
    });

});

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
