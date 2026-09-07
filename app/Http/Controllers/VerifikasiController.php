<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $kode = $request->query('kode');

        return view('verifikasi.index', compact('kode'));
    }
}