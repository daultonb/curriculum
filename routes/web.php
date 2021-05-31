<?php

use App\Http\Controllers\HomeController;
use App\Models\Invite;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Mail\Invitation;

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

Route::get('/', function () {
    return view('pages.landing');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@store')->name('home.store');
//Route::delete('/home/{course}/unassign', 'HomeController@destroy')->name('home.destroy');
Route::get('/home/{course}/submit','CourseController@submit')->name('home.submit');

Route::get('/about', 'AboutController@index')->name('about');

Route::get('/faq', 'FAQController@index')->name('FAQ');
Route::get('/terms', 'TermsController@index')->name('terms');


Route::get('/syllabusGenerator', 'SyllabusController@index')->name('syllabus');
Route::post('/syllabusGenerator/word','SyllabusController@WordExport')->name('syllabus.word');
Route::get('/syllabusGenerator/course','SyllabusController@getCourseInfo');

Route::resource('/programs','ProgramController');
Route::get('/programs/{program}/submit','ProgramController@submit')->name('programs.submit');

Route::resource('/courses','CourseController');

Route::post('/courses/{course}/assign','CourseUserController@store')->name('courses.assign');
Route::delete('/courses/{course}/unassign','CourseUserController@destroy')->name('courses.unassign');
// Route::get('/courses/{course}/status','CourseController@status')->name('courses.status');
Route::get('/courses/{course}/submit','CourseController@submit')->name('courses.submit');
Route::get('/courses/{course}/summary','CourseController@show')->name('courses.summary');
Route::post('/courses/{course}/outcomeDetails','CourseController@outcomeDetails')->name('courses.outcomeDetails');
Route::get('/courses/{course}/pdf','CourseController@pdf')->name('courses.pdf');


Route::resource('/lo','LearningOutcomeController')->only(['store','update','edit', 'destroy']);

Route::resource('/plo','ProgramLearningOutcomeController');

Route::resource('/la','LearningActivityController');

Route::post('/ajax/custom_activities','CustomLearningActivitiesController@store' );
Route::post('/ajax/custom_methods','CustomAssessmentMethodsController@store' );

Route::resource('/am','AssessmentMethodController');

Route::resource('/outcomeMap','OutcomeMapController');

Route::resource('/mappingScale','MappingScaleController');
Route::post('/mappingScale/default','MappingScaleController@default')->name('mappingScale.default');

Route::resource('/ploCategory','PLOCategoryController');

Route::resource('/programUser','ProgramUserController', ['except'=>'destroy']);
Route::delete('/programUser/{program}/{user}','ProgramUserController@delete')->name('programUser.destroy');

// Program wizard controller used to sent info from database to the blade page
Route::get('/programWizard/{program}/step1','ProgramWizardController@step1')->name('programWizard.step1');
Route::get('/programWizard/{program}/step2','ProgramWizardController@step2')->name('programWizard.step2');
Route::get('/programWizard/{program}/step3','ProgramWizardController@step3')->name('programWizard.step3');
Route::get('/programWizard/{program}/step4','ProgramWizardController@step4')->name('programWizard.step4');

// Program step3 add existing course to the program
Route::post('/programWizard/{program}/step3/copy', 'CourseController@copy')->name('courses.copy');

// Course wizard controller used to sent info from database to the blade page
Route::get('/courseWizard/{course}/step1','CourseWizardController@step1')->name('courseWizard.step1');
Route::get('/courseWizard/{course}/step2','CourseWizardController@step2')->name('courseWizard.step2');
Route::get('/courseWizard/{course}/step3','CourseWizardController@step3')->name('courseWizard.step3');
Route::get('/courseWizard/{course}/step4','CourseWizardController@step4')->name('courseWizard.step4');
Route::get('/courseWizard/{course}/step5','CourseWizardController@step5')->name('courseWizard.step5');
Route::get('/courseWizard/{course}/step6','CourseWizardController@step6')->name('courseWizard.step6');

// Save optional PLOs
Route::post('/optionals','OptionalPriorities@store')->name('storeOptionalPLOs');

// invatation route
Route::get('/invite', 'InviteController@index')->name('requestInvitation');

// route used to sent the invitation email
Route::post('/invitations','InviteController@store')->name('storeInvitation');

// UnderConstruction page
Route::get('/construction', function () {
    return view('pages.construction');
});

Auth::routes();
