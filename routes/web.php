<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ApplyNowController;
use App\Http\Controllers\SitemapController;

use App\Http\Controllers\AboutUsController;
// use App\Mail\ApplicationReceived;
// use App\Models\Application;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;
use Termwind\Components\Raw;

// Route::get('/emails/{file}',function($file){
//     return view('emails.'.$file,['application' => ContactUs::find(1)]);
// });

// Mail::to(config('app.config.emails.info'))->send(new ApplicationReceived(Application::find(1)));

Route::get('/generate-sitemap', [SitemapController::class,'generate'])->name('generate-sitemap');

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/about-us', [AboutUsController::class,'index'])->name('about-us');

Route::resource('contact-us', ContactUsController::class);

Route::get('/apply-now', [ApplyNowController::class,'index'])->name('apply-now');
Route::post('/apply-now', [ApplyNowController::class,'submit'])->name('apply-now.submit');

Route::get('/services/details/{url}', [ServiceController::class,'details'])->name('service-details');

require __DIR__.'/settings.php';


Route::fallback(function () {
    return Inertia::render('Errors/404')->toResponse(request())->setStatusCode(404);
});

Route::get('/test-mail', function () {
    Mail::raw('Test email working!', function ($message) {
        $message->to('rj.hemantjangid@gmail.com')
                ->subject('Test Mail');
    });

    return 'Mail sent!';
});