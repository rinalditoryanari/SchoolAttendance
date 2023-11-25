<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllKelas()
    {
        return view('contents.admin.kelas.all-kelas', [
            'title' => 'Data Kelas',
            'kelas' => Kelas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAddKelas()
    {
        return view('contents.admin.kelas.add-kelas', [
            'title' => 'Tambah Data Kelas',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addKelas(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|max:2|unique:kelas',
            'nama' => 'required|max:255',
        ]);

        Kelas::create($validatedData);

        return redirect()->route('admin.kelas.showall')->with('success', 'Kelas baru telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function showEditKelas(Kelas $kelas)
    {
        return view('contents.admin.kelas.edit-kelas', [
            'title' => 'Edit Data Kelas',
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validatedData = $request->validate([
            'kode' => 'required|max:2',
            'nama' => 'required|max:255',
        ]);

        Kelas::where('id', $kelas->id)->update($validatedData);

        return redirect()->route('admin.kelas.showall')->with('success', 'Data kelas telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function delete(Kelas $kelas)
    {
        Kelas::destroy($kelas->id);
        return redirect()->route('admin.kelas.showall')->with('success', 'Data kelas telah dihapus!');
    }
}
