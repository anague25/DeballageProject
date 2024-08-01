<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create-storage-link', function () {
    // Chemin vers le dossier public
    $publicPath = public_path('storage');

    // Chemin vers le dossier de stockage
    $storagePath = storage_path('app/public');

    // Vérifie si le lien symbolique existe déjà
    if (!file_exists($publicPath)) {
        // Crée le lien symbolique
        symlink($storagePath, $publicPath);
        return 'Lien symbolique créé avec succès.';
    } else {
        return 'Le lien symbolique existe déjà.';
    }
});
