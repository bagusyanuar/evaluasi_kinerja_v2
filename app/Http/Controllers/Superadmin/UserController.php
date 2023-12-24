<?php

namespace App\Http\Controllers\Superadmin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class UserController extends CustomController
{
    //

    public function datatable($role)
    {
        $data = User::with("$role")->whereJsonContains('roles', $role);

        if ($role == 'accessorppk'){
            $data = User::with("accessorppk.ppk")->whereJsonContains('roles', $role);
        }

        return DataTables::of($data)->make(true);
    }

    public function index()
    {
        if (\request()->isMethod('POST')) {
            return $this->store();
        }

        return view('superuser.user.user');
    }

    public function store()
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

        if (\request('id')){
            $fieldUserEdit = \request()->validate(
                [
                    'email'    => 'required|string',
                    'username' => 'required|string',
                ]
            );
            $cekEmail = User::where([['email', '=', \request('email')], ['id', '!=', \request('id')]])->first();
            if ($cekEmail) {
                return \request()->validate(
                    [
                        'email' => 'required|string|unique:users,email',
                    ]
                );
            }

            $cekUsername   = User::where([['username', '=', \request('username')], ['id', '!=', \request('id')]])->first();
            if ($cekUsername) {
                return \request()->validate(
                    [
                        'username' => 'required|string|unique:users,username',
                    ]
                );
            }


        }else{
            \request()->validate(
                [
                    'email'    => 'required|string|unique:users,email',
                    'username' => 'required|string|unique:users,username',
                ]
            );
        }
        $roles         = \request('roles');
        Arr::set($field, 'roles', ["$roles"]);
        $files = \request()->file('profile');
        DB::beginTransaction();
        try {
            if (\request('id')) {

                Arr::set($field, 'username', $fieldUserEdit['username']);
                Arr::set($field, 'email', $fieldUserEdit['email']);


                $user = User::find(\request('id'));
                if ($files){
                    if ($user->image){
                        if (file_exists('../public' . $user->image)) {
                            unlink('../public' . $user->image);
                        }
                    }
                    $extension = $files->getClientOriginalExtension();
                    $name = $this->uuidGenerator().'.'.$extension;
                    $stringImg = '/images/profile/'.$name;
                    $this->uploadImage('profile',$name,'imagesProfile');
                    $user->update(['image' => $stringImg]);
                }
                if (strpos($fieldPassword['password'], '*') === false) {
                    $password = Hash::make($fieldPassword['password']);
                    Arr::set($field, 'password', $password);
                }
                $user->update($field);
                $user->$roles()->update(['name' => $field['name']]);
                if (\request('roles') == 'accessorppk'){
                    $user->$roles()->update(['ppk_id' => \request('selectPPK')]);
                }
                if (\request('roles') == 'vendor'){
                    $user->$roles()->update([
                        'kualifikasi' => \request('kualifikasi'),
                        'phone' => \request('phone'),
                        'npwp' => \request('npwp'),
                        'iujk' => \request('iujk'),
                        'address' => \request('address'),
                    ]);
                }
            } else {

                Arr::set($field, 'username', \request('username'));
                Arr::set($field, 'email', \request('email'));
                $password = Hash::make($fieldPassword['password']);
                Arr::set($field, 'password', $password);
                if ($files){
                    $extension = $files->getClientOriginalExtension();
                    $name = $this->uuidGenerator().'.'.$extension;
                    $stringImg = '/images/profile/'.$name;
                    $this->uploadImage('profile',$name,'imagesProfile');
                    Arr::set($field,'image',$stringImg);
                }
                $user = User::create($field);
                if (\request('roles') == 'accessorppk'){
                    Arr::set($field, 'ppk_id', \request('selectPPK'));
                }
                if (\request('roles') == 'vendor'){
                    Arr::set($field, 'kualifikasi', \request('kualifikasi'));
                    Arr::set($field, 'phone', \request('phone'));
                    Arr::set($field, 'npwp', \request('npwp'));
                    Arr::set($field, 'iujk', \request('iujk'));
                    Arr::set($field, 'address', \request('address'));
                }
                $user->$roles()->create($field);

            }
            DB::commit();

            return response()->json(['msg' => 'success']);
        }  catch (\Exception $er) {
            DB::rollBack();

            return response()->json(['msg' => $er->getMessage()], 500);
        }
    }

    public function getDetailUser(){
        $role = \request('role');
        $id = \request('id');
        $data = User::with("$role")->whereJsonContains('roles', $role)->find($id);

        if ($role == 'accessorppk'){
            $data = User::with("accessorppk.ppk")->whereJsonContains('roles', $role)->find($id);
        }

        return $data;
    }

    public function getCountUser(){
        $user = User::selectRaw('count(*) as count, roles')->groupBy('roles')->get();
        return $user;
    }



    public function delete($id){
        User::destroy($id);
        return response()->json(['msg' => 'success']);
    }

}
