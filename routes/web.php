<?php

use App\Models\Commission;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ITB\PortController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\ITB\GroupController;
use App\Http\Controllers\ITB\ScoreController;
use App\Http\Controllers\Ilmiy\MainController;
use App\Http\Controllers\ITB\StudentController;
use App\Http\Controllers\ITB\FacultesController;
use App\Http\Controllers\ITB\CriteriaController;
use App\Http\Controllers\Student\WorkController;
use App\Http\Controllers\ITB\ProfessorController;
use App\Http\Controllers\ITB\DirectionController;
use App\Http\Controllers\Ilmiy\AllPortcontroller;
use App\Http\Controllers\ITB\Work_typeController;
use App\Http\Controllers\ITB\DepartmentController;
use App\Http\Controllers\ITB\CommissionController;
use App\Http\Controllers\ITB\AnnouncementController;



Route::get('/tanlovlar', [StatisticController::class, 'announcement']);
Route::get('/tanlovlar/mezonlar/{id}', [StatisticController::class, 'criteria'])->name('statistic.criteria');
Route::get('/tanlovlar/azolar/{id}', [StatisticController::class, 'commissions'])->name('statistic.commissions');
Route::get('/tanlovlar/ishtirokchilar/{id}', [StatisticController::class, 'applications'])->name('statistic.applications');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
//Iqtidorli talabalar bo'limi routes
Route::group(['prefix' => 'itb', 'middleware' => ['is_itb', 'auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'itbHome'])->name('itb.home');
    Route::group(['prefix' => 'settings'], function () {
        //Faculte routes
        Route::resource('faculte', FacultesController::class);
        // Yo'nalishlar routes
        Route::resource('direction', DirectionController::class);

        // Kafedralar routes
        Route::resource('department', DepartmentController::class);

        // Group routes
        Route::resource('group', GroupController::class);

        // work type routes
        Route::resource('worktype', Work_typeController::class);

        // Score routes
        Route::resource('score', ScoreController::class);

        // Work all
        Route::get('/works/all', [PortController::class, 'workAll'])->name('work.all');
    });
    // Professor routes
    Route::resource('professor', ProfessorController::class);
    // attach Student
    Route::post('professor/{professor_id}', [ProfessorController::class, 'attach_student'])->name('attach_student');

    // Student routes
    Route::resource('student', StudentController::class);
    Route::POST('student/filter', [StudentController::class, 'AJAXRequest'])->name('student.AJAXRequest');
    Route::POST('student/direction/filter', [StudentController::class, 'ajaxDirection'])->name('student.ajaxDirection');
    Route::POST('student/group/filter', [StudentController::class, 'ajaxGroup'])->name('student.ajaxGroup');
    Route::PUT('/cancelWork/{work}', [StudentController::class, 'cancelWork'])->name('itb.cancel.work');
    Route::PUT('/successWork/{work}', [StudentController::class, 'successWork'])->name('itb.success.work');
    // work comments
    Route::get('/comments', [CommentController::class, 'allComments'])->name('comments');
    Route::put('/comments/{id}', [CommentController::class, 'replyComment'])->name('comment.reply');
    Route::put('/comments/cancel/{id}', [CommentController::class, 'cancelComment'])->name('comment.cancel');
    // e'lonlar uchun
    Route::resource('announcement', AnnouncementController::class);
    // Commissions routes
    Route::resource('commissions', CommissionController::class);
    // Criteria routes
    Route::post('/criteria_add', [CriteriaController::class, 'store'])->name('criteria.add');

});
// Comment routes
    Route::PUT('/teachercomment/{work}', [CommentController::class, 'teacherComment'])->name('teacher.comment');
// Profile routes

Route::get('/profile', [ProfilController::class, 'index'])->name('profile.index');
Route::put('/profile/update', [ProfilController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [ProfilController::class, 'password'])->name('profile.password');



// Teacher routes
Route::group(['prefix' => 'ilmiy', 'middleware' => ['is_ilmiy', 'auth']], function () {
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'ilmiyHome'])->name('ilmiy.home');
    Route::get('/students', [MainController::class, 'attachStudent'])->name('ilmiy.students');
    Route::get('/student/show/{student}', [MainController::class, 'studentShow'])->name('show.student');
    Route::PUT('/cancelWork/{work}', [MainController::class, 'cancelWork'])->name('cancel.work');
    Route::PUT('/successWork/{work}', [MainController::class, 'successWork'])->name('success.work');
    Route::get('/minework', [AllPortcontroller::class, 'mineWork'])->name('mine.work');
    Route::get('/minework/successworks', [AllPortcontroller::class, 'successWork'])->name('succes.works');
    Route::get('/minework/cancelworks', [AllPortcontroller::class, 'cancelWork'])->name('cancel.works');
    Route::get('/minework/unverifiedworks', [AllPortcontroller::class, 'unverifiedWork'])->name('unverified.works');
    Route::get('/allworks', [AllPortcontroller::class, 'allWork'])->name('all.works');

});


// Student routes
Route::group(['prefix' => 'student', 'middleware' => ['is_student', 'auth']], function () {
    Route::get('/index', [App\Http\Controllers\HomeController::class, 'studentHome'])->name('student.home');
    Route::resource('work', WorkController::class);
    Route::get('/works/success', [WorkController::class, 'checkedWork'])->name('work.success');
    Route::get('/works/cancel', [WorkController::class, 'cancelWork'])->name('work.cancel');
    Route::get('/works/unverified', [WorkController::class, 'unverifiedWork'])->name('work.unverified');
});
