<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataWisata;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('dashboard.index', [
            'wisata' => DataWisata::all(),
        ]);
    }
}
