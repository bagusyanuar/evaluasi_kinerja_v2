<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'pageLogin'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

Route::get('/indicators', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'index']);
//Route::get('/indicator-smkk-kontraktor', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'index']);
//Route::get('/indicator-smkk-pengawas', [\App\Http\Controllers\Superadmin\IndicatorPengawasController::class, 'index']);
Route::get('/package', [\App\Http\Controllers\PackageController::class, 'index']);
Route::get('/ppk', [\App\Http\Controllers\PPKController::class, 'index']);
Route::get('/accessor-ppk', [\App\Http\Controllers\AccessorPpkController::class, 'index']);
Route::post('/accessor-ppk/create', [\App\Http\Controllers\AccessorPpkController::class, 'store']);

Route::get(
    '/login',
    function () {
        return view('login');
    }
);

Route::prefix('/')->middleware('auth')->group(
    function () {
        Route::get('/',[\App\Http\Controllers\DashboardController::class,'index']);
        Route::get('/show-notif', [\App\Http\Controllers\NotificationController::class, 'notif']);
        Route::get('/show-notif-unread', [\App\Http\Controllers\NotificationController::class, 'notifUnread']);
        Route::get('/vendor', [\App\Http\Controllers\VendorController::class, 'getVendorPackage']);
        Route::get('/get-count-dashboard', [\App\Http\Controllers\DashboardController::class, 'getAllCountData']);
        Route::get('/datatable-package-ongoing', [\App\Http\Controllers\DashboardController::class, 'datatable']);


        Route::prefix('/users')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\UserController::class, 'index']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\UserController::class, 'delete']);
                Route::get('/count', [\App\Http\Controllers\Superadmin\UserController::class, 'getCountUser']);
                Route::get('/datatable/{role}', [\App\Http\Controllers\Superadmin\UserController::class, 'datatable'])->name('user_datatable');
                Route::get('/count-all', [\App\Http\Controllers\Superadmin\UserController::class, 'getAllCountUser']);
                Route::get('/detail', [\App\Http\Controllers\Superadmin\UserController::class, 'getDetailUser']);
            }
        );

        Route::prefix('/ppk')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\PPKController::class, 'index']);
                Route::get('/get-all', [\App\Http\Controllers\Superadmin\PPKController::class, 'getPPK']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\PPKController::class, 'delete']);
                Route::get('/datatable', [\App\Http\Controllers\Superadmin\PPKController::class, 'datatable']);
            }
        );
        Route::get('/package/data-detail', [\App\Http\Controllers\PackageController::class, 'getDetailPackage']);
        Route::prefix('/paket-konstruksi')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\PackageController::class, 'index']);
                Route::match(['post', 'get'], '/detail/{id}', [\App\Http\Controllers\PackageController::class, 'detail']);
                Route::get('/datatable', [\App\Http\Controllers\PackageController::class, 'datatable'])->name('package_datatable');
                Route::get('/addendum-datatable/{id}', [\App\Http\Controllers\PackageController::class, 'datatableAddendum']);

                Route::post('/addendum/add', [\App\Http\Controllers\PackageController::class, 'addDetail']);
            }
        );

        Route::prefix('/indikator')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'index']);
                Route::post('/{idIndikator}', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'storeSubIndikator']);
                Route::get('/{idIndikator}/sub', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'getSubIndicator']);
                Route::get('/get-all', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'getIndicator']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'deleteIndicator']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'deleteSubIndicator']);
            }
        );

		Route::prefix('/indikator-smkk')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'index']);
                Route::post('/{idIndikator}', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'storeSubIndikator']);
                Route::get('/{idIndikator}/sub', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'getSubIndicator']);
                Route::get('/get-all', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'getIndicator']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'deleteIndicator']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'deleteSubIndicator']);
            }
        );

        Route::prefix('/indikator-smkk-v2')->middleware('roles:superuser,admin')->group(
            function (){
                Route::get('/', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'index']);
            }
        );
