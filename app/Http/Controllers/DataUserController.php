<?php

namespace App\Http\Controllers;

use App\Models\DataUser;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        $users= DataUser::all();
        return view('dashbord.pages.datauser', ['datauser' =>$users]);
    }
}
