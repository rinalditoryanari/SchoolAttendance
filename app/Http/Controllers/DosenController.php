<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function showAllDosen()
    {
        return view('contents.admin.data-dosen.show_all_dosen', [
            'title' => 'Data Guru',
            'gurus' => Dosen::all(),
        ]);
    }

    public function addDosen()
    {
        return view('home.contents.guru.create', [
            'title' => 'Tambah Data Guru',
        ]);
    }
}
