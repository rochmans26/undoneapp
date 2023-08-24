<?php

use App\Models\Proposals;
use Illuminate\Http\Request;
use App\Http\Livewire\SkimTable;
use App\Http\Livewire\UserTable;
use App\Http\Livewire\DosenTable;
use App\Http\Livewire\ProdiTable;
use App\Http\Livewire\BidangTable;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\ListProposal;
use App\Http\Livewire\FakultasTable;
use App\Http\Livewire\GantiKatasandi;
use App\Http\Livewire\PublikasiTable;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateProposal;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\LaporanHasilTable;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\SemproController;
use App\Http\Controllers\LapHasilController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenLuarController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\AnggotaDosenController;
use App\Http\Controllers\SeminarHasilController;
use App\Http\Controllers\AnggotaDosenLuarController;
use App\Http\Controllers\AnggotaMahasiswaController;
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

Route::get('/', function(){
    return view('loginui');
})->name('loginui')->middleware('guest');
// Route::get('/', [AuthController::class, 'index'])->name('loginui');
Route::get('/login', [AuthController::class, 'login'])->name('loginredirect');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/ganti-kata-sandi', GantiKatasandi::class)->middleware('auth')->name('changepass');

Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('formulir-pengajuan-proposal', [ProposalController::class, 'form'])->name('formulir-pengajuan-proposal');
    Route::post('formulir-pengajuan-proposal', [ProposalController::class, 'store'])->name('kirim-pengajuan');
    Route::get('/kelola-anggota/{id}', [ProposalController::class, 'tambahanggota'])->name('kelola-anggota');
    Route::post('simpan-anggotadosen', [AnggotaDosenController::class, 'store'])->name('simpan-anggotadosen');
    Route::post('simpan-anggotadosenluar', [AnggotaDosenLuarController::class, 'store'])->name('simpan-anggotadosenluar');
    Route::post('simpan-anggotamahasiswa', [AnggotaMahasiswaController::class, 'store'])->name('simpan-anggotamahasiswa');
    Route::post('simpan-data-dosen', [DosenController::class, 'store'])->name('simpan-data-dosen');
    Route::post('simpan-data-dosenluar', [DosenLuarController::class, 'store'])->name('simpan-data-dosenluar');
    Route::post('simpan-data-mahasiswa', [MahasiswaController::class, 'store'])->name('simpan-data-mahasiswa');
    Route::get('formulir-seminar-proposal', [SemproController::class, 'form'])->name('formulir-seminar-proposal');
    Route::post('buat-seminar-proposal', [SemproController::class, 'create'])->name('buat-seminar-proposal');
    Route::get('/edit-seminar-proposal/{id}/edit', [SemproController::class, 'edit'])->name('edit-seminar-proposal');
    Route::put('/edit-seminar-proposal/{id}', [SemproController::class, 'update'])->name('ubah-seminar-proposal');
    Route::get('formulir-laporan-hasil', [LapHasilController::class, 'form'])->name('formulir-laporan-hasil');
    Route::post('simpan-laporan-hasil', [LapHasilController::class, 'store'])->name('simpan-laporan-hasil');
    Route::get('formulir-seminar-hasil', [SeminarHasilController::class, 'form'])->name('formulir-seminar-hasil');
    Route::post('buat-seminar-hasil', [SeminarHasilController::class, 'store'])->name('buat-seminar-hasil');
    Route::get('/edit-seminar-hasil/{id}/edit', [SeminarHasilController::class, 'edit'])->name('edit-seminar-hasil');
    Route::put('/edit-seminar-hasil/{id}', [SeminarHasilController::class, 'update'])->name('ubah-seminar-hasil');
    Route::get('formulir-publikasi', [PublikasiController::class, 'form'])->name('formulir-publikasi');
    Route::get('formulir-publikasi2', [PublikasiController::class, 'form2'])->name('formulir-publikasi2');
    Route::post('simpan-publikasi', [PublikasiController::class, 'simpan'])->name('simpan-publikasi');
    Route::post('simpan-publikasi2', [PublikasiController::class, 'simpan2'])->name('simpan-publikasi2');
    Route::get('detail-publikasi2/{id}/detail', [PublikasiController::class, 'detail'])->name('detail-publikasi2');
    Route::get('/data-laphas/{thn_mulai}/getpub', [DashboardController::class, 'getpub'])->name('data-laphas');
    Route::get('publikasi-mandiri', [PublikasiMandiriTable::class])->name('publikasi-mandiri');
    Route::get('detail-proposal/{id}/detail', [ProposalController::class,'detail'])->name('detail-proposal');
    Route::group(['middleware' => ['ceklogin:admin']], function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
        Route::get('/admin/bidangs', BidangTable::class)->name('admin.bidangs');
        Route::get('/admin/skims', SkimTable::class)->name('admin.skims');
        Route::get('/admin/fakultas', FakultasTable::class)->name('admin.fakultas');
        Route::get('/admin/prodis', ProdiTable::class)->name('admin.prodis');
        Route::get('/admin/proposals', ListProposal::class)->name('admin.proposals');
        Route::get('/admin/dosens', DosenTable::class)->name('admin.dosens');
        Route::get('/admin/proposals/seminar', [SemproController::class, 'index'])->name('admin.proposals.seminar');
        Route::get('admin/proposals/{id}', [ProposalController::class,'show'])->name('proposal.detail');
        Route::get('/admin/laporan-hasil',LaporanHasilTable::class)->name('admin.laporan-hasil');
        Route::get('/admin/laphasil/{id}', [LapHasilController::class,'show'])->name('admin.laphasil.detail');
        Route::get('/admin/laporan-hasil/seminar', [SeminarHasilController::class, 'index'])->name('admin.laporan-hasil.seminar');
        Route::get('/admin/publikasi', PublikasiTable::class)->name('admin.publikasi');

    });
    Route::group(['middleware' => ['ceklogin:sp-admin']], function () {
        Route::get('/sp-admin/users', UserTable::class)->name('sp-admin.users');
        Route::get('/sp-admin', [DashboardController::class, 'index'])->name('sp-admin');
        Route::get('/sp-admin/bidangs', BidangTable::class)->name('sp-admin.bidangs');
        Route::get('/sp-admin/skims', SkimTable::class)->name('sp-admin.skims');
        Route::get('/sp-admin/fakultas', FakultasTable::class)->name('sp-admin.fakultas');
        Route::get('/sp-admin/prodis', ProdiTable::class)->name('sp-admin.prodis');
        Route::get('/sp-admin/proposals', ListProposal::class)->name('sp-admin.proposals');
        Route::get('/sp-admin/dosens', DosenTable::class)->name('sp-admin.dosens');
        Route::get('/sp-admin/proposals/seminar', [SemproController::class, 'index'])->name('sp-admin.proposals.seminar');
        Route::get('/sp-admin/laporan-hasil/seminar', [SeminarHasilController::class, 'index'])->name('sp-admin.laporan-hasil.seminar');
        Route::get('sp-admin/proposals/{id}/detail', [ProposalController::class,'show'])->name('sp-admin.proposal.detail');
        Route::get('sp-admin/laphasil/{id}', [LapHasilController::class,'show'])->name('sp-admin.laphasil.detail');
        Route::get('/sp-admin/laporan-hasil',LaporanHasilTable::class)->name('sp-admin.laporan-hasil');
        // route baru
        // Route::get('/sp-admin/proposals/form', [ProposalController::class,'form'])->name('sp-admin.proposals.form');
        // Route::post('/sp-admin/proposals/store', [ProposalController::class,'store'])->name('sp-admin.proposals.store');
        
        Route::get('/sp-admin/publikasi', PublikasiTable::class)->name('sp-admin.publikasi');
    });
});

