<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\IndonesianPhoneNumber as RuleNumber;

class DriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'username' => ['required', 'regex:/^[a-zA-Z0-9_.]*$/', 'between:5,18', 'unique:users,username'],
            'plat_nomor_kendaraan' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'between:3,9', 'unique:tb_driver,plat_nomor_kendaraan'],
            'kota' => ['required','string', 'max:191'],
            'alamat' => ['required','string', 'max:191'],
            'no_telp' => ['required','string',new RuleNumber],
            'nomor_sim' => ['required','string','unique:tb_driver,nomor_sim'],
            'foto_profil' => ['required','mimes:jpeg,jpg,png','max:500'],
            'foto_sim' => ['required','mimes:jpeg,jpg,png','max:500'],
            'foto_profil' => ['required','file','mimes:jpg,jpeg,png','max:1024']
        ];
    }

    
}
