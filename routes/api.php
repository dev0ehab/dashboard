<?php

use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;


Route::delete('uploader/media/{media}', [MediaController::class, 'destroy'])->name('uploader.media.destroy');
