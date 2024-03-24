<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
use Barryvdh\DomPDF\Facade\Pdf;

class KategoriController extends Controller
{
    public function index(){
        $kategori = kategori::all();
        return view('backend.content.kategori.list', compact('kategori'));

    }
    public function tambah(){
        return view('backend.content.kategori.formTambah');

    }
    public function prosesTambah(Request $request){
        $this->validate($request, [
            'nama_kategori' => 'required'
        ]);

        $kategori = new kategori();
        $kategori->nama_kategori = $request->nama_kategori;

        try {
            $kategori->save();
            return redirect(route('kategori.index'))->with('pesan',['success','Berhasil Tambah Data']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['danger','Gagal Tambah Data']);

        }
    }
    public function ubah($id){
        $kategori = kategori::findOrFail($id);
        return view('backend.content.kategori.formUbah', compact('kategori'));

    }
    public function prosesUbah(Request $request){
        $this->validate($request, [
            'id_kategori' => 'required',
            'nama_kategori' => 'required',
        ]);
        $kategori = kategori::findOrFail($request->id_kategori);
        $kategori->nama_kategori = $request->nama_kategori;

        try {
            $kategori->save();
            return redirect(route('kategori.index'))->with('pesan',['success','Berhasil Ubah Data']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['danger','Gagal Ubah Data']);

        }

    }
    public function hapus($id){
        $kategori = kategori::findOrFail($id);

        try {
            $kategori->delete();
            return redirect(route('kategori.index'))->with('pesan',['success','Berhasil Hapus Data']);
        }catch (\Exception $e){
            return redirect(route('kategori.index'))->with('pesan',['danger','Gagal Hapus Data']);

        }

    }

    public function exportPdf(){
        $kategori = kategori::all();
        $pdf = Pdf::loadView('backend.content.kategori.export', compact('kategori'));
        return $pdf->download('Data Kategori.pdf');
    }

}
