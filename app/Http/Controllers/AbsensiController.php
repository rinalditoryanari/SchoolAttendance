<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllAbsensi()
    {
        return view('contents.admin.absensi.all-ket-absensi', [
            'title' => 'Data Keterangan Absensi',
            'absensis' => Absensi::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAddAbsensi()
    {
        return view('contents.admin.absensi.add-ket-absensi', [
            'title' => 'Tambah Data Keterangan Presensi',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addAbsensi(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|max:3|unique:absensis',
            'keterangan' => 'required|max:255',
        ]);

        Absensi::create($validatedData);

        return redirect()->route('admin.absensi.showall')->with('success', 'Keterangan presensi baru telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function showEditAbsensi(Absensi $absensi)
    {
        return view('contents.admin.absensi.edit-ket-absensi', [
            'title' => 'Edit Data Keterangan Presensi',
            'absensi' => $absensi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        $validatedData = $request->validate([
            'kode' => 'required|max:3',
            'keterangan' => 'required|max:255',
        ]);

        Absensi::where('id', $absensi->id)->update($validatedData);

        return redirect()->route('admin.absensi.showall')->with('success', 'Data keterangan presensi telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        Absensi::destroy($absensi->id);
        return redirect()->route('admin.absensi.showall')->with('success', 'Data keterangan presensi telah dihapus!');
    }
}
