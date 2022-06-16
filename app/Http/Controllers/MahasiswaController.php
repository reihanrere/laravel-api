<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = mahasiswa::all();

        return response()->json(['code' => '00','message' => 'success', 'data' => $data]);
    }

    public function create(Request $request)
    {
        mahasiswa::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json(['code' => '00','message' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = mahasiswa::find($id);

        $data = [
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
        ];

        $mahasiswa->update($data);

        return response()->json(['code' => '00','message' => 'success']);
    }

    public function delete($id)
    {
        $data = mahasiswa::find($id);
        $data->delete();

        return response()->json(['code' => '00','message' => 'success']);
    }

    public function profile($id)
    {
        $data = mahasiswa::find($id);

        return response()->json(['code' => '00','message' => 'success', 'data' => $data]);
    }
}
