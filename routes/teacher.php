<?php

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Teacher\dashboard\StudentController;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {
            $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
            $data['count_sections'] = $ids->count();
            $data['count_students'] = \App\Models\Student::whereIn('section_id', $ids)->count();
            return view('pages.teachers.dashboard.dashboard', $data);
        });

        //==============================students============================
        Route::get('student', [App\Http\Controllers\Teacher\Dashboard\StudentController::class, 'index'])->name('student.index');
        Route::get('section', [App\Http\Controllers\Teacher\Dashboard\StudentController::class, 'sections'])->name('section');
        Route::post('attendance', [App\Http\Controllers\Teacher\Dashboard\StudentController::class, 'attendance'])->name('attendance');
        Route::post('edit_attendance', [App\Http\Controllers\Teacher\Dashboard\StudentController::class, 'editAttendance'])->name('attendance.edit');
        Route::get('attendance_report', [App\Http\Controllers\Teacher\Dashboard\StudentController::class, 'attendanceReport'])->name('attendance.report');
        Route::post('attendance_report', [App\Http\Controllers\Teacher\Dashboard\StudentController::class, 'attendanceSearch'])->name('attendance.search');
        Route::resource('quizzes',  App\Http\Controllers\Teacher\Dashboard\QuizzController::class);
        // Route::controller(App\Http\Controllers\Teacher\Dashboard\QuizzController::class)->group(function () {
        //     Route::get('classroom/{id}', 'getClassrooms');
        //     Route::get('section/{id}', 'getSections');
        // });
        Route::controller(App\Http\Controllers\Teacher\Dashboard\QuizzController::class)->group(function () {
            Route::get('classroom/{id}', 'getClassrooms');
            Route::get('section/{id}', 'getSections');
        });
        Route::resource('questions',  App\Http\Controllers\Teacher\Dashboard\QuestionController::class);
        Route::controller(App\Http\Controllers\Teacher\Dashboard\OnlineClassController::class)->group(function () {
            Route::get('/indirectteacher', 'indirectCreate')->name('indirectTeacher.create');
            Route::post('/indirectteacher', 'storeIndirect')->name('indirectTeacher.store');
        });
        Route::resource('online_class', App\Http\Controllers\Teacher\Dashboard\OnlineClassController::class);
        Route::controller(App\Http\Controllers\Teacher\Dashboard\ProfileController::class)->group(function () {
            Route::get('profile', 'index')->name('profile.show');
            Route::post('profile/{id}', 'update')->name('profile.update');
        });
    }
);
