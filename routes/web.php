<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GuideController;
use App\Models\About;
use App\Models\Contact;
use App\Models\Guide;
use App\Models\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    $homes = Home::orderBy('id', 'DESC')->limit(4)->get();
    return view('compro.index', compact('homes'));
})->name('home.index');

Route::get('about', function () {
    $about = About::orderBy('id', 'DESC')->first();
    $guides = Guide::orderBy('id', 'DESC')->get();
    return view('compro.about', compact('about', 'guides'));
})->name('about.index');

Route::get('courses', function () {
    return view('compro.courses');
})->name('courses.index');

Route::get('testimonial', function () {
    return view('compro.testimonial');
})->name('testimonial.index');

Route::get('team', function () {
    return view('compro.team');
})->name('team.index');

Route::get('contact', function () {
    return view('compro.contact');
})->name('contact.index');

Route::get('login', function () {
    return view('admin.login');
})->name('login.index');


//login and logout

Route::get('login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('action-login', [\App\Http\Controllers\LoginController::class, 'actionLogin'])->name('action-login');
Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

//auth google
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.app');
    });

    Route::get('homeadmin', [HomeController::class, 'index'])->name('homeadmin.index');
    Route::get('homeadmin/create', [HomeController::class, 'create'])->name('homeadmin.create');
    Route::post('homeadmin/store', [HomeController::class, 'store'])->name('homeadmin.store');
    Route::get('homeadmin/edit/{id}', [HomeController::class, 'edit'])->name('homeadmin.edit');
    Route::put('homeadmin/update/{id}', [HomeController::class, 'update'])->name('homeadmin.update');
    Route::delete('homeadmin/destroy/{id}', [HomeController::class, 'destroy'])->name('homeadmin.destroy');
    Route::resource('aboutadmin', AboutController::class);
    Route::delete('aboutadmin/destroy/{id}', [AboutController::class, 'destroy'])->name('aboutadmin.destroy');
    Route::resource('guideadmin', GuideController::class);
    Route::delete('guideadmin/destroy/{id}', [GuideController::class, 'destroy'])->name('guideadmin.destroy');

    //contact route
    Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');
    Route::get('contactadmin/index', [ContactController::class, 'index'])->name('contactadmin.index');
    Route::post('contactadmin/reply/{id}', [ContactController::class, 'reply'])->name('contactadmin.reply');
    Route::delete('contactadmin/destroy/{id}', [ContactController::class, 'destroy'])->name('contactadmin.destroy');
});



