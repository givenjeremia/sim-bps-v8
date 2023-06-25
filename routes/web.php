<?php


use App\Models\Klinik;
use App\Models\layanan\IbuHamil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\master\ObatController;
use App\Http\Controllers\PengingatObatController;
use App\Http\Controllers\layanan\KlinikController;
use App\Http\Controllers\master\KaryawanController;
use App\Http\Controllers\layanan\IbuHamilController;
use App\Http\Controllers\master\PasienBayiController;
use App\Http\Controllers\PengingatImunisasiController;
use App\Http\Controllers\master\JenisLayananController;
use App\Http\Controllers\master\PasienDewasaController;
use App\Http\Controllers\master\KepalaPuskesmasController;
use App\Http\Controllers\master\SuamiPasienDewasaController;

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
	Route::resource('/', HomeController::class);
	Route::resource('/home', HomeController::class);
	// Route::get('/hitung_notif', 'HomeController@hitungPengingat');
	// Route::get('/donut', 'HomeController@hitungPerbandinganPendapatan');
	// Route::get('/chart', 'HomeController@totalPerHari');



	// Pengingat
	// ================================================= PENGINGAT IMUNISASI
	Route::get('/p_imunisasi_hari_ini', [PengingatImunisasiController::class,'indexHariIni']);
	Route::get('/p_imunisasi_terlewati', [PengingatImunisasiController::class,'indexTerlewati']);
	Route::get('/p_imunisasi_akan_datang', [PengingatImunisasiController::class,'indexAkanDatang']);
	Route::post('/p_ke_history_tambah', [PengingatImunisasiController::class,'indexHistoryTambah']);
	Route::get('/imunisasi_hitung_pengingat', [PengingatImunisasiController::class,'hitungPengingat']);
	Route::get('/hitung_total_notif', [PengingatImunisasiController::class,'hitungTotalNotif']);

	// ================================================= PENGINGAT OBAT
	Route::get('/p_obat_expired', [PengingatObatController::class,'indexExpired']);
	Route::get('/p_obat_stok', [PengingatObatController::class,'indexStok']);
	Route::get('/obat_hitung_pengingat', [PengingatObatController::class,'hitungPengingat']);


	// Bayi
	Route::resource('/pasien-bayi', PasienBayiController::class);
	// Dewasa
	Route::resource('/pasien-dewasa', PasienDewasaController::class);
	Route::get('/pasien-dewasa/cetak-kartu/{id}', [PasienDewasaController::class, 'cetakKartu'])->name('pasien-dewasa.cetak.kartu');

	// Suami Pasien Dewasa
	Route::resource('/suami-pasien-dewasa', SuamiPasienDewasaController::class);
	// Obat
	Route::resource('/obat', ObatController::class);
	// Kepala Puskesmas
	Route::resource('/kepala-puskesmas', KepalaPuskesmasController::class);
	// Layanan
	Route::resource('/jenis-layanan', JenisLayananController::class);

	// Karyawan
	Route::resource('/karyawan', KaryawanController::class);

	// Layanan Page Ibu Hamil
	Route::resource('/layanan-ibu-hamil', IbuHamilController::class);
	Route::get('/layanan-ibu-hamil-cek-obat', [IbuHamilController::class, 'ibu_hamil_cek_stok_obat'])->name('ibu.hamil.cek.stok.obat');
	Route::get('/layananIbuHamilDetail/detailKartu/{id}', [IbuHamilController::class, 'detailLayanan'])->name('detail.layanan');

	Route::post('/layanan-ibu-hamil-tambah-history-hamil', [IbuHamilController::class, 'TambahHistoryHamil'])->name('tambah.history.hamil');
	Route::get('/layanan-ibu-hamil-tambah-kunjungan-ibu-hamil/{id}', [IbuHamilController::class, 'tambahKunjunganHamil'])->name('tambah.kunjungan.hamil');
	Route::get('/layanan-ibu-hamil-cetak-surat-lahir/{id}', [IbuHamilController::class, 'cetak_surat_lahir'])->name('cetak.surat.lahir');

	Route::get('/layanan-ibu-hamil-tambah-history-persalinan', [IbuHamilController::class, 'create_history_persalinan'])->name('tambah.history.persalinan');
	Route::post('/layanan-ibu-hamil-store-history-persalinan', [IbuHamilController::class, 'store_history_persalinan'])->name('store.history.persalinan');

	Route::get('/layanan-ibu-hamil-detail-persalinan', [IbuHamilController::class, 'history_persalinan'])->name('history.persalinan');
	Route::get('/layanan-ibu-hamil-detail-tambah-nifas', [IbuHamilController::class, 'detailTambahNifas'])->name('detail.tambah.nifas');
	// Route::post('/ibuHamilDetailStoreNifas', 'layanan\ibuHamilController@StoreNifas')->name('store.nifas');
	// Route::get('/createKunjunganIbuHamil', 'layanan\ibuHamilController@createKunjunganIbuHamil');
	// Route::get('/layananIbuHamilDetailNifas/{id}', 'layanan\ibuHamilController@detailNifas');
	// Route::get('/DetailKunjunganIbuHamil/{id}', 'layanan\ibuHamilController@detailKunjunganIbuHamil');

	// Route::resource('/ibu_hamil', 'layanan\ibuHamilController'); 
	// Route::get('/ibu_hamil_tambah', 'layanan\ibuHamilController@tambah');
	// Route::post('/ibu_hamil_create', 'layanan\ibuHamilController@store');
	// Route::post('/get_riwayat_hamil', 'layanan\ibuHamilController@get_riwayat_hamil');
	// Route::get('/ibuHamilDetailTambah', 'layanan\ibuHamilController@detailTambah'); 
	// Route::post('/ibuHamilTambahHistoryHamil', 'layanan\ibuHamilController@ibuHamilTambahHistoryHamil');
	// Route::get('/layananIbuHamilDetail/detailKartu/{id}', 'layanan\ibuHamilController@detailLayanan');
	// Route::post('/tambahKunjunganIbuHamil', 'layanan\ibuHamilController@tambahKunjunganIbuHamil'); 
	// Route::get('/cetak_surat_lahir/{id}', 'layanan\ibuHamilController@cetak_surat_lahir');
	// Route::get('/ibu_hamil_create_history_persalinan', 'layanan\ibuHamilController@create_history_persalinan'); 
	// Route::post('/ibu_hamil_store_history_persalinan', 'layanan\ibuHamilController@store_history_persalinan'); 
	// Route::get('/ibuHamilDetailPersalinan', 'layanan\ibuHamilController@history_persalinan');
	// Route::get('/ibuHamilDetailTambahNifas', 'layanan\ibuHamilController@detailTambahNifas'); 
	// Route::post('/ibuHamilDetailStoreNifas', 'layanan\ibuHamilController@StoreNifas');
	// Route::get('/createKunjunganIbuHamil', 'layanan\ibuHamilController@createKunjunganIbuHamil'); 
	// Route::get('/layananIbuHamilDetailNifas/{id}', 'layanan\ibuHamilController@detailNifas'); 
	// Route::get('/DetailKunjunganIbuHamil/{id}', 'layanan\ibuHamilController@detailKunjunganIbuHamil');

	// Route::post('/ibu_hamil/kspr', 'layanan\ibuHamilController@storeKspr');
	// Route::get('/ibuHamilKspr/{id}', 'layanan\ibuHamilController@indexKspr');

	// Route::post('/ibu_hamil/penapisan', 'layanan\ibuHamilController@storePenapisan');
	// Route::get('/ibuHamilPenapisan/{id}', 'layanan\ibuHamilController@indexPenapisan');

	// Route::post('/ibu_hamil/observasi', 'layanan\ibuHamilController@storeObservasi');
	// Route::post('/ibu_hamil/importObservasi', 'layanan\ibuHamilController@storeImportObservasi');
	// Route::get('/ibuHamilObservasi/{id}', 'layanan\ibuHamilController@indexObservasi');
	// Route::get('/observasiKala/{idkartuobservasi}', 'layanan\ibuHamilController@indexObservasiKala');
	// Route::post('/observasiKala/storeObservasi', 'layanan\ibuHamilController@storeObservasiKala');

	// Layanan Page Klinik
	Route::resource('/layanan-klinik', KlinikController::class);
	Route::post('/layanan-klinik-cek-stok_obat', [KlinikController::class, 'klinik_cek_stok_obat'])->name('klinik.cek.stok.obat');
	Route::get('/klinik-detail-tambah', [KlinikController::class, 'detailTambah']);
	Route::post('/layanan-klinik-cek-stok_obat', [KlinikController::class, 'klinik_cek_stok_obat'])->name('klinik.cek.stok.obat');
	Route::post('/klinik-simpan-histori', [KlinikController::class, 'klinik_simpan_history'])->name('klinik.simpan.history');
	Route::post('/klinik-tambah-pasien-histori', [KlinikController::class, 'tambah_pasien_history'])->name('klinik.tambah.pasien.history');
	Route::post('/klinikSuratKetSakit', [KlinikController::class, 'cetakSuratKetSakit']); 
	Route::post('/klinikSuratRujukan', [KlinikController::class, 'cetakSuratRujukan']);


	// klinik_simpan_history
	// // ================================================= LAYANAN KLINIK
	// Route::resource('/klinik', 'layanan\klinikController');  
	// Route::get('/klinikTambah', 'layanan\klinikController@tambah'); 
	// Route::get('/klinikDetailTambah', 'layanan\klinikController@detailTambah'); 
	// Route::post('/klinik_simpan_history', 'layanan\klinikController@klinik_simpan_history'); 
	// Route::post('/klinik_tambah_pasien_history', 'layanan\klinikController@klinik_tambah_pasien_history'); 
	// Route::post('/klinik_tambah_pasien_bayi_history', 'layanan\klinikController@klinik_tambah_pasien_bayi_history'); 
	// Route::post('/klinik_cek_stok_obat', 'layanan\klinikController@klinik_cek_stok_obat'); 
	// Route::post('/klinikSuratKetSakit', 'layanan\klinikController@cetakSuratKetSakit'); 
	// Route::post('/klinikSuratRujukan', 'layanan\klinikController@cetakSuratRujukan');

	// ================================================= MASTER LAPORAN
	Route::get('/laporan_keuangan', [LaporanController::class,'indexLaporanKeuangan']); 
	Route::get('/laporan_keuangan/filterDate', [LaporanController::class,'indexLaporanKeuanganFilter']);
	Route::post('/laporan_keuangan/print', [LaporanController::class,'printLaporanKeuangan']);

	Route::get('/laporan_kunjungan_ibu_Hamil', [LaporanController::class,'indexLaporanKunjunganIbuHamil']); 
	Route::post('/laporan_kunjungan_ibu_Hamil/print', [LaporanController::class,'printLaporanKunjunganIbuHamil']); 

	Route::get('/laporan_kunjungan_persalinan', [LaporanController::class,'indexLaporanKunjunganPersalinan']); 
	Route::post('/laporan_kunjungan_persalinan/print', [LaporanController::class,'printLaporanKunjunganPersalinan']); 

	Route::get('/laporan_kunjungan_kb', [LaporanController::class,'indexLaporanKunjunganKB']); 
	//Route::post('/laporan_kunjungan_kb/print', 'laporan\laporanController@printLaporanKunjunganKB');

	Route::get('/laporan_hasil_imunisasi', [LaporanController::class,'indexLaporanKeuangan']); 
	Route::get('/laporan_imunisasi', [LaporanController::class,'indexLaporanImunisasi']); 
	Route::post('/laporan_imunisasi/print', [LaporanController::class,'printLaporanImunisasi']);
	Route::post('/laporan_kunjungan_kb/print', [LaporanController::class,'exportLaporanKunjunganKBe']);


});
