<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use App\Enums\UserLevel;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'username', 'email', 'password', 'jenis',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function type()
    {
        return ucfirst(strtolower($this->jenis));
    }

    public function admin()
    {
        return $this->hasOne("App\Admin");
    }

    public function driver()
    {
        return $this->hasOne("App\Driver");
    }

    public function penjual()
    {
        return $this->hasOne("App\Penjual");
    }

    public function pembeli()
    {
        return $this->hasOne("App\Pembeli");
    }

    public function tanggalDaftar()
    {
        $tanggal = Carbon::parse($this->created_at);
        return $tanggal->isoFormat("d MMMM Y");
    }

    public function profilUrl()
    {
        switch($this->jenis){
            case UserLevel::DRIVER:
                return route('driver.profil.edit');
            case UserLevel::PENJUAL:
                return route('penjual.profil.edit');
            case UserLevel::PEMBELI:
                return route('pembeli.profil.edit');
            default:
                return '#';
        }
    }

    public function dashboardUrl()
    {
        switch($this->jenis){
            case UserLevel::DRIVER:
                return route('driver.dashboard');
            case UserLevel::PENJUAL:
                return route('penjual.dashboard');
            case UserLevel::PEMBELI:
                return route('dashboard');
            case UserLevel::SUPERADMIN:
                return route('admin.dashboard');
            default:
                return '#';
        }
    }

}
