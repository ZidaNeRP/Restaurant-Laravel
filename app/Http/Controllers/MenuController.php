<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
    
        // Query data menu dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT * FROM menu WHERE nama_menu LIKE ? AND deleted = 0', ['%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data menu
            $datas = DB::select('SELECT * FROM menu WHERE deleted = 0');
        }
    
        return view('menu.index')->with('datas', $datas)->with('searchTerm', $searchTerm);
    }
    
    //to show deleted data
    public function trash(Request $request)
    {
        $searchTerm = $request->input('search');
    
        // Query data menu dengan filter berdasarkan nama jika search term ada
        if ($searchTerm) {
            $datas = DB::select('SELECT * FROM menu WHERE nama_menu LIKE ? AND deleted = 1', ['%' . $searchTerm . '%']);
        } else {
            // Jika tidak ada search term, tampilkan semua data menu
            $datas = DB::select('SELECT * FROM menu WHERE deleted = 1');
        }
    
        return view('menu.trash')->with('datas', $datas)->with('searchTerm', $searchTerm);
    }

    public function create()
    {
        return view('menu.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_menu' => 'required',
            'nama_menu' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);
        DB::insert(
            'INSERT INTO menu(id_menu, nama_menu, harga, deskripsi) VALUES (:id_menu, :nama_menu, :harga, :deskripsi)',
            [
                'id_menu' => $request->id_menu,
                'nama_menu' => $request->nama_menu,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
            ]
        );
        return redirect()->route('menu.index')->with('success', 'Data Menu berhasil disimpan');
    }

    // public function edit a row from a table
    public function edit($id)
    {
        $data = DB::select("SELECT * FROM menu WHERE id_menu = $id");
        $data = $data[0];
        $datas = DB::select("SELECT * FROM menu");
        return view('menu.edit')->with('data', $data)->with('datas', $datas);
    }

     // public function to update the table value
    public function update($id, Request $request)
    {
        $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        DB::update(
            'UPDATE menu SET nama_menu = :nama_menu, harga = :harga, deskripsi = :deskripsi WHERE id_menu = :id',
            [
                'id' => $id,
                'nama_menu' => $request->nama_menu,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
            ]
        );
        return redirect()->route('menu.index')->with('success', 'Data Menu berhasil diubah');
    }

    public function delete($id)
    {
        DB::update('UPDATE menu SET deleted = 1 WHERE id_menu = :id_menu', ['id_menu' => $id]);
        return redirect()->route('menu.index')->with('success', 'Data Menu berhasil dihapus');
    }

    public function restore($id)
    {
        DB::update('UPDATE menu SET deleted = 0 WHERE id_menu = :id_menu', ['id_menu' => $id]);
        return redirect()->route('menu.index')->with('success', 'Data Menu berhasil dipulihkan');
    }

    public function remove($id)
    {
        DB::delete('DELETE FROM menu WHERE id_menu = :id_menu', ['id_menu' => $id]);
        return redirect()->route('menu.trash')->with('success', 'Data Menu berhasil dihapus permanen');
    }
}
