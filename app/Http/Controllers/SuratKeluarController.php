<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dataSK');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = SuratKeluar::count();

        $data['id'] = ($count == 0) ? 1 : SuratKeluar::all()->last()->id + 1;
        $data['na'] = ($count == 0) ? 0 : SuratKeluar::all()->last()->nomor_agenda;
        return view('pages.tambahSK', $data);

        // return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tdl = ($request->tindak_lanjut == null) ? "" : implode(",", $request->tindak_lanjut);

        if ($request->ajax()) {
            SuratKeluar::create([
                'tanggal_keluar' => $request->tanggal_keluar,
                'tujuan_surat' => $request->tujuan_surat,
                'nomor_surat' => $request->nomor_surat,
                'nomor_agenda' => $request->nomor_agenda,
                'perihal' => $request->perihal,
                'tindak_lanjut' => $tdl,
                'keterangan' => $request->keterangan,
                'konseptor' => $request->konseptor,
            ]);

            return redirect('suratkeluar/' . $request->id_r)->with([Toastr::success('Data Surat Keluar Berhasil Ditambah')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        //
    }
}
