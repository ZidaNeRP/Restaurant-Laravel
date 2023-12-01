<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        // Query data pesanan dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT * 
            FROM pesanan 
            JOIN menu ON pesanan.id_menu = menu.id_menu 
            JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan 
            WHERE nama_menu LIKE ? AND pesanan.deleted = 0', ['%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data pesanan
            $datas = DB::select('SELECT * 
            FROM pesanan 
            JOIN menu ON pesanan.id_menu = menu.id_menu 
            JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan 
            WHERE pesanan.deleted = 0');
        }

        return view('pesanan.index')->with('datas', $datas)->with('searchTerm', $searchTerm);
    }

    public function trash(Request $request)
    {
        $searchTerm = $request->input('search');

        // Query data pesanan dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT * 
            FROM pesanan 
            JOIN menu ON pesanan.id_menu = menu.id_menu 
            JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan 
            WHERE nama_menu LIKE ? AND pesanan.deleted = 1', ['%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data pesanan
            $datas = DB::select('SELECT * 
            FROM pesanan 
            JOIN menu ON pesanan.id_menu = menu.id_menu 
            JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan 
            WHERE pesanan.deleted = 1');
        }

        return view('pesanan.trash')->with('datas', $datas)->with('searchTerm', $searchTerm);
    }

    public function create()
    {
        $menus = DB::select("SELECT * FROM menu");
        $pelanggans = DB::select("SELECT * FROM pelanggan");
        return view('pesanan.add')->with('menus', $menus)->with('pelanggans', $pelanggans);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pesanan' => 'required',
            'tanggal' => 'required',
            'id_menu' => 'required',
            'id_pelanggan' => 'required',
        ]);

        DB::insert(
            'INSERT INTO pesanan(id_pesanan, tanggal, id_menu, id_pelanggan) VALUES (:id_pesanan, :tanggal, :id_menu, :id_pelanggan)',
            [
                'id_pesanan' => $request->id_menu,
                'tanggal' => $request->tanggal,
                'id_menu' => $request->id_menu,
                'id_pelanggan' => $request->id_pelanggan,
            ]
        );

        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::select("SELECT * FROM pesanan WHERE id_pesanan = $id");
        $data = $data[0];
        $menus = DB::select("SELECT * FROM menu");
        $pelanggans = DB::select("SELECT * FROM pelanggan");
        return view('pesanan.edit')->with('data', $data)->with('menus', $menus)->with('pelanggans', $pelanggans);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'id_menu' => 'required',
            'id_pelanggan' => 'required',
        ]);

        DB::update(
            'UPDATE pesanan SET  tanggal = :tanggal,id_menu = :id_menu, id_pelanggan = :id_pelanggan WHERE id_pesanan = :id',
            [
                'id' => $id,
                'tanggal' => $request->tanggal,
                'id_menu' => $request->id_menu,
                'id_pelanggan' => $request->id_pelanggan,
            ]
        );

        return redirect()->route('pesanan.index')->with('success', 'Data Pesanan berhasil diubah');
    }

    public function delete($id)
    {
        DB::update('UPDATE pesanan SET deleted = 1 WHERE id_pesanan = :id_pesanan', ['id_pesanan' => $id]);
        return redirect()->route('pesanan.index')->with('success', 'Data Pesanan berhasil dihapus');
    }

    public function restore($id)
    {
        DB::update('UPDATE pesanan SET deleted = 0 WHERE id_pesanan = :id_pesanan', ['id_pesanan' => $id]);
        return redirect()->route('pesanan.index')->with('success', 'Data Pesanan berhasil dipulihkan');
    }

    public function remove($id)
    {
        DB::delete('DELETE FROM pesanan WHERE id_pesanan = :id_pesanan', ['id_pesanan' => $id]);
        return redirect()->route('pesanan.trash')->with('success', 'Data Pesanan berhasil dihapus permanen');
    }
}
