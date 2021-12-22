<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data['active'] = "dashboard";
        return view('admin.index',$data);
    }
    public function ind(){
        echo  'hello';
    }
}
