<?php

namespace App\Http\Controllers;
use App\Models\Data;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dataTerakhir(){
        $data_terakhir=Data::orderBy('id','desc')
        ->take(1)->get();

        return view('content.dashboard', compact('data_terakhir'));
    }
}