//		Route::prefix('/indikator-pengawas')->middleware('roles:superuser,admin')->group(
//            function () {
//                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorPengawasController::class, 'index']);
//                Route::post('/{idIndikator}', [\App\Http\Controllers\Superadmin\IndicatorPengawasController::class, 'storeSubIndikator']);
//                Route::get('/{idIndikator}/sub', [\App\Http\Controllers\Superadmin\IndicatorPengawasController::class, 'getSubIndicator']);
//                Route::get('/get-all', [\App\Http\Controllers\Superadmin\IndicatorPengawasController::class, 'getIndicator']);
//                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorPengawasController::class, 'getTotalBobot']);
//                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorPengawasController::class, 'deleteIndicator']);
//                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorPengawasController::class, 'deleteSubIndicator']);
//            }
//        );


        Route::prefix('/penilaian')->group(
            function () {
                Route::get('/', [\App\Http\Controllers\ScoreController::class, 'index']);
                Route::get('/datatable', [\App\Http\Controllers\ScoreController::class, 'datatable']);
                Route::get('/datatable/vendor/{id}', [\App\Http\Controllers\ScoreController::class, 'datatableByVendorId']);
//                Route::get('/detail/{id}', [\App\Http\Controllers\ScoreController::class, 'detail']);
                Route::get('/detail/{id}/comulative', [\App\Http\Controllers\ScoreController::class, 'getComutative']);
                Route::post('/upload', [\App\Http\Controllers\ScoreController::class, 'uploadFile']);
                Route::post('/add-note', [\App\Http\Controllers\ScoreController::class, 'addNote']);
                Route::get('/results', [\App\Http\Controllers\ScoreController::class, 'getScore']);
                Route::get('/last-update', [\App\Http\Controllers\ScoreController::class, 'lastUpdate']);
                Route::get('/radar', [\App\Http\Controllers\ScoreController::class, 'getRadarChart']);
                Route::post('/set-score', [\App\Http\Controllers\ScoreController::class, 'setScore']);

                Route::get('/get-history', [\App\Http\Controllers\ScoreController::class, 'getScoreHistory']);
                Route::get('/get-historyawal', [\App\Http\Controllers\ScoreController::class, 'getScoreHistoryawal']);
                Route::get('/get-all-cumulative', [\App\Http\Controllers\ScoreController::class, 'getAllCumulative']);
                Route::get('/get-last-history', [\App\Http\Controllers\ScoreController::class, 'getLastScoreHistory']);
                Route::get('/{id}/vendor', [\App\Http\Controllers\VendorController::class, 'detailVendor']);
                Route::post('/{id}/vendor/cetak', [\App\Http\Controllers\VendorController::class, 'cetakPenilaian']);
				Route::get('/{id}/vendor/package', [\App\Http\Controllers\VendorController::class, 'get_vendor_package_by_year']);
            }
        );

		Route::prefix('/perlem')->group(
            function () {
                Route::get('/', [\App\Http\Controllers\PerlemController::class, 'index']);
                Route::get('/datatable', [\App\Http\Controllers\PerlemController::class, 'datatable']);
                Route::get('/datatable/vendor/{id}', [\App\Http\Controllers\PerlemController::class, 'datatableByVendorId']);
//                Route::get('/detail/{id}', [\App\Http\Controllers\ScoreController::class, 'detail']);
                Route::get('/detail/{id}/comulative', [\App\Http\Controllers\PerlemController::class, 'getComutative']);
                Route::post('/upload', [\App\Http\Controllers\PerlemController::class, 'uploadFile']);
                Route::post('/add-note', [\App\Http\Controllers\PerlemController::class, 'addNote']);
                Route::get('/results', [\App\Http\Controllers\PerlemController::class, 'getScore']);
                Route::get('/last-update', [\App\Http\Controllers\PerlemController::class, 'lastUpdate']);
                Route::get('/radar', [\App\Http\Controllers\PerlemController::class, 'getRadarChart']);
                Route::post('/set-score', [\App\Http\Controllers\PerlamController::class, 'setScore']);

                Route::get('/get-history', [\App\Http\Controllers\PerlemController::class, 'getScoreHistory']);
                Route::get('/get-historyawal', [\App\Http\Controllers\PerlemController::class, 'getScoreHistoryawal']);
                Route::get('/get-all-cumulative', [\App\Http\Controllers\PerlemController::class, 'getAllCumulative']);
                Route::get('/get-last-history', [\App\Http\Controllers\PerlemController::class, 'getLastScoreHistory']);
                Route::get('/{id}/vendor', [\App\Http\Controllers\VendorController::class, 'detailPerlemVendor']);
                Route::post('/{id}/vendor/cetak', [\App\Http\Controllers\VendorController::class, 'cetakPenilaianPerlem']);
            }
        );

//        Route::prefix('/scoring')->group(
//            function () {
//
//            }
//        );

        Route::prefix('/peringatan')->group(
            function () {
                Route::get('/', [\App\Http\Controllers\NotificationController::class, 'index']);
                Route::get('/count', [\App\Http\Controllers\ClaimNotificationController::class, 'getCountClaim']);
                Route::post('/claim', [\App\Http\Controllers\ClaimNotificationController::class, 'store']);
                Route::get('/{type}/{id}', [\App\Http\Controllers\NotificationController::class, 'detailNotification']);
            }
        );
        Route::get(
            '/detail-penilaian',
            function () {
                return view('superuser/penilaian/detail-penilaian');
            }
        );

        Route::prefix('profile')->group(
            function () {
                Route::get(
                    '/',
                    function () {
                        return view('superuser.user.profil');
                    }
                );
                Route::post('/', [\App\Http\Controllers\ProfileController::class, 'update']);
                Route::post('update-image', [\App\Http\Controllers\ProfileController::class, 'updateImg']);
                Route::get('show', [\App\Http\Controllers\ProfileController::class, 'profile']);
                Route::get('package', [\App\Http\Controllers\ProfileController::class, 'package']);
            }
        );
    }
);

