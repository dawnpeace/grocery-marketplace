<?php
use App\FotoProduk;
use App\Admin;
use App\Enums\UserLevel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon as Carbon;

if (!function_exists('displayUrl')) {
    function displayUrl(FotoProduk $fotoProduk = null)
    {
        return is_null($fotoProduk) ? asset('img/product.jpg') : asset('storage/foto_produk/'.$fotoProduk->foto_produk);
    }
}

if (!function_exists('gambarDefaultProduk')) {
    function gambarDefaultProduk()
    {
        return asset('img/product.jpg');
    }
}

if (!function_exists('gambarDefaultProfil')) {
    function gambarDefaultProfil($profil)
    {
        return isEmpty($profil) ? asset('img/product.jpg') : asset('storage/foto_profil/'.$profil->foto_profil);
    }
}

if (!function_exists('formatRP')) {
    function formatRP($harga)
    {
        return 'Rp '.number_format($harga,0,',','.');
    }
}

if(!function_exists('localeDate')){
    function localeDate($timestamp)
    {
        $date = Carbon::parse($timestamp);
        return $date->isoFormat('D MMM YYYY');
    }
}

if(!function_exists('localeDateTime')){
    function localeDateTime($timestamp)
    {
        $date = Carbon::parse($timestamp);
        return $date->isoFormat('D MMM YYYY, hh:mm');
    }
}

if(!function_exists('whatsappLink')){
    function whatsappLink($number)
    {
        $user = Auth::user();
        $greetings = "";
        switch($user->jenis){
            case UserLevel::PEMBELI:
                $greetings = "Halo saya $user->nama, pembeli dari Dapurpedia. ";
                break;
            case UserLevel::PENJUAL:
                $greetings = "Halo saya dari ".$user->penjual->nama_toko." penjual dari Dapurpedia. ";
                break;
            case UserLevel::DRIVER:
                $greetings = "Halo saya $user->nama, driver yang berasosiasi dengan Dapurpedia. ";
                break;
            case UserLevel::SUPERADMIN;
                $greetings = "Halo saya $user->name admin dari Dapurpedia !. ";
                break;
            default:
                return '';
        }
        return "'https://web.whatsapp.com/send?phone=".$number.'&text='.$greetings."'";
    }
}

if(!function_exists('whatsappAdmin')){
    function whatsappAdmin()
    {
        return Admin::first()->no_telp ?? '0';
    }
}