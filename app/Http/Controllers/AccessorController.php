<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Accessor;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccessorController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $accessor = Accessor::with('user')->get();
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
                $user->roles = ["ROLE_ACCESSOR"];
                $user->save();

                $accessor = new Accessor();
                $accessor->name = $this->postField('name');
                $accessor->user_id = $user->id;
                $accessor->save();
            });
            return response()->json('success', 200);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }
}
