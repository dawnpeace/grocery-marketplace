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
            return $user->jenis == UserLevel::PEMBELI;
        });

        Gate::define('penjual',function($user){
            return $user->jenis == UserLevel::PENJUAL;
        });

        Gate::define('driver',function($user){
            return $user->jenis == UserLevel::DRIVER;
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

        


    }
}
