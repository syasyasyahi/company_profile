<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\GuideController;
use App\Models\About;
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

Route::get('dashboard', function () {
    return view('admin.app');
});

Route::get('homeadmin', [HomeController::class, 'index'])->name('homeadmin.index');
Route::get('homeadmin/create', [HomeController::class, 'create'])->name('homeadmin.create');
Route::post('homeadmin/store', [HomeController::class, 'store'])->name('homeadmin.store');
Route::get('homeadmin/edit/{id}', [HomeController::class,'edit'])->name('homeadmin.edit');
Route::put('homeadmin/update/{id}',[HomeController::class, 'update'])->name('homeadmin.update');
Route::delete('homeadmin/destroy/{id}', [HomeController::class, 'destroy'])->name('homeadmin.destroy');
Route::resource('aboutadmin', AboutController::class);
Route::delete('aboutadmin/destroy/{id}', [AboutController::class, 'destroy'])->name('aboutadmin.destroy');
Route::resource('guideadmin', GuideController::class);
Route::delete('guideadmin/destroy/{id}', [GuideController::class, 'destroy'])->name('guideadmin.destroy');
