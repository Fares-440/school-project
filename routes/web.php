<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Student\LibraryController;
use App\Http\Controllers\Student\OnlineClassController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Livewire\Calendar;
use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    // Route::get('/', function () {
    //     return view('auth.login');
    // })->middleware('guest');
    /** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

    // Auth::routes();

    Route::get('/', [HomeController::class, 'index'])->name('selection');

    Route::group(['namespace' => 'Auth'], function () {

        Route::get('/login/{type}', [LoginController::class, 'loginForm'])->middleware('guest')->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
        Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
    });
});



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::resource('grades', GradeController::class);

    Route::post('classrooms/delete', [ClassroomController::class, 'delete_all'])->name('classrooms.delete_all');
    Route::match(['get', 'post'], 'filter_classes', [ClassroomController::class, 'filter_classes'])->name('classrooms.filter_classes');
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('teachers', TeacherController::class);

    Route::group(['namespace' => '\App\Http\Controllers\Student'], function () {
        Route::resource('fees', FeeController::class);
        Route::resource('library', LibraryController::class);
        Route::resource('processing_fee', ProcessingFeeController::class);
        Route::resource('fees_invoices', FeeInvoicesController::class);
        Route::post('graduated/exit', [GraduatedController::class, 'destroy'])->name('graduated.exit');
        Route::resource('graduated', GraduatedController::class);
        Route::resource('payment_students', PaymentStudentController::class);
        Route::resource('students', StudentController::class);
        Route::resource('receipt_students', ReceiptStudentController::class);
        Route::resource('promotions', PromotionController::class);
        Route::resource('attendances', AttendanceController::class);
        Route::get('/indirect', [OnlineClassController::class, 'indirectCreate'])->name('indirect.create');
        Route::post('/indirect', [OnlineClassController::class, 'storeIndirect'])->name('indirect.store');
        Route::resource('online_classes', OnlineClassController::class);
    });
    Route::get('getAttachment/{file}/{image}', [LibraryController::class, 'get_Image']);
    Route::get('downloadAttachment/{file}/{image}', [LibraryController::class, 'downloadAttachment']);
    Route::get('get_attachment/{file}/{image}', [StudentController::class, 'getImage']);
    Route::post('delete_attachment', [StudentController::class, 'deleteImage'])->name('delete_attachment');
    Route::post('upload_attachment', [StudentController::class, 'uploadImage'])->name('upload_attachment');
    Route::get('download_attachment/{file}/{image}', [StudentController::class, 'downloadImage']);


    Route::resource('subjects', SubjectController::class);
    Route::group(['namespace' => '\App\Http\Controllers\Quizzes'], function () {
        Route::resource('quizzes', QuizzeController::class);
    });
    Route::resource('questions', QuestionController::class);
    Route::view('add_parent', 'livewire.parent');
    //==============================Setting============================
    Route::get('getImages/{file}/{name}', [SettingController::class, 'show'])->name("settings.getImg");
    Route::resource('settings', SettingController::class);
    Livewire::component('calendar', Calendar::class);
    Route::get('dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

});
