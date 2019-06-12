<?php

namespace App\Http\Requests\Edit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Driver;
use App\User;
use App\Rules\IndonesianPhoneNumber;

class DriverRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $driver = Driver::findOrFail($request->id);
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users','email')->ignore($driver->user->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'username' => ['required', 'regex:/^[a-zA-Z0-9._]*$/', 'between:5,24', Rule::unique('users','username')->ignore($driver->user->id)],
            'plat_nomor_kendaraan' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'between:3,9', Rule::unique('tb_driver','plat_nomor_kendaraan')->ignore($driver->id)],
            'kota' => ['required','string', 'max:191'],
            'alamat' => ['required','string', 'max:191'],
            'no_telp' => ['required','string', new IndonesianPhoneNumber],
            'foto_profil' => ['nullable','file','mimes:jpg,jpeg,png','max:1024']
        ];
    }
}
