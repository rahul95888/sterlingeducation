<?php


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CommodityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\FpoController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OtherController;
use App\Http\Controllers\Admin\MockTestController;
use App\Http\Controllers\Admin\PopController;
use App\Http\Controllers\Admin\ProcessCapabilityController;
use App\Http\Controllers\Admin\ProcessMethodController;
use App\Http\Controllers\Admin\ProcessorController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\VideoLessonController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ServiceAllocationController;
use App\Http\Controllers\Admin\UserPrivilegeController;
use App\Http\Controllers\Admin\RoleMasterController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Controller;
use App\Models\ProcessMethod;

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

Route::get('/', [Controller::class, 'index'])->name('index');
Route::get('/contact', [Controller::class, 'contact'])->name('contact');
Route::get('/about', [Controller::class, 'about'])->name('about');

Route::get('/faq', [Controller::class, 'faq'])->name('faq');
Route::get('/gallery', [Controller::class, 'gallery'])->name('gallery');
Route::get('/courselist', [Controller::class, 'courselist'])->name('courselist');

Route::get('/subjectlist', [Controller::class, 'subjectlist'])->name('subjectlist');
Route::get('/subjectdetail/{id}', [Controller::class, 'subjectdetail'])->name('subjectdetail');


Route::get('/download-listing', [Controller::class, 'downloadlist'])->name('downloadlist');
Route::get('/download-details/{id}', [Controller::class, 'downloaddetail'])->name('downloaddetail');




Route::get('/our-services', [Controller::class, 'services'])->name('services');

Route::get('/package-details/{id}', [Controller::class, 'packagedetail'])->name('packagedetail');

Route::get('/joblist', [Controller::class, 'job'])->name('joblist');
Route::get('/jobDetail/{id}', [Controller::class, 'jobDetail'])->name('jobDetail');

Route::get('/coursedetail/{id}', [Controller::class, 'coursedetail'])->name('coursedetail');

Route::get('/shop-detail/{id}', [Controller::class, 'shopDetail'])->name('shopDetail');
Route::get('/shop', [Controller::class, 'shop'])->name('shop');


Route::get('/mock-test-detail/{id}', [Controller::class, 'mockdetail'])->name('mockdetail');
Route::get('/mocktest-listing', [Controller::class, 'mocktest'])->name('mocktest');


Route::get('/video-lesson-detail/{id}', [Controller::class, 'Videodetail'])->name('Videodetail');
Route::get('/videolesson-listing', [Controller::class, 'videolesson'])->name('videolesson');



Route::get('/event', [Controller::class, 'event'])->name('event');
Route::get('/my-gallery', [Controller::class, 'gallery'])->name('gallery');
Route::get('/eventDetail/{id}', [Controller::class, 'eventDetail'])->name('eventDetail');


Route::get('/blogInfinity', [Controller::class, 'blogInfinity'])->name('blogInfinity');

Route::get('/blogDetail', [Controller::class, 'blogDetail'])->name('blogDetail');
Route::get('/teacherdetail/{id}', [Controller::class, 'teacherdetail'])->name('teacherdetail');













Route::get('/blogs', [Controller::class, 'blogs'])->name('blogs');
Route::get('/blog-details/{id}', [Controller::class, 'blogdetail'])->name('blogdetail');
Route::get('/service-details/{id}', [Controller::class, 'servicedetail'])->name('servicedetail');
Route::get('/page/{slug}', [Controller::class, 'staticpage'])->name('staticpage');

Route::get('/our-packages', [Controller::class, 'packages'])->name('packages');
Route::get('/admin', [AuthController::class, 'adminLogin'])->name('admin-login');

Route::post('/send-enquiry', [Controller::class, 'sendEnquiry'])->name('sendEnquiry');


Route::group(['middleware' => ['auth','permissions']], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('change-password', [DashboardController::class, 'changepassword'])->name('changepassword');


    Route::post('/change-password1', [DashboardController::class, 'updatePassword'])->name('update-password');

    
    
    //users
   
    Route::resource('fpos', FpoController::class);
    
    Route::resource('processors', ProcessorController::class);

    Route::get('/plan-featured/{id}', [ProcessorController::class, 'featured'])->name('featured');
  

    

 


     
    
   

    Route::resource('commodities', CommodityController::class);

    Route::resource('equipments', EquipmentController::class);

    Route::resource('news', NewsController::class);

    Route::resource('sections', SectionController::class);
    Route::resource('batch',BatchController::class);
    Route::resource('pops', PopController::class);
    Route::resource('mocktest', MockTestController::class);
    Route::resource('videolesson', VideoLessonController::class);


    

    Route::get('trades', [OtherController::class, 'getAllTrades'])->name('trades');
    Route::get('trade-details/{trade_id?}', [OtherController::class, 'getTradeDetails'])->name('trade-details');

    /**
     * Location routes
     */

 


    /**
     * Service routes
     */
    Route::resource('services', ServiceController::class);
    Route::resource('teacher', TeacherController::class);
    Route::resource('job', JobController::class);
    Route::resource('course',CourseController::class);
    Route::resource('gallery',GalleryController::class);
    Route::resource('downloads',DownloadController::class);


    

    Route::resource('service-allocations', ServiceAllocationController::class);

    //Report
    Route::get('procurement-report', [ReportController::class, 'index'])->name('procurement_report');
    Route::post('procurement-filter', [ReportController::class, 'filter'])->name('procurement_filter');

    Route::get('feedbacks', [ReportController::class, 'feedbackList'])->name('feedbacks');

    //Marketing & Promo
    Route::resource('marketings', MarketingController::class);

    //role master
    Route::get('all-roles',[RoleMasterController::class,'index'])->name('all-roles');
    Route::any('add-role',[RoleMasterController::class,'create'])->name('add-role');
    Route::any('edit-role/{id}',[RoleMasterController::class,'edit'])->name('edit-role');

    // user privileges
    Route::get('user-privileges',[UserPrivilegeController::class,'index'])->name('user_privileges');;
    Route::post('update-role',[UserPrivilegeController::class,'updaterole'])->name('update-role');
    Route::any('add-admin',[UserPrivilegeController::class,'add'])->name('add-admin');

});


require __DIR__ . '/auth.php';
