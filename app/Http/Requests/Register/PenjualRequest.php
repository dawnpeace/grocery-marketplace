<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\IndonesianPhoneNumber as RuleNumber;


class PenjualRequest extends FormRequest
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
            'nama_penjual' => ['required', 'string', 'max:255'],
            'email_penjual' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password_penjual' => ['required', 'string', 'min:6', 'confirmed'],
            'username_penjual' => ['required', 'regex:/^[a-zA-Z0-9_]*$/', 'between:5,12', 'unique:users,username'],
            'kota_penjual' => ['required','string', 'max:191'],
            'alamat_penjual' => ['required','string', 'max:191'],
            'no_telp_penjual' => ['required','string', new RuleNumber],
            'nama_toko' => ['required','string'],
            'pasar_id' => ['required','exists:tb_pasar,id'],
            'foto_profil_penjual' => ['nullable','file','mimes:jpg,jpeg,png','max:1024']
        ];
    }
}
