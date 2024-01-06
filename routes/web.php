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
        Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
        Route::get('/sekejap', [\App\Http\Controllers\DashboardController::class, 'sekejap']);
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
                Route::post('/{idIndikatorRksmkk}', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'storeSubIndikatorRksmkk']);
                Route::get('/{idIndikatorRksmkk}/sub', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'getSubIndicatorRksmkk']);
                Route::get('/get-rksmkk', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'getIndicatorRksmkk']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'deleteIndicatorRksmkk']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorSmkkController::class, 'deleteSubIndicatorRksmkk']);
            }
        );

        Route::prefix('/indikator-smkk-v2')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'index'])->name('indicator.smkk.v2');
                Route::match(['post', 'get'], '/{id}/detail', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'detail'])->name('indicator.smkk.v2.detail');
                Route::get( '/{id}/edit', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'edit'])->name('indicator.smkk.v2.edit');
                Route::post( '/patch', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'patch'])->name('indicator.smkk.v2.patch');
                Route::post( '/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'destroy'])->name('indicator.smkk.v2.destroy');
                Route::post('/indicators', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'add_indicator'])->name('indicator.smkk.v2.indicator');
                Route::post('/sub-indicators', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'sub_indicator'])->name('indicator.smkk.v2.sub-indicator');
                Route::match(['post', 'get'],'/sub-stage/{id}', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'get_sub_stage'])->name('indicator.smkk.v2.sub-stage.detail');
                Route::match(['post', 'get'],'/indicators/{id}', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'get_indicator'])->name('indicator.smkk.v2.indicator.detail');
                Route::match(['post', 'get'],'/sub-indicators/{id}', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'get_sub_indicator'])->name('indicator.smkk.v2.sub-indicator.detail');
                Route::post('/sub-stage/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'destroy_sub_stage'])->name('indicator.smkk.v2.sub-stage.destroy');
                Route::post('/indicators/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'destroy_indicator'])->name('indicator.smkk.v2.indicator.destroy');
                Route::post('/sub-indicators/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorSMKKV2Controller::class, 'destroy_sub_indicator'])->name('indicator.smkk.v2.sub-indicator.destroy');
            }
        );

        Route::prefix('/indikator-rkkkonsultan')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorRkkkonsultanController::class, 'index']);
                Route::post('/{idIndikatorRkkkonsultan}', [\App\Http\Controllers\Superadmin\IndicatorRkkkonsultanController::class, 'storeSubIndikatorRkkkonsultan']);
                Route::get('/{idIndikatorRkkkonsultan}/sub', [\App\Http\Controllers\Superadmin\IndicatorRkkkonsultanController::class, 'getSubIndicatorRkkkonsultan']);
                Route::get('/get-rkkkonsultan', [\App\Http\Controllers\Superadmin\IndicatorRkkkonsultanController::class, 'getIndicatorRkkkonsultan']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorRkkkonsultanController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkkkonsultanController::class, 'deleteIndicatorRkkkonsultan']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkkkonsultanController::class, 'deleteSubIndicatorRkkkonsultan']);
            }
        );

        Route::prefix('/indikator-rkkkontraktor')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorRkkkontraktorController::class, 'index']);
                Route::post('/{idIndikatorRkkkontraktor}', [\App\Http\Controllers\Superadmin\IndicatorRkkkontraktorController::class, 'storeSubIndikatorRkkkontraktor']);
                Route::get('/{idIndikatorRkkkontraktor}/sub', [\App\Http\Controllers\Superadmin\IndicatorRkkkontraktorController::class, 'getSubIndicatorRkkkontraktor']);
                Route::get('/get-rkkkontraktor', [\App\Http\Controllers\Superadmin\IndicatorRkkkontraktorController::class, 'getIndicatorRkkkontraktor']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorRkkkontraktorController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkkkontraktorController::class, 'deleteIndicatorRkkkontraktor']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkkkontraktorController::class, 'deleteSubIndicatorRkkkontraktor']);
            }
        );

        Route::prefix('/indikator-rmpkpm')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorRmpkpmController::class, 'index']);
                Route::post('/{idIndikatorRmpkpm}', [\App\Http\Controllers\Superadmin\IndicatorRmpkpmController::class, 'storeSubIndikatorRmpkpm']);
                Route::get('/{idIndikatorRmpkpm}/sub', [\App\Http\Controllers\Superadmin\IndicatorRmpkpmController::class, 'getSubIndicatorRmpkpm']);
                Route::get('/get-rmpkpm', [\App\Http\Controllers\Superadmin\IndicatorRmpkpmController::class, 'getIndicatorRmpkpm']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorRmpkpmController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorRmpkpmController::class, 'deleteIndicatorRmpkpm']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorRmpkpmController::class, 'deleteSubIndicatorRmpkpm']);
            }
        );

        Route::prefix('/indikator-rmllp')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorRmllpController::class, 'index']);
                Route::post('/{idIndikatorRmllp}', [\App\Http\Controllers\Superadmin\IndicatorRmllpController::class, 'storeSubIndikatorRmllp']);
                Route::get('/{idIndikatorRmllp}/sub', [\App\Http\Controllers\Superadmin\IndicatorRmllpController::class, 'getSubIndicatorRmllp']);
                Route::get('/get-rmllp', [\App\Http\Controllers\Superadmin\IndicatorRmllpController::class, 'getIndicatorRmllp']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorRmllpController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorRmllpController::class, 'deleteIndicatorRmllp']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorRmllpController::class, 'deleteSubIndicatorRmllp']);
            }
        );

        Route::prefix('/indikator-rkpplkontraktor')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorRkpplkontraktorController::class, 'index']);
                Route::post('/{idIndikatorRkpplkontraktor}', [\App\Http\Controllers\Superadmin\IndicatorRkpplkontraktorController::class, 'storeSubIndikatorRkpplkontraktor']);
                Route::get('/{idIndikatorRkpplkontraktor}/sub', [\App\Http\Controllers\Superadmin\IndicatorRkpplkontraktorController::class, 'getSubIndicatorRkpplkontraktor']);
                Route::get('/get-rkpplkontraktor', [\App\Http\Controllers\Superadmin\IndicatorRkpplkontraktorController::class, 'getIndicatorRkpplkontraktor']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorRkpplkontraktorController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkpplkontraktorController::class, 'deleteIndicatorRkpplkontraktor']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkpplkontraktorController::class, 'deleteSubIndicatorRkpplkontraktor']);
            }
        );

        Route::prefix('/indikator-rkpplpengawasan')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorRkpplpengawasanController::class, 'index']);
                Route::post('/{idIndikatorRkpplpengawasan}', [\App\Http\Controllers\Superadmin\IndicatorRkpplpengawasanController::class, 'storeSubIndikatorRkpplpengawasan']);
                Route::get('/{idIndikatorRkpplpengawasan}/sub', [\App\Http\Controllers\Superadmin\IndicatorRkpplpengawasanController::class, 'getSubIndicatorRkpplpengawasan']);
                Route::get('/get-rkpplpengawasan', [\App\Http\Controllers\Superadmin\IndicatorRkpplpengawasanController::class, 'getIndicatorRkpplpengawasan']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorRkpplpengawasanController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkpplpengawasanController::class, 'deleteIndicatorRkpplpengawasan']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkpplpengawasanController::class, 'deleteSubIndicatorRkpplpengawasan']);
            }
        );

        Route::prefix('/indikator-rkpplperencanaan')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorRkpplperencanaanController::class, 'index']);
                Route::post('/{idIndikatorRkpplperencanaan}', [\App\Http\Controllers\Superadmin\IndicatorRkpplperencanaanController::class, 'storeSubIndikatorRkpplperencanaan']);
                Route::get('/{idIndikatorRkpplperencanaan}/sub', [\App\Http\Controllers\Superadmin\IndicatorRkpplperencanaanController::class, 'getSubIndicatorRkpplperencanaan']);
                Route::get('/get-rkpplperencanaan', [\App\Http\Controllers\Superadmin\IndicatorRkpplperencanaanController::class, 'getIndicatorRkpplperencanaan']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorRkpplperencanaanController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkpplperencanaanController::class, 'deleteIndicatorRkpplperencanaan']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorRkpplperencanaanController::class, 'deleteSubIndicatorRkpplperencanaan']);
            }
        );

        Route::prefix('/indikator-atj')->middleware('roles:superuser,admin')->group(
            function () {
                Route::match(['post', 'get'], '/', [\App\Http\Controllers\Superadmin\IndicatorAtjController::class, 'index']);
                Route::post('/{idIndikatorAtj}', [\App\Http\Controllers\Superadmin\IndicatorAtjController::class, 'storeSubIndikatorAtj']);
                Route::get('/{idIndikatorAtj}/sub', [\App\Http\Controllers\Superadmin\IndicatorAtjController::class, 'getSubIndicatorAtj']);
                Route::get('/get-atj', [\App\Http\Controllers\Superadmin\IndicatorAtjController::class, 'getIndicatorAtj']);
                Route::get('/get-sum', [\App\Http\Controllers\Superadmin\IndicatorAtjController::class, 'getTotalBobot']);
                Route::get('/{id}/delete', [\App\Http\Controllers\Superadmin\IndicatorAtjController::class, 'deleteIndicatorAtj']);
                Route::get('/{id}/sub/{subid}/delete', [\App\Http\Controllers\Superadmin\IndicatorAtjController::class, 'deleteSubIndicatorAtj']);
            }
        );

