<?php

namespace App\Http\Controllers;

use App\Exports\MhswExport;
use App\Imports\MhswImport;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function showAllMhsw()
    {
        return view('contents.admin.mahasiswa.show-all-mhsw', [
            'title' => 'Data Mahasiswa',
            'mahasiswas' => Mahasiswa::all()
        ]);
    }

    public function showAddMhsw()
    {
        return view('contents.admin.mahasiswa.add-mhsw', [
            'title' => 'Tambah Data Mahasiswa',
            'kelas' => Kelas::all(),
            'mahasiswas' => Mahasiswa::all()
        ]);
    }

    public function addMhsw(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|unique:mahasiswas|digits:6',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'namaAyah' => 'required|max:255',
            'namaIbu' => 'required|max:255',
            'tmpLahir' => 'max:255',
            'tglLahir' => '',
            'jnsKelamin' => '',
            'alamat' => '',
            'phone' => 'max:255|unique:mahasiswas',
            'password' => 'required|max:255',
            'email' => 'max:255|unique:mahasiswas',
            'kelas_id' => '',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create([
            'email' => $validatedData['email'],
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'password' => $validatedData['password'],
            "email_verified_at" => now(),
            "role" => 1,
        ]);

        $mahasiswa = new Mahasiswa($validatedData);
        $mahasiswa->user_id = $user->id;
        $mahasiswa->save();

        return redirect()->route('admin.mahasiswa.showall')->with('success', 'Mahasiswa baru telah ditambahkan!');
    }

    public function detailMhsw(Mahasiswa $mahasiswa)
    {
        return view('contents.admin.mahasiswa.detail-mhsw', [
            'title' => 'Detail Data Mahasiswa',
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function showEditMhsw(Mahasiswa $mahasiswa)
    {
        return view('contents.admin.mahasiswa.edit-mhsw', [
            'title' => 'Edit Data Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'kelas' => Kelas::all()
        ]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validatedData = $request->validate([
            'nim' => 'required|max:255|digits:6',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'namaAyah' => 'required|max:255',
            'namaIbu' => 'required|max:255',
            'tmpLahir' => 'max:255',
            'tglLahir' => '',
            'jnsKelamin' => '',
            'alamat' => 'max:255',
            'phone' => 'max:255',
            'password' => 'required|max:255',
            'email' => '',
            'kelas_id' => ''
        ]);

        $mahasiswa->user->password = bcrypt($validatedData['password']);
        $mahasiswa->user->email = $validatedData['email'];
        $mahasiswa->user->update();

        unset($validatedData['password']);
        $mahasiswa->update($validatedData);

        return redirect()->route('admin.mahasiswa.showall')->with('success', 'Data mahasiswa telah diupdate!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        Mahasiswa::destroy($mahasiswa->id);
        return redirect()->route('admin.mahasiswa.showall')->with('success', 'Data mahasiswa telah dihapus!');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new MhswExport, 'mahasiswa.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new MhswImport, request()->file('file'));

        return back();
    }
}
