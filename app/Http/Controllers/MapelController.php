<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllMapel()
    {
        return view('contents.admin.mapel.all-mapel', [
            'title' => 'Data Mapel',
            'mapels' => Mapel::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAddMapel()
    {
        return view('contents.admin.mapel.add-mapel', [
            'title' => 'Tambah Data Mapel',
            'kelas' => Kelas::all(),
            'dosens' => Dosen::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addMapel(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|max:10|unique:mapels',
            'nama' => 'required|max:255',
            'kelas_id' => 'required',
            'dosen_id' => 'required',
        ]);

        Mapel::create($validatedData);

        return redirect()->route('admin.mapel.showall')->with('success', 'Mapel baru telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function showEditMapel(Mapel $mapel)
    {
        return view('contents.admin.mapel.edit-mapel', [
            'title' => 'Edit Data Mapel',
            'mapel' => $mapel,
            'dosens' => Dosen::all(),
            'kelas' => Kelas::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        $validatedData = $request->validate([
            'kode' => 'required|max:10',
            'nama' => 'required|max:255',
            'kelas_id' => 'required',
            'dosen_id' => 'required',
        ]);

        Mapel::where('id', $mapel->id)->update($validatedData);

        return redirect()->route('admin.mapel.showall')->with('success', 'Data Mapel telah diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        Mapel::destroy($mapel->id);
        return redirect()->route('admin.mapel.showall')->with('success', 'Data mapel telah dihapus!');
    }
}