//        Route::prefix('/indikator-pengawas')->middleware('roles:superuser,admin')->group(
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
//                Route::post('/set-score', [\App\Http\Controllers\PerlamController::class, 'setScore']);

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


        Route::prefix('/smkk')->group(
            function () {
                Route::get('/', [\App\Http\Controllers\SmkkController::class, 'index']);
                Route::get('/datatable-package-ongoing', [\App\Http\Controllers\SmkkController::class, 'datatable']);
                //Route::get('/datatable-package-ongoing', [\App\Http\Controllers\DashboardController::class, 'datatable']);
                Route::get('/detail/{id}', [\App\Http\Controllers\SmkkController::class, 'detail']);
                Route::get('/results', [\App\Http\Controllers\SmkkController::class, 'getScore']);
                Route::get('/resultsrkkkonsultan', [\App\Http\Controllers\SmkkController::class, 'getScoreKonsultan']);
                Route::get('/resultsrkkkontraktor', [\App\Http\Controllers\SmkkController::class, 'getScoreKontraktor']);
                Route::get('/resultsrmpkpm', [\App\Http\Controllers\SmkkController::class, 'getScoreRmpkpm']);
                Route::get('/resultsrmllp', [\App\Http\Controllers\SmkkController::class, 'getScoreRmllp']);
                Route::get('/resultsrkpplkontraktor', [\App\Http\Controllers\SmkkController::class, 'getScoreRkpplkontraktor']);
                Route::get('/resultsrkpplperencanaan', [\App\Http\Controllers\SmkkController::class, 'getScoreRkpplperencanaan']);
                Route::get('/resultsrkpplpengawasan', [\App\Http\Controllers\SmkkController::class, 'getScoreRkpplpengawasan']);
                Route::get('/resultsatj', [\App\Http\Controllers\SmkkController::class, 'getScoreAtj']);
                Route::get('/resultskomulatif', [\App\Http\Controllers\SmkkController::class, 'getScoreKomulatif']);
                Route::post('/setscore', [\App\Http\Controllers\SmkkController::class, 'setScore']);
                Route::post('/setscorerkkkonsultan', [\App\Http\Controllers\SmkkController::class, 'setScoreRkkkonsultan']);
                Route::post('/setscorerkkkontraktor', [\App\Http\Controllers\SmkkController::class, 'setScoreRkkkontraktor']);
                Route::post('/setscorermpkpm', [\App\Http\Controllers\SmkkController::class, 'setScoreRmpkpm']);
                Route::post('/setscorermllp', [\App\Http\Controllers\SmkkController::class, 'setScoreRmllp']);
                Route::post('/setscorerkpplkontraktor', [\App\Http\Controllers\SmkkController::class, 'setScoreRkpplkontraktor']);
                Route::post('/setscorerkpplpengawasan', [\App\Http\Controllers\SmkkController::class, 'setScoreRkpplpengawasan']);
                Route::post('/setscorerkpplperencanaan', [\App\Http\Controllers\SmkkController::class, 'setScoreRkpplperencanaan']);
                Route::post('/setscoreatj', [\App\Http\Controllers\SmkkController::class, 'setScoreAtj']);
                Route::post('/upload', [\App\Http\Controllers\SmkkController::class, 'uploadFile']);

            }
        );

        Route::group(['prefix' => 'smkk-v2'], function () {
            Route::get('/', [\App\Http\Controllers\SmkkV2Controller::class, 'index'])->name('score.smkk-v2');
            Route::match(['post', 'get'],'/{id}', [\App\Http\Controllers\SmkkV2Controller::class, 'package_page'])->name('score.smkk-v2.package');
            Route::match(['post', 'get'],'/{id}/score/{stage_id}', [\App\Http\Controllers\SmkkV2Controller::class, 'score_page'])->name('score.smkk-v2.score');
            Route::post('/{id}/file', [\App\Http\Controllers\SmkkV2Controller::class, 'uploadScoreFile'])->name('score.smkk-v2.score.file');
            Route::match(['post', 'get'],'/{id}/score/{stage_id}/description', [\App\Http\Controllers\SmkkV2Controller::class, 'setDescription'])->name('score.smkk-v2.score.description');
        });


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

