<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
    
        // Query data pelanggan dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT * FROM pelanggan WHERE nama_pelanggan LIKE ? AND deleted = 0', ['%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data pelanggan
            $datas = DB::select('SELECT * FROM pelanggan WHERE deleted = 0');
        }
    
        return view('pelanggan.index')->with('datas', $datas)->with('searchTerm', $searchTerm);
    }
    
    //to show deleted data
    public function trash(Request $request)
    {
        $searchTerm = $request->input('search');
    
        // Query data pelanggan dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT * FROM pelanggan WHERE nama_pelanggan LIKE ? AND deleted = 1', ['%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data pelanggan
            $datas = DB::select('SELECT * FROM pelanggan WHERE deleted = 1');
        }
    
        return view('pelanggan.trash')->with('datas', $datas)->with('searchTerm', $searchTerm);
    }

    public function create()
    {
        return view('pelanggan.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'nomor_telepon' => 'required',
        ]);
        DB::insert(
            'INSERT INTO pelanggan(id_pelanggan, nama_pelanggan, nomor_telepon) VALUES (:id_pelanggan, :nama_pelanggan, :nomor_telepon)',
            [
                'id_pelanggan' => $request->id_pelanggan,
                'nama_pelanggan' => $request->nama_pelanggan,
                'nomor_telepon' => $request->nomor_telepon,
            ]
        );
        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil disimpan');
    }

    // public function edit a row from a table
    public function edit($id)
    {
        $data = DB::select("SELECT * FROM pelanggan WHERE id_pelanggan = $id");
        $data = $data[0];
        $datas = DB::select("SELECT * FROM pelanggan");
        return view('pelanggan.edit')->with('data', $data)->with('datas', $datas);
    }

     // public function to update the table value
    public function update($id, Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'nomor_telepon' => 'required',
        ]);

        DB::update(
            'UPDATE pelanggan SET nama_pelanggan = :nama_pelanggan, nomor_telepon = :nomor_telepon WHERE id_pelanggan = :id',
            [
                'id' => $id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'nomor_telepon' => $request->nomor_telepon,
            ]
        );
        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil diubah');
    }

    public function delete($id)
    {
        DB::update('UPDATE pelanggan SET deleted = 1 WHERE id_pelanggan = :id_pelanggan', ['id_pelanggan' => $id]);
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus');
    }

    public function restore($id)
    {
        DB::update('UPDATE pelanggan SET deleted = 0 WHERE id_pelanggan = :id_pelanggan', ['id_pelanggan' => $id]);
        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dipulihkan');
    }

    public function remove($id)
    {
        DB::delete('DELETE FROM pelanggan WHERE id_pelanggan = :id_pelanggan', ['id_pelanggan' => $id]);
        return redirect()->route('pelanggan.trash')->with('success', 'Data Pelanggan berhasil dihapus permanen');
    }
}
