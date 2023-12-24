<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\PPK;

class PPKController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $ppk = PPK::with('accessorPpk')->get();
        return $ppk->toArray();
    }
}
