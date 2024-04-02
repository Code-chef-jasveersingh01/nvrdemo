<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\NvrController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [ProfileController::class, 'login'])->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(
    [
        'middleware' => ['auth'],

    ],
    function () {
            #admin profile route
            Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
            Route::get('/profile', [HomeController::class, 'profile'])->name('admin.profile');
            Route::post('/profile/update', [HomeController::class, 'updateProfile'])->name('admin.updateProfile');
            Route::post('/profile/update-profile-image', [HomeController::class, 'updateProfileImage'])->name('admin.updateProfileImage');
            Route::get('/change-password', [HomeController::class, 'changePassword'])->name('admin.changePassword');
            Route::post('/change-password/store', [HomeController::class, 'changePasswordStore'])->name('admin.changePasswordStore');
            Route::post('/notification', [HomeController::class, 'newOrderNotification'])->name('admin.newOrderNotification');
            Route::post('/mark-as-read', [HomeController::class, 'markNotification'])->name('admin.markNotification');
            Route::get('/change-language/{lang}',[HomeController::class, 'changeLanguage'])->name('admin.changeLanguage');


            Route::group(['prefix' => 'settings',], function () {
                #configuration route
                Route::group(['prefix' => 'configuration',], function () {
                Route::get('/index', [ConfigurationController::class, 'index'])->name('admin.indexConfiguration');
                Route::get('/nvr-details', [ConfigurationController::class, 'nvrDetails'])->name('admin.nvrDetails');
                Route::post('/set-nvr-details', [ConfigurationController::class, 'setNvrDetails'])->name('admin.setNvrDetails');

                Route::post('/store-payment-method', [ConfigurationController::class, 'paymentMethodStore'])->name('admin.paymentMethodStoreConfiguration');
            });
        });

        #face route
        Route::group(['prefix' => 'face',], function () {
            Route::get('/list', [FaceController::class, 'index'])->name('admin.faceList');
            Route::get('/add-face-form', [FaceController::class, 'getAddFaceForm'])->name('admin.getAddFaceForm');
            Route::post('/add-face', [FaceController::class, 'addFace'])->name('admin.addFace');

            Route::get('/view/{uuid}', [FaceController::class, 'viewFace'])->name('admin.viewFace');
            Route::get('/edit/{uuid}', [FaceController::class, 'editFace'])->name('admin.editFace');
            Route::post('/face-image/{uuid}', [FaceController::class, 'updateFaceImage'])->name('admin.updateFaceImage');
            Route::post('/edit/{uuid}', [FaceController::class, 'updateFace'])->name('admin.updateFace');
            Route::delete('/delete/{id}', [FaceController::class, 'destroyFace'])->name('admin.destroyFace');
            Route::get('/deleted-face-info', [FaceController::class, 'deletedFaceInfo'])->name('admin.deletedFaceInfo');
            Route::post('/restore-face', [FaceController::class, 'restoreDeletedFace'])->name('admin.restoreDeletedFace');
            Route::delete('/force-delete-face/{id}', [FaceController::class, 'forceDeleteFace'])->name('adminforceDeleteFace');
        });

        Route::group(['prefix' => 'dataTable'],
            function () {
                Route::get('/face-list-table', [FaceController::class, 'dataTableFaceListTable'])->name('dataTable.dataTableFacesListTable');
            }
        );
    }

);

Route::group(['prefix' => 'nvr',], function () {
    Route::get('/web-login', [NvrController::class, 'nvrWebLogin'])->name('admin.nvrWebLogin');
    Route::get('/web-logout', [NvrController::class, 'nvrWebLogout'])->name('admin.nvrWebLogout');
    Route::get('/heartbeat', [NvrController::class, 'nvrHeartbeat'])->name('admin.nvrHeartbeat');
    Route::get('/add-face', [FaceController::class, 'addFaceApi'])->name('admin.addFaceApi');
});



require __DIR__.'/auth.php';
