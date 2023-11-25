<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DosenController extends Controller
{
    public function showAllDosen()
    {
        return view('contents.admin.data-dosen.show_all_dosen', [
            'title' => 'Data Dosen',
            'dosens' => Dosen::all(),
        ]);
    }

    public function showAddDosen()
    {
        return view('contents.admin.data-dosen.new-dosen', [
            'title' => 'Tambah Data Dosen',
        ]);
    }

    public function addDosen(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|unique:dosens|digits:16',
            'phone' => 'max:255|unique:dosens',
            'email' => 'max:255|unique:dosens',
            'password' => 'required|max:255',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'tmpLahir' => 'max:255',
            'tglLahir' => '',
            'jns_kelamin' => '',
            'alamat' => '',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create([
            'email' => $validatedData['email'],
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'password' => $validatedData['password'],
            "email_verified_at" => now(),
            "role" => 2,
        ]);

        $dosen = new Dosen($validatedData);
        $dosen->user_id = $user->id;
        $dosen->save();

        return redirect()->route('admin.dosen.showall')->with('success', 'Guru baru telah ditambahkan!');
    }

    public function detailDosen(Dosen $dosen)
    {
        return view('contents.admin.data-dosen.detail-dosen', [
            'title' => 'Detail Data Dosen',
            'dosen' => $dosen
        ]);
    }

    public function showEditDosen(Dosen $dosen)
    {
        return view('contents.admin.data-dosen.edit-dosen', [
            'title' => 'Edit Data Dosen',
            'dosen' => $dosen,
        ]);
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validatedData = $request->validate([
            'nik' => 'required|digits:16',
            'phone' => 'max:255',
            'email' => 'max:255',
            'password' => 'required|max:255',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'tmpLahir' => 'max:255',
            'tglLahir' => '',
            'jnsKelamin' => '',
            'alamat' => '',
        ]);

        $dosen->user->password = bcrypt($validatedData['password']);
        $dosen->user->email = $validatedData['email'];
        $dosen->user->update();

        unset($validatedData['password']);
        $dosen->update($validatedData);

        return redirect()->route('admin.dosen.showall')->with('success', 'Data Guru telah diupdate!');
    }

    public function delete(Dosen $dosen)
    {
        $dosen->user->delete();
        $dosen->delete();
        return redirect()->route('admin.dosen.showall')->with('success', 'Data guru telah dihapus!');
    }

    public function reviewRekap()
    {
        //r\
    }

    public function rekapPdf()
    {
        //

    }

    public function rekapExcel()
    {
        //
    }
}
