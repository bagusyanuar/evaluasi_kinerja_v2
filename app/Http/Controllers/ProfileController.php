<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends CustomController
{
    //

    public function profile()
    {
        $roles = auth()->user()->roles[0];
        $user  = User::with("$roles")->find(Auth::id());

        return $user;
    }

    public function package()
    {
        $roles  = auth()->user()->roles[0];
        $pakage = [];
        if ($roles == 'accessorppk') {
            $packageGoing = Package::whereHas(
                'ppk.accessorppk',
                function ($q) {
                    $q->where('user_id', '=', Auth::id());
                }
            )->where([['start_at', '<=', date('Y-m-d', strtotime(now('Asia/Jakarta')))], ['finish_at', '>=', date('Y-m-d', strtotime(now('Asia/Jakarta')))]])->count('*');
            $packagePast  = Package::whereHas(
                'ppk.accessorppk',
                function ($q) {
                    $q->where('user_id', '=', Auth::id());
                }
            )->where('finish_at', '<', date('Y-m-d', strtotime(now('Asia/Jakarta'))))->count('*');
            $vendor       = Package::whereHas(
                'ppk.accessorppk',
                function ($q) {
                    $q->where('user_id', '=', Auth::id());
                }
            )->where([['start_at', '<=', date('Y-m-d', strtotime(now('Asia/Jakarta')))], ['finish_at', '>=', date('Y-m-d', strtotime(now('Asia/Jakarta')))]])
                                   ->selectRaw('vendor_id')->groupBy(['vendor_id'])->get();
            Arr::set($pakage, 'packageGoing', $packageGoing);
            Arr::set($pakage, 'packagePast', $packagePast);
            Arr::set($pakage, 'vendor', count($vendor));
        } elseif ($roles == 'accessor') {
            $packageGoing = Package::where([['start_at', '<=', date('Y-m-d', strtotime(now('Asia/Jakarta')))], ['finish_at', '>=', date('Y-m-d', strtotime(now('Asia/Jakarta')))]])->count('*');
            $packagePast  = Package::where('finish_at', '<', date('Y-m-d', strtotime(now('Asia/Jakarta'))))->count('*');
            $vendor       = Package::where([['start_at', '<=', date('Y-m-d', strtotime(now('Asia/Jakarta')))], ['finish_at', '>=', date('Y-m-d', strtotime(now('Asia/Jakarta')))]])
                                   ->selectRaw('vendor_id')->groupBy(['vendor_id'])->get();
            Arr::set($pakage, 'packageGoing', $packageGoing);
            Arr::set($pakage, 'packagePast', $packagePast);
            Arr::set($pakage, 'vendor', count($vendor));
        }elseif ($roles == 'vendor'){
            $packageGoing = Package::where([['vendor_id','=',Auth::id()],['start_at', '<=', date('Y-m-d', strtotime(now('Asia/Jakarta')))], ['finish_at', '>=', date('Y-m-d', strtotime(now('Asia/Jakarta')))]])->count('*');
            $packagePast  = Package::where([['vendor_id','=',Auth::id()],['finish_at', '<', date('Y-m-d', strtotime(now('Asia/Jakarta')))]])->count('*');
            Arr::set($pakage, 'packageGoing', $packageGoing);
            Arr::set($pakage, 'packagePast', $packagePast);
        }

        return $pakage;
    }

    public function updateImg()
    {
        $user  = User::find(Auth::id());
        $files = \request()->file('profile');
        if ($user->image) {
            if (file_exists('../public'.$user->image)) {
                unlink('../public'.$user->image);
            }
        }
        $extension = $files->getClientOriginalExtension();
        $name      = $this->uuidGenerator().'.'.$extension;
        $stringImg = '/images/profile/'.$name;
        $this->uploadImage('profile', $name, 'imagesProfile');
        $user->update(['image' => $stringImg]);

        return response()->json(['msg' => 'berhasil']);
    }

    public function update()
    {
        $field         = \request()->validate(
            [
                'name' => 'required',
            ]
        );
        $fieldPassword = \request()->validate(
            [
                'password' => 'required|confirmed',
            ]
        );

        $fieldUserEdit = \request()->validate(
            [
                'email'    => 'required|string',
                'username' => 'required|string',
            ]
        );
        $cekEmail      = User::where([['email', '=', \request('email')], ['id', '!=', \request('id')]])->first();
        if ($cekEmail) {
            return \request()->validate(
                [
                    'email' => 'required|string|unique:users,email',
                ]
            );
        }

        $cekUsername = User::where([['username', '=', \request('username')], ['id', '!=', \request('id')]])->first();
        if ($cekUsername) {
            return \request()->validate(
                [
                    'username' => 'required|string|unique:users,username',
                ]
            );
        }

        $roles = Auth::user()->roles[0];
        DB::beginTransaction();
//        try {
            Arr::set($field, 'username', $fieldUserEdit['username']);
            Arr::set($field, 'email', $fieldUserEdit['email']);

            $user = Auth::user();
            if (strpos($fieldPassword['password'], '*') === false) {
                $password = Hash::make($fieldPassword['password']);
                Arr::set($field, 'password', $password);
            }
            $user->update($field);
            $user->$roles()->update(['name' => $field['name']]);
            if (\request('roles') == 'vendor'){
                $fieldVendor = \request()->validate([
                    'phone' => 'required',
                    'npwp' => 'required',
                    'iujk' => 'required',
                    'address' => 'required',
                ]);
                $user->$roles()->update($fieldVendor);
            }
            DB::commit();

            return response()->json(['msg' => 'success']);
//        } catch (\Exception $er) {
//            DB::rollBack();
//
//            return response()->json(['msg' => $er->getMessage()], 500);
//        }
    }
}
