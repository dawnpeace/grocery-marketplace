<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Enums\UserLevel;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('superadmin',function($user){
            return $user->jenis == UserLevel::SUPERADMIN;
        });

        Gate::define('pembeli',function($user){
            return $user->jenis == UserLevel::PEMBELI && $user->pembeli->telah_diverifikasi;
        });

        Gate::define('penjual',function($user){
            return $user->jenis == UserLevel::PENJUAL && $user->penjual->telah_diverifikasi;
        });

        Gate::define('driver',function($user){
            return $user->jenis == UserLevel::DRIVER && $user->driver->telah_diverifikasi;
        });

        Gate::define('PhotoCreate','App\Policies\GalleryPolicy@create');
        Gate::define('PhotoStore','App\Policies\GalleryPolicy@store');
        Gate::define('PhotoEdit','App\Policies\GalleryPolicy@edit');
        Gate::define('PhotoUpdate','App\Policies\GalleryPolicy@update');
        Gate::define('PhotoDelete','App\Policies\GalleryPolicy@delete');
        Gate::define('ItemStore','App\Policies\ItemPolicy@store');
        Gate::define('ProdukEdit','App\Policies\ProdukPolicy@edit');
        Gate::define('ProdukUpdate','App\Policies\ProdukPolicy@update');
        Gate::define('ProdukDelete','App\Policies\ProdukPolicy@delete');
        Gate::define('PasarDelete','App\Policies\PasarPolicy@delete');
        Gate::define('SedangBekerja','App\Policies\BekerjaPolicy@bekerja');
        Gate::define('TidakBekerja','App\Policies\BekerjaPolicy@tidakBekerja');
        Gate::define('ProdukDiambilDriver','App\Policies\KeranjangPolicy@diambilDriver');
        Gate::define('DapatDiselesaikan','App\Policies\BekerjaPolicy@pekerjaanSelesai');
        Gate::define('SelesaikanTransaksi','App\Policies\TransaksiPolicy@transaksiSelesai');
        Gate::define('DetailPermintaan','App\Policies\PermintaanPolicy@lihatPermintaan');
        Gate::define('ProsesPermintaan','App\Policies\PermintaanPolicy@prosesPermintaan');
    }
}
