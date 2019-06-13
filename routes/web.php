<?php

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


Route::get('/','MainMenuController@index')->name('dashboard');
Route::get('/cari','PencarianController@cari')->name('pencarian');
Route::get('produk/{produk}','MainMenuController@lihatProduk')->name('lihat.produk');

Route::get('profil-penjual/{penjual}','ProfilController@penjual')->name('profil.penjual');
Route::get('profil-driver/{driver}','ProfilController@driver')->name('profil.driver')->middleware('auth');

Route::group(['middleware'=>['can:pembeli']],function(){
    Route::get('tambah-keranjang/{produk}','ItemController@lihatProduk')->name('tambah.produk');
    Route::post('tambah-keranjang/{produk}','ItemController@tambahKeranjang')->name('tambah.item');
    Route::get('keranjang-saya','CartController@keranjangSaya')->name('keranjang');
    Route::get('keranjang/{keranjang}','CartController@detailKeranjang')->name('keranjang.detail');
    Route::post('keranjang/{keranjang}/hapus','CartController@hapusKeranjang')->name('keranjang.hapus');
    Route::post('keranjang/{keranjang}/hapus/{item}','ItemController@hapusItem')->name('hapus.item');
    Route::post('keranjang/{keranjang}/checkout','CartController@checkoutKeranjang')->name('keranjang.checkout');
    Route::get('keranjang-saya/diproses','CartController@lihatTransaksiBerjalan')->name('keranjang.diproses');
    Route::post('selesaikan-transaksi/{keranjang}','AntarController@transaksiSelesai')->name('transaksi.selesai');
});
Route::get('profil-saya','PembeliController@editProfil')->name('pembeli.profil.edit');
Route::post('profil-saya','PembeliController@updateProfil')->name('pembeli.profil.update');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('pasar/{pasar}','MainMenuController@daftarProduk')->name('dashboard.produk');

// Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['guest'])->group(function(){
    Route::view('daftar-registrasi','auth.daftar-registrasi')->name('register.index');
    Route::get('register/{jenis?}','Auth\CustomRegisterController@buat')->name('register');
    Route::post('register/driver','Auth\CustomRegisterController@simpanDriver');
    Route::post('register/penjual','Auth\CustomRegisterController@simpanPenjual');
    Route::post('register/pembeli','Auth\CustomRegisterController@simpanPembeli');
});

Route::group(['middleware'=>['can:superadmin'],'prefix'=>'admin'],function(){
    Route::get('/','AdminDashboardController@index')->name('admin.dashboard');

    Route::get('manajemen-pasar','PasarController@index')->name('admin.manajemen.pasar');
    Route::get('manajemen-pasar/tambah-pasar','PasarController@create')->name('pasar.create');
    Route::post('manajemen-pasar/tambah-pasar','PasarController@store')->name('pasar.store');
    Route::get('manajemen-pasar/{pasar}/edit','PasarController@edit')->name('pasar.edit');
    Route::post('manajemen-pasar/{pasar}/edit','PasarController@update')->name('pasar.update');

    Route::post('manajemen-pasar/{pasar}/hapus','PasarController@delete')->name('pasar.delete');

    Route::get('manajemen-driver','VerifikasiController@indexDriver')->name('admin.manajemen.driver');
    Route::get('manajemen-pembeli','VerifikasiController@indexPembeli')->name('admin.manajemen.pembeli');
    Route::get('manajemen-penjual','VerifikasiController@indexPenjual')->name('admin.manajemen.penjual');
    
    Route::post('verifikasi-driver/{idDriver}','VerifikasiController@updateDriver')->name('verif.driver');
    Route::post('verifikasi-Pembeli/{idPembeli}','VerifikasiController@updatePembeli')->name('verif.pembeli');
    Route::post('verifikasi-Penjual/{idPenjual}','VerifikasiController@updatePenjual')->name('verif.penjual');
    
    Route::get('profil-driver/{id}','DriverController@edit')->name('edit.driver');
    Route::post('profil-driver/{id}','DriverController@update')->name('update.driver');
    
    Route::get('profil-penjual/{id}','PenjualController@edit')->name('edit.penjual');
    Route::post('profil-penjual/{id}','PenjualController@update')->name('update.penjual');
    
    Route::get('profil-pembeli/{id}','PembeliController@edit')->name('edit.pembeli');
    Route::post('profil-pembeli/{id}','PembeliController@update')->name('update.pembeli');
});


Route::get('/penjual','ProdukController@index')->name('penjual.dashboard');
Route::get('/penjual/profil','PenjualController@editProfil')->name('penjual.profil.edit');
Route::group(['middleware'=>['can:penjual'], 'prefix'=>'penjual'],function(){
    Route::get('manajemen-produk/{produk}','ProdukController@edit')->name('produk.edit');
    Route::post('manajemen-produk/{produk}','ProdukController@update')->name('produk.update'); 
    Route::post('manajemen-produk/{produk}/hapus','ProdukController@delete')->name('produk.delete');    
    Route::post('manajemen-produk/{produk}/ketersediaan','ProdukController@updateKetersediaan')->name('produk.update.ketersediaan');

    Route::get('tambah-produk','ProdukController@create')->name('produk.tambah');
    Route::post('tambah-produk','ProdukController@store')->name('produk.simpan');
    
    Route::prefix('galeri-produk')->group(function(){
        Route::get('/{produk}','GalleryController@create')->name('galeri.create');
        Route::post('/{produk}','GalleryController@store')->name('galeri.store');
        Route::get('/ubah-foto/{fotoproduk}','GalleryController@edit')->name('photo.edit');
        Route::post('/ubah-foto/{fotoproduk}','GalleryController@update')->name('photo.update');
        Route::post('/hapus-foto/{fotoproduk}','GalleryController@delete')->name('photo.delete');
    });

    Route::prefix('profil')->group(function(){
        Route::post('/','PenjualController@updateProfil')->name('penjual.profil.update');
    });

    Route::prefix('permintaan')->group(function(){
        Route::get('/','PermintaanController@lihatPermintaan')->name('permintaan');
        Route::get('/{keranjang}/detail','PermintaanController@lihatDetail')->name('permintaan.detail');
        Route::post('/{keranjang}/proses','PermintaanController@proses')->name('permintaan.proses');
        Route::get('/daftar-proses','PermintaanController@daftarProses')->name('permintaan.diproses');
        Route::post('/pesanan/{keranjang}/diambil','PermintaanController@diambilDriver')->name('permintaan.diambil');
    });
    
});


Route::get('/driver','AntarController@index')->name('driver.dashboard');
Route::get('/driver/profil-saya','DriverController@editProfil')->name('driver.profil.edit');
Route::group(['middleware'=>['can:driver'],'prefix'=>'driver'],function(){

    Route::post('/profil-saya','DriverController@updateProfil')->name('driver.profil.update');

    Route::group(['middleware'=>['can:TidakBekerja']],function(){
        Route::get('/detail-pesanan/{keranjang}','AntarController@detailPesanan')->name('pesanan.detail');
        Route::post('/ambil-pesanan/{keranjang}','AntarController@ambilPesanan')->name('pesanan.ambil');
    });

    Route::middleware(['can:SedangBekerja'])->group(function(){
        Route::get('pekerjaan-aktif','PekerjaanController@index')->name('pekerjaan.index');
        Route::post('selesaikan-pekerjaan','PekerjaanController@selesaikanPekerjaan')->name('pekerjaan.selesai');
    });
    
});
