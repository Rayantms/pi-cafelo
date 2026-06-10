<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'vendasHoje' => 4250,
            'pontosDistribuidos' => 1850,
            'resgatesHoje' => 24,
            'novosClientes' => 18,
        ]);
    }
}
