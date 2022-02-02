<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductDetailController;
use App\Models\User;
use App\Http\Controllers\AlatController;
use App\Models\Status_kekeruhan;
use App\Models\Kekeruhan;
use App\Http\Controllers\LoginController; // step 1
use App\Http\Controllers\DashboardController;



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
// Route::get('/', function () {
//     return view('welcome');
//     });

    // Route::post('/login', function () {
    //     return view('Pengguna.Login');
    // })->name('login');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/postlogin', 'LoginController@postlogin')->name('postlogin');
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::get('/firebase','FirebaseController@index');
    Route::get('/firebase-store','FirebaseController@store');
    Route::get('/send', [EventController::class, 'index']);
    Route::get('/test', function () {
        event(new App\Events\Kekeruhan('Someone'));
        return "Event has been sent!";
    });



Route::middleware(['auth','ceklevel:admin'])->group(function () {
    Route::get('/data-daerah','AlatController@index')->name('data-daerah');
    Route::get('/tambah-titik','AlatController@create')->name('tambah-titik');
    Route::post('/simpan-titik','AlatController@store')->name('simpan-titik');
    Route::get('/edit-titik/{id}','AlatController@edit')->name('edit-titik');
    Route::post('/update-titik/{id}','AlatController@update')->name('update-titik');
    Route::get('/delete-titik/{id}','AlatController@destroy')->name('delete-titik');
});

Route::middleware(['auth','ceklevel:admin,user'])->group(function () {
    Route::get('/dashboard', 'DashboardController@dataTerakhir')->name('dashboard');
    Route::get('/keasaman-air','PhController@index')->name('keasaman-air');
    // Route::get('/rekap-asam','RekapAsamController@index')->name('rekap-asam');
    // Route::get('data/records', 'RekapAsamController@records')->name('data-records');
    // Route::post('/filter-asam','RekapAsamController@index')->name('filter-asam');
    Route::get('/kekeruhan-air','KekeruhanController@index')->name('kekeruhan-air');
    // Route::get('/rekap-keruh','RekapKeruhController@index')->name('rekap-keruh');
    Route::get('/cetak-data-keasaman-form','RekapAsamController@cetakform')->name('cetak-data-keasaman-form');
    // Route::get('/cetak-data-pertanggal/{tglawal}/{tglakhir}','RekapAsamController@cetakDataPertanggal')->name('cetak-data-pertanggal');
    Route::get('/cetak-data-kekeruhan-form','RekapKeruhController@cetakform')->name('cetak-data-kekeruhan-form');
    // Route::get('/cetak-data-pertanggal/{tglawal}/{tglakhir}','RekapKeruhController@cetakDataPertanggal')->name('cetak-data-pertanggal');
    Route::post('/cetak-data-keasaman-pertanggal','RekapAsamController@cetakDataPertanggal')->name('cetak-data-keasaman-pertanggal');
    Route::post('/cetak-data-kekeruhan-pertanggal','RekapKeruhController@cetakDataPertanggal')->name('cetak-data-kekruhan-pertanggal');

    Route::post('/save-token', [DashboardController::class, 'saveToken'])->name('save-token');
    Route::post('/send-notification', [DashboardController::class, 'sendNotification'])->name('send.notification');

    // Route::post('/cetak-data-pertanggal2/{tglawal}/{tglakhir}','RekapAsamController@cetakDataPertanggal2')->name('cetak-data-pertanggal2');


    // Route::get('/rekap-keruh','RekapKeruhController@index')->name('rekap-keruh');
    // Route::get('/rekap-keruh','RekapKeruhController@searc')->name('search');
});

// Route::get('/keasaman-air', function () {
//     return view('content.keasaman');
// });

// Route::get('/kekeruhan-air', function () {
//     return view('content.kekeruhan');
// });


Route::get('/data-titik', function () {
    return view('content.admin');
});

// Route::get('/rekap-asam', function () {
//     return view('content.rekapasam');
// });

// Route::get('/rekap-keruh', function () {
//     return view('content.rekapkeruh');
// });

Route::get('/admin',function(){
    return view('admin.dashboardadmin');
});

Route::get('/tambah-titik', function () {
    return view('admin.tambah');
});
// Route::get('/daerah', function () {
//     return view('admin.daerah');
// });

// Route::get('/tambah-titik', function () {
//     return view('admin.tambah');
// });

// Route::resource('/daerah', AlatController::class);

Route::get('/edit-titik', function () {
    return view('admin.edit');
});

Route::get('/users/{id_user}', function ($id_user) {
    $user = User::with('role')->find($id_user);
    return response()->json($user, 200);
});

// Route::get('/status_kekeruhan/{status_kekeruhan}', function ($id_kekeruhan) {
//     $status_kekeruhan = StatusKekeruhan::with('kekeruhan')->find($id_status_kekeruhan);
//     return response()->json($status_kekeruhan, 200);
// });

// Route::get('/tes_status_keruh', 'StatusKeruhController@index');


// Route::get('tes', 'RekapAsamController@index')->name('tes');

