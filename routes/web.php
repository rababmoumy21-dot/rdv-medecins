<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\CreneauController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\CalendarController;



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('specialites', SpecialiteController::class);

Route::get('medecins/{medecin}/reassign', [MedecinController::class, 'showReassignForm'])
    ->name('medecins.reassign.form');

Route::post('medecins/{medecin}/reassign', [MedecinController::class, 'reassignAndDelete'])
    ->name('medecins.reassign.submit');
Route::resource('medecins', MedecinController::class);


    
Route::resource('creneaux', CreneauController::class);


Route::delete('/rendezvous/{rendezvous}', [RendezVousController::class, 'destroy'])
    ->name('rendezvous.destroy'); 
Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
Route::get('/rendezvous/create', [RendezVousController::class, 'create'])->name('rendezvous.create');

Route::resource('patients', PatientController::class);

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
Route::get('/calendar/events', [CalendarController::class, 'events']);

