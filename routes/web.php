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

// Route::get('/', function () {
//     // return view('welcome');
//     return view('auth.login');
// });
// Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'testing' => false,
    'filemanagers' => false
]);

Route::get('/', [App\Http\Controllers\PortalController::class, 'index']);
// Route::get('payroll', [App\Http\Controllers\PortalController::class, 'payrol'])->name('portal.payroll');

Route::get('testing_login', function () {
    // return view('welcome');
    return view('auth.login3');
});

Route::get('testing2', function () {
    // return response()->json([
    //     'status' => true,
    //     'message' => 'Percobaan'
    // ]);
    return auth()->user()->departemen;
});
Route::get('testing', [App\Http\Controllers\TestingController::class, 'testingku'])->name('testing');

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('file-managers')->group(function () {
        Route::get('/', [App\Http\Controllers\FileManagersController::class, 'index'])->name('filemanagers');
        Route::get('berkas', [App\Http\Controllers\FileManagersController::class, 'berkas'])->name('filemanagers.berkas');
        Route::post('kategori/simpan', [App\Http\Controllers\FileManagersController::class, 'kategori'])->name('filemanagers.kategoriBerkas.simpan');
        Route::post('subfolder/simpan', [App\Http\Controllers\FileManagersController::class, 'detailSubFolderSimpan'])->name('filemanagers.subfolder.simpan');
        Route::post('subkategori/simpan', [App\Http\Controllers\FileManagersController::class, 'detailSubKategoriSimpan'])->name('filemanagers.subkategoriBerkas.simpan');
        Route::get('{id}', [App\Http\Controllers\FileManagersController::class, 'subBerkas'])->name('filemanagers.subBerkas');
        Route::get('{id}/detail', [App\Http\Controllers\FileManagersController::class, 'detailSubKategori'])->name('filemanagers.detailSubKategori');
        Route::get('{id}/viewpdf', [App\Http\Controllers\FileManagersController::class, 'viewPdf']);
        Route::get('{id}/download', [App\Http\Controllers\FileManagersController::class, 'unduh'])->name('filemanagers.download');
        Route::get('{id}/delete', [App\Http\Controllers\FileManagersController::class, 'delete'])->name('filemanagers.delete');
        // Route::get('{id}/sub-berkas', [App\Http\Controllers\FileManagersController::class, 'subBerkas'])->name('filemanagers.subBerkas');
        // Route::get('{id}/sub-berkas/{id_sub}/berkas', [App\Http\Controllers\FileManagersController::class, 'subBerkasDetail'])->name('filemanagers.subBerkas.berkas');
        
    });
    Route::prefix('disk-managemen')->group(function () {
        Route::get('/', [App\Http\Controllers\DiskUsageController::class, 'index'])->name('disk_managemen');
        Route::post('simpan', [App\Http\Controllers\DiskUsageController::class, 'simpan'])->name('disk_managemen.simpan');
        Route::post('update', [App\Http\Controllers\DiskUsageController::class, 'update'])->name('disk_managemen.update');
        Route::get('{id}', [App\Http\Controllers\DiskUsageController::class, 'detail'])->name('disk_managemen.detail');
    });
    Route::prefix('departemen')->group(function () {
        Route::get('/', [App\Http\Controllers\DepartemenController::class, 'index'])->name('departemens');
        Route::post('simpan', [App\Http\Controllers\DepartemenController::class, 'simpan'])->name('departemens.simpan');
        Route::get('{id}', [App\Http\Controllers\DepartemenController::class, 'detail'])->name('departemens.detail');
        Route::get('{id}/team', [App\Http\Controllers\DepartemenController::class, 'team'])->name('departemens.team');
        Route::post('team/simpan', [App\Http\Controllers\DepartemenController::class, 'team_simpan'])->name('departemens.team.simpan');
    });
    Route::prefix('surat_office')->group(function () {
        Route::get('/', [App\Http\Controllers\SuratOfficeController::class, 'index'])->name('surat_office');
        Route::post('/simpan', [App\Http\Controllers\SuratOfficeController::class, 'simpan'])->name('surat_office.simpan');
        Route::get('/{id}/pengajuan', [App\Http\Controllers\SuratOfficeController::class, 'pengajuan'])->name('surat_office.edit');
        Route::post('/{id}/pengajuan/simpan', [App\Http\Controllers\SuratOfficeController::class, 'pengajuan_simpan'])->name('surat_office.pengajuan.simpan');
        Route::get('/{id}/pengajuan/edit', [App\Http\Controllers\SuratOfficeController::class, 'pengajuan_edit'])->name('surat_office.pengajuan.edit');
        Route::post('/{id}/pengajuan/edit/update', [App\Http\Controllers\SuratOfficeController::class, 'pengajuan_edit_update'])->name('surat_office.pengajuan.edit.update');
        Route::get('/{id}/pengajuan_ulang', [App\Http\Controllers\SuratOfficeController::class, 'pengajuan_ulang'])->name('surat_office.pengajuan_ulang');
        Route::post('/{id}/pengajuan_ulang/simpan', [App\Http\Controllers\SuratOfficeController::class, 'pengajuan_ulang_simpan'])->name('surat_office.pengajuan_ulang.simpan');
        Route::get('/{id}/pengajuan/view', [App\Http\Controllers\SuratOfficeController::class, 'lihat'])->name('surat_office.pengajuan.lihat');
        Route::post('pengajuan/verifikasi', [App\Http\Controllers\SuratOfficeController::class, 'pengajuan_konfirmasi'])->name('surat_office.pengajuan.verifikasi');
        Route::get('/{id}/previews', [App\Http\Controllers\SuratOfficeController::class, 'previews'])->name('surat_office.previews');
        Route::get('/{id}/download', [App\Http\Controllers\SuratOfficeController::class, 'download'])->name('surat_office.download');
    });
    Route::prefix('roles')->group(function () {
        Route::get('/', [App\Http\Controllers\RolesController::class, 'index'])->name('roles');
    });
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
        Route::get('{id}/edit', [App\Http\Controllers\UsersController::class, 'detail'])->name('users.edit');
        Route::get('{id}/delete', [App\Http\Controllers\UsersController::class, 'delete'])->name('users.delete');
        Route::get('{id}/reset', [App\Http\Controllers\UsersController::class, 'reset_pswd'])->name('users.reset');
        Route::post('simpan', [App\Http\Controllers\UsersController::class, 'simpan'])->name('users.simpan');
        Route::post('update', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
    });
    Route::prefix('management-user')->group(function () {
        Route::get('/', [App\Http\Controllers\UsersController::class, 'user_management_index'])->name('user_management');
        Route::get('{id}/edit', [App\Http\Controllers\UsersController::class, 'user_management_detail'])->name('user_management.detail');
        Route::post('simpan', [App\Http\Controllers\UsersController::class, 'user_management_simpan'])->name('user_management.simpan');
        Route::post('update', [App\Http\Controllers\UsersController::class, 'user_management_update'])->name('user_management.update');
    });
    Route::prefix('profile')->group(function () {
        Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
        Route::post('update', [App\Http\Controllers\ProfileController::class, 'update_pswd'])->name('profile.update');
    });

    Route::prefix('hrga')->group(function(){
        Route::prefix('inventaris')->group(function(){
            Route::prefix('k3')->group(function(){
                Route::get('/', [App\Http\Controllers\InventarisController::class, 'index_k3'])->name('inventaris.k3');
                Route::get('{id}/edit', [App\Http\Controllers\InventarisController::class, 'edit'])->name('inventaris.k3.edit');
                Route::post('{id}/edit/update', [App\Http\Controllers\InventarisController::class, 'edit_update'])->name('inventaris.k3.edit_update');
                Route::get('{id}/delete', [App\Http\Controllers\InventarisController::class, 'delete'])->name('inventaris.k3.delete');
                Route::get('periode', [App\Http\Controllers\InventarisController::class, 'periode'])->name('inventaris.k3.periode');
                Route::post('periode/simpan', [App\Http\Controllers\InventarisController::class, 'periode_simpan'])->name('inventaris.k3.periode_simpan');
                Route::post('simpan', [App\Http\Controllers\InventarisController::class, 'simpan_k3'])->name('inventaris.k3.simpan');
                Route::get('report', [App\Http\Controllers\InventarisController::class, 'report_all'])->name('inventaris.k3.report');
                Route::get('report/periode', [App\Http\Controllers\InventarisController::class, 'report_periode'])->name('inventaris.k3.report_periode');
                Route::get('print_barcode', [App\Http\Controllers\InventarisController::class, 'print_barcode_k3'])->name('inventaris.k3.printBarcode');
                Route::get('{id}/print_barcode', [App\Http\Controllers\InventarisController::class, 'print_barcode_k3_detail'])->name('inventaris.k3.printBarcode.detail');
                Route::get('{id}', [App\Http\Controllers\InventarisController::class, 'detail_k3'])->name('inventaris.k3.detail');
                Route::post('{id}/simpan', [App\Http\Controllers\InventarisController::class, 'detail_k3_simpan'])->name('inventaris.k3.detail.simpan');
                Route::get('{id}/form', [App\Http\Controllers\InventarisController::class, 'detail_k3_form'])->name('inventaris.k3.detail.form');
                Route::get('{id}/checkData', [App\Http\Controllers\InventarisController::class, 'check_data'])->name('inventaris.k3.checkData');
                Route::post('{id}/form/update', [App\Http\Controllers\InventarisController::class, 'detail_k3_update'])->name('inventaris.k3.detail.form.update');
                Route::get('{id}/status_apar/update', [App\Http\Controllers\InventarisController::class, 'detail_k3_status_apar'])->name('inventaris.k3.detail.statusApar.update');   
                Route::get('{id}/status_hydrant/update', [App\Http\Controllers\InventarisController::class, 'detail_k3_status_hydrant'])->name('inventaris.k3.detail.statusHydrant.update');   
                Route::get('{id}/download', [App\Http\Controllers\InventarisController::class, 'download_file'])->name('inventaris.k3.detail.download');
            });
        });
    });
    Route::prefix('it')->group(function(){
        Route::prefix('inventaris')->group(function(){
            Route::get('/', [App\Http\Controllers\InventarisITController::class, 'index'])->name('inventaris.it');
            Route::get('/download_report', [App\Http\Controllers\InventarisITController::class, 'download_report'])->name('inventaris.it.download_report');
            Route::post('simpan', [App\Http\Controllers\InventarisITController::class, 'simpan'])->name('inventaris.it.simpan');
            Route::get('{id}/print_barcode', [App\Http\Controllers\InventarisITController::class, 'print_barcode_all'])->name('inventaris.it.print.barcode');
            Route::get('{id}', [App\Http\Controllers\InventarisITController::class, 'detail'])->name('inventaris.it.detail');
            Route::get('{id}/delete', [App\Http\Controllers\InventarisITController::class, 'delete'])->name('inventaris.it.delete');
            Route::get('{id}/{detail_form}/detail_form', [App\Http\Controllers\InventarisITController::class, 'detail_form'])->name('inventaris.it.print.detailForm');
            Route::post('{id}/{detail_form}/detail_form/simpan', [App\Http\Controllers\InventarisITController::class, 'detail_form_simpan'])->name('inventaris.it.print.detailForm.simpan');
            Route::post('{id}/simpan', [App\Http\Controllers\InventarisITController::class, 'detail_simpan'])->name('inventaris.it.detail.simpan');
            Route::get('{id}/{id_ipld}', [App\Http\Controllers\InventarisITController::class, 'detail_edit'])->name('inventaris.it.detail.edit');
            Route::post('{id}/{id_ipld}/update', [App\Http\Controllers\InventarisITController::class, 'detail_edit_update'])->name('inventaris.it.detail.update');   
            Route::get('{id}/{id_ipld}/check', [App\Http\Controllers\InventarisITController::class, 'detail_from_check'])->name('inventaris.it.detail_from.check');
        });
        Route::prefix('perangkat')->group(function(){
            Route::get('/', [App\Http\Controllers\InventarisITPerangkatController::class, 'index'])->name('inventaris.it.perangkat');
            Route::post('simpan', [App\Http\Controllers\InventarisITPerangkatController::class, 'simpan'])->name('inventaris.it.perangkat.simpan');
            Route::get('{id}', [App\Http\Controllers\InventarisITPerangkatController::class, 'detail'])->name('inventaris.it.perangkat.detail');
            Route::get('{id}/{detail_form}/check', [App\Http\Controllers\InventarisITPerangkatController::class, 'check_data'])->name('inventaris.it.perangkat.detail.checkData');
            Route::post('{id}/detail_simpan', [App\Http\Controllers\InventarisITPerangkatController::class, 'detail_simpan'])->name('inventaris.it.perangkat.detail.simpan');
            Route::get('{id}/{id_inventaris_p}/edit', [App\Http\Controllers\InventarisITPerangkatController::class, 'detail_edit'])->name('inventaris.it.perangkat.detail.edit');
            Route::get('cari_asset/{jenis_asset}', [App\Http\Controllers\InventarisITPerangkatController::class, 'ajaxSelect'])->name('inventaris.it.cariasset');
        });
        Route::get('print_barcode_perangkat', [App\Http\Controllers\InventarisITPerangkatController::class, 'print_barcode_all'])->name('inventaris.it.perangkat.printBarcode');
    });

    Route::get('scans', [App\Http\Controllers\InventarisController::class, 'scans'])->name('inventaris.scan');
    Route::get('scans/{kode_barcode}', [App\Http\Controllers\InventarisController::class, 'cek_scans'])->name('inventaris.scan.check');
    
    Route::prefix('b_portal')->group(function(){
        Route::get('/', [App\Http\Controllers\PortalController::class, 'b_portal'])->name('portal');
        Route::post('simpan', [App\Http\Controllers\PortalController::class, 'b_simpan'])->name('portal.simpan');
        Route::get('{id}', [App\Http\Controllers\PortalController::class, 'b_portal_detail'])->name('portal.detail');
        Route::get('{id}/buat', [App\Http\Controllers\PortalController::class, 'b_portal_detail_buat'])->name('portal.detail.buat');
        Route::post('{id}/simpan', [App\Http\Controllers\PortalController::class, 'b_portal_akses_simpan'])->name('portal.detail_simpan');
    });

    // Route::prefix('payroll')->group(function(){
    //     Route::get('/', [App\Http\Controllers\PayrollController::class, 'index'])->name('payroll.home');
    // });
    
    Route::get('notifikasi', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifikasi');
    Route::post('mark-as-read', [App\Http\Controllers\NotificationController::class, 'markNotification'])->name('markNotification');
});

Route::get('scanqr', [App\Http\Controllers\ScanQRController::class, 'index'])->name('scanqr');
Route::get('scanqr/{qr}', [App\Http\Controllers\ScanQRController::class, 'scanqr'])->name('scanqr.check');
Route::get('scanqrITAsset/{qr}', [App\Http\Controllers\ScanQRController::class, 'scanQRAsset'])->name('scanqr.ITAsset');

// Route::get('scanqr', function(){
//     return view('backend.portal.scanqr.index');
// });
