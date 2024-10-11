<?php

use App\Livewire\Pages\Queues\Index as QueuesIndex;
use App\Livewire\Pages\Queues\Projector as QueuesProjector;
use App\Livewire\Pages\Users\Index as UsersIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/queue-projector', QueuesProjector::class)->name('queue-projector');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/queues', QueuesIndex::class)->name('queues');
    Route::get('/users', UsersIndex::class)->name('users');
});
