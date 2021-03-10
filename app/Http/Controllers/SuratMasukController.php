<?php

namespace App\Http\Controllers;

use App\SuratMasuk;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dataSM');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tambahSM');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::createFromFormat('m-d-Y', $request->tanggal_terima)->format('Y-m-d');
        $data = [
            'tanggal_terima' => $date,
            'asal_surat' => $request->asal_surat,
            'nomor_surat' => $request->nomor_surat,
            'perihal' => $request->perihal,
            'idk' => $request->idk,
            'lajur_disposisi' => $request->lajur_disposisi,
            'keterangan' => $request->keterangan,
            'id_berkas' => $request->id_berkas,
        ];

        $simpan = SuratMasuk::create($data);
        if ($simpan) {
            return redirect()->back()->with([Toastr::success('Data Jejak Ekstrakurikuler Santri Berhasil ditambahkan')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        //
    }
}
