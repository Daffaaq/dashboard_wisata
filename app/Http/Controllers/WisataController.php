<?php

namespace App\Http\Controllers;

use App\Models\DataWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pengambilan data barang di tabel barang
        $datawisata = DataWisata::all();

        // mengirim data ke view index
        return view('dashboard.wisata.index', ['wisata' => $datawisata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.wisata.tambah-wisata', [
            'wisata' => DataWisata::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|min:3|max:255',
            'lokasi' => 'required|min:3|max:255',
            'jam' => 'required|min:3|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable',
            'gambar' => 'required|image'
        ]);

        if ($request->file('gambar')) {
            $nama_gambar = $request->file('gambar')->store('wisata-images','public');
        }

        $validatedData['gambar'] = $nama_gambar;

        DataWisata::create($validatedData);

        // $request->session()->flash('success', 'Data barang berhasil ditambahkan');

        return redirect('/dashboard/wisata')->with('success', 'Data Wisata berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataWisata  $DataWisata
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datawisata = DataWisata::find($id)->first();
        return view('dashboard.wisata.detail-wisata',compact('datawisata'));
        // return view('dashboard.wisata.detail-wisata', [
        //     'wisata' => $datawisata
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataWisata  $DataWisata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('dashboard.wisata.edit-wisata', [
        //     'wisata' => $datawisata,
        //     'id' => $datawisata->id
        // ]);
        $datawisata = DataWisata::find($id)->first();
        return view('dashboard.wisata.edit-wisata',compact('datawisata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $rules = ([
        'nama' => 'required|min:3|max:255',
        'lokasi' => 'required|min:3|max:255',
        'jam' => 'required|min:3|max:255',
        'harga' => 'required|integer',
        'deskripsi' => 'nullable',
        'gambar' => 'required|image'
    ]);

    $validatedData = $request->validate($rules);

    if ($request->file('gambar')) {
        if ($request->gambar) {
            Storage::delete($request->gambar);
        }
        $nama_gambar = $request->file('gambar')->store('wisata-images', 'public');
        $validatedData['gambar'] = $nama_gambar;
    }

    $datawisata = DataWisata::findOrFail($id);
    $datawisata->update($validatedData);

    $request->session()->flash('success', 'Data Wisata berhasil diupdate');

    return redirect('/dashboard/wisata');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataWisata  $DataWisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataWisata $datawisata)
    {
        if ($datawisata->gambar) {
            Storage::delete($datawisata->gambar);
        }

        DataWisata::where($datawisata->id)-> delete();
        return redirect('dashboard/wisata')->with('success', 'Data wisata berhasil dihapus');
    }

    // public function getWisata()
    // {
    //     $dataWisata = DataWisata::all(); // Mengambil data dari database

    //     return response()->json($dataWisata);
    // }
}
