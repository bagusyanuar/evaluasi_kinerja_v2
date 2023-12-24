<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\AccessorPPK;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccessorPpkController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $accessor = AccessorPPK::with('ppk')->get();
        return $accessor->toArray();
    }

    public function store()
    {
        try {
            DB::transaction(function (){
                $user = new User();
                $user->email = $this->postField('email');
                $user->username = $this->postField('username');
                $user->password = Hash::make($this->postField('password'));
                $user->roles = ["ROLE_ACCESSORPPK"];
                $user->save();

                $accessor = new AccessorPPK();
                $accessor->name = $this->postField('name');
                $accessor->user_id = $user->id;
                $accessor->ppk_id = $this->postField('ppk');
                $accessor->save();
            });
            return response()->json('success', 200);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }


}
