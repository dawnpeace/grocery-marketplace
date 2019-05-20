<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Edit\DriverRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Driver;
use App\User;

class DriverController extends Controller
{
    public function edit($id)
    {   
        $driver = Driver::findOrFail($id)->load(['user']);
        return view('users.admin.profile-driver',['driver'=>$driver]);
    }

    public function update(DriverRequest $request,$id)
    {
        $driver = Driver::findOrFail($id)->load(["user"]);
        // get mass assignment array
        $reqArray = empty($request->password) ? $request->except('password') : $request->all();

        DB::transaction(function() use ($request,$reqArray,$driver){
            if(!empty($request->file('foto_profil')))
            {
                $reqArray['foto_profil'] = uniqid().'.'.$request->file('foto_profil')->extension();
                if(!empty($driver->foto_profil))
                {
                    Storage::disk('public')->delete('foto_profil/'.$driver->foto_profil);
                }
                $request->file('foto_profil')->storeAs("foto_profil",$reqArray['foto_profil'],'public');
            }
            $driver->update($reqArray);
            $driver->user()->update($reqArray);
        });
        return redirect()->back()->with('success',"Profil ".$driver->user->nama." berhasil diperbaharui !");
    }

    public function profil(Driver $driver)
    {
        $driver->load(['user']);
        return $driver;
    }
}
