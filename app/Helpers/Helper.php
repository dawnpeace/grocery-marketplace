<?php
use App\FotoProduk;

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