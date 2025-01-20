<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ChamberController;
use App\Http\Controllers\BannerVideoController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\AboutContactController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\AlttagController;
use App\Http\Controllers\SeodetailsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HoroscopesController;
use App\Http\Controllers\ZodiacController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReviewsectionController;
use App\Http\Controllers\PhonepeController;
use Illuminate\Support\Facades\Route;
// frontend controller
use App\Http\Controllers\HomeController;

// Route::get('/phpinfo', function () {
//     return phpinfo();
// });
// Route::get('/datepicker', function () {
//     return view("date");
// });
//frontend roots

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/aboutus', [AboutContactController::class, 'frontabout']);

Route::get('/services', [ServiceController::class, 'servicelists']);
Route::get('/service/{nameurl}', [ServiceController::class, 'servicedetails'])->name('service');

Route::get('/blogs', [BlogController::class, 'bloglist'])->name('blogs');
Route::get('/blogs/{page}/{language}/{search}/{type}', [BlogController::class, 'bloglistpagination'])->name('blogs');
Route::get('/blog/{nameurl}', [BlogController::class, 'blog'])->name('blog');
Route::get('/searchblog', [BlogController::class, 'searchblog']);
Route::get('/languagefilter', [BlogController::class, 'languagefilter']);

Route::get('/chambers', [ChamberController::class, 'chamber'])->name('chambers');

Route::get('/appointment', [AppointmentController::class, 'appointment']);
Route::post('checkout', [AppointmentController::class, 'addappointment']);

Route::post('paymentlinkcreate', [PhonepeController::class, 'paymentlinkcreate']);

Route::get('contactus', [ContactusController::class, 'contactus']);
Route::post('addcontactus', [ContactusController::class, 'addcontactus']);

Route::get('/dailyhoroscope', [HomeController::class, 'shipping'])->name('dailyhoroscope');

//pages for
Route::get('/terms-conditions', [HomeController::class, 'terms_conditions'])->name('terms-conditions');
Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('/refund-policy', [HomeController::class, 'refund_policy'])->name('refund-policy');
Route::get('/shipping-policy', [HomeController::class, 'shipping'])->name('shipping-policy');

//payment routes
Route::get('phonepe/{id}', [PhonepeController::class, 'phonePe'])->name('phonepe');
Route::any('phonepe-response', [PhonepeController::class, 'response'])->name('response');
Route::any('booking', [PhonepeController::class, 'booking'])->name('booking');
Route::get('generate-pdf/{id}', [PhonepeController::class, 'generatePDF']);

// admin roots
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //  profile edit
    // usertype = 0 , admin
    Route::middleware(['admin'])->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        //Admin user management
        Route::get('/adminuser', [AdminController::class, 'adminuser']);
        Route::post('registeradmin', [RegisteredUserController::class, 'store']);
        Route::get('/deleteadmin', [AdminController::class, 'deleteadmin']);
        Route::get('editadmin/{id}', [AdminController::class, 'editadmin']);
        Route::post('updateadminuser', [AdminController::class, 'updateadminuser']);
    });

    // usertype = 1 , subadmin
    Route::middleware(['subadmin'])->group(function () {

        //Admin chamber management
        Route::get('/adminchember', [ChamberController::class, 'adminchamber']);
        Route::post('addchamber', [ChamberController::class, 'addchamber']);
        Route::get('/deletechamber', [ChamberController::class, 'deletechamber']);
        Route::get('editchamber/{id}', [ChamberController::class, 'editchamber']);
        Route::post('updatechamber', [ChamberController::class, 'updatechamber']);

        // Manage banner and videos
        Route::get('/managebannervideo', [BannerVideoController::class, 'managebannervideo']);
        Route::post('addbannervideo', [BannerVideoController::class, 'addbannervideo']);
        Route::get('/deletebannervideo', [BannerVideoController::class, 'deletebannervideo']);
        Route::get('editbannervideo/{id}', [BannerVideoController::class, 'editbannervideo']);
        Route::post('updatebannervideo', [BannerVideoController::class, 'updatebannervideo']);

        //horoscope
        Route::get('/adminhoroscope', [HoroscopesController::class, 'adminshow']);
        Route::get('/horoscopedata', [HoroscopesController::class, 'horoscopedata']);
        Route::post('updatehoroscope', [HoroscopesController::class, 'updatehoroscope']);
        Route::post('import', [HoroscopesController::class, 'updatehoroscope']);
        Route::post('export', [HoroscopesController::class, 'updatehoroscope']);


        Route::get('/zodiacsigns', [ZodiacController::class, 'zodiacsigns']);
        Route::post('updatezodiacimage', [ZodiacController::class, 'updatezodiacimage']);

    });

    // usertype = 2 , seo
    Route::middleware(['seo'])->group(function () {

        // seo details and alt tag for every image
        Route::get('/alttag', [AlttagController::class, 'alttag']);
        // add edit alt tag for every images of the website mainly service ,blog ,banner video thumbnail, about us page
        Route::post('updatealttag', [AlttagController::class, 'updatealttag']);
        //seo detail page.
        Route::get('/seodetails', [SeodetailsController::class, 'seodetails']);
        Route::get('editseo/{pagetype}/{nameurl}', [SeodetailsController::class, 'editseo']);
        Route::post('updateseo', [SeodetailsController::class, 'updateseo']);
        Route::post('xmlupload', [SeodetailsController::class, 'xmlupload']);

        //Manage Social Links
        Route::get('/adminsocial', [SocialController::class, 'adminsocial']);
        Route::post('addsociallink', [SocialController::class, 'addsociallink']);
        Route::get('/visibilitylink', [SocialController::class, 'visibilitylink']);
        Route::get('/addeditsocials', [SocialController::class, 'addeditsocials']);

        //manage blog
        Route::get('/manageblog', [BlogController::class, 'manageblog']);
        Route::post('addblog', [BlogController::class, 'addblog']);
        Route::get('/deleteblog', [BlogController::class, 'deleteblog']);
        Route::get('editblog/{id}', [BlogController::class, 'editblog']);
        Route::post('updateblog', [BlogController::class, 'updateblog']);
    });

    // usertype = 4 , appointment
    Route::middleware(['appointment'])->group(function () {
        //appoinment 
        Route::get('/adminappointment', [AppointmentController::class, 'adminappointment']);
        Route::get('/appoinmentdetails/{id}', [AppointmentController::class, 'adminappoinmentdetails']);
        // Route::get('/paymentlinkcreateform/{id}', [AppointmentController::class, 'paymentlinkcreateform']);
        Route::get('/adminclient', [AdminController::class, 'adminclient']);

        Route::get('/managepayment', [PhonepeController::class, 'managepayment']);
        Route::post('updatepaymentdetails', [PhonepeController::class, 'create']);

    });

    // usertype = 5 , blog
    Route::middleware(['blog'])->group(function () {

        //manage blog
        Route::get('/manageblog', [BlogController::class, 'manageblog']);
        Route::post('addblog', [BlogController::class, 'addblog']);
        Route::get('/deleteblog', [BlogController::class, 'deleteblog']);
        Route::get('editblog/{id}', [BlogController::class, 'editblog']);
        Route::post('updateblog', [BlogController::class, 'updateblog']);

        //manage about us and contact us details
        Route::get('/manageaboutcontactus', [AboutContactController::class, 'manageaboutcontactus']);
        Route::post('updateaboutus', [AboutContactController::class, 'updateaboutus']);
        Route::post('updatecontactus', [AboutContactController::class, 'updatecontactus']);

        //manage contact us page form details
        Route::get('/managecontactus', [ContactusController::class, 'managecontactus']);
        Route::get('/deletecontactdetails', [ContactusController::class, 'deletecontactdetails']);

        //Admin service management
        Route::get('/adminservice', [ServiceController::class, 'adminservice']);
        Route::post('addservice', [ServiceController::class, 'addservice']);
        Route::get('editservice/{id}', [ServiceController::class, 'editservice']);
        Route::get('/deleteservice', [ServiceController::class, 'deleteservice']);
        Route::post('updateservice', [ServiceController::class, 'updateservice']);

        //review managements
        Route::get('/adminreviewmanage', [ReviewsectionController::class, 'index']);
        Route::post('addcustomerreview', [ReviewsectionController::class, 'addcustomerreview']);
        Route::get('editreview/{id}', [ReviewsectionController::class, 'editreview']);
        Route::post('updatereview', [ReviewsectionController::class, 'updatereview']);
        Route::get('/deletereview', [ReviewsectionController::class, 'destroy']);
    });
});

require __DIR__ . '/auth.php';
