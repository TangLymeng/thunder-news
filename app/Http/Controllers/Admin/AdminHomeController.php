<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeAdvertisement;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {

        return view('admin.home');
    }
}
