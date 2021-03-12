<?php

namespace App\Http\Controllers;

use App\SuratMasuk;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use App\Berkas;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sm'] = SuratMasuk::orderBy('id', 'DESC')->get();
        return view('pages.dataSM', $data);
        // return $data;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $count = SuratMasuk::count();

        $data['id'] = ($count == 0) ? 1 : SuratMasuk::all()->last()->id + 1; ;
        
        // return $data;
     
        return view('pages.tambahSM', $data);
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
        if ($request->ajax()) {
            SuratMasuk::create([
                'tanggal_terima' => $date,
                'asal_surat' => $request->asal_surat,
                'nomor_surat' => $request->nomor_surat,
                'perihal' => $request->perihal,
                'idk' => $request->idk,
                'lajur_disposisi' => implode(",",$request->lajur_disposisi),
                'keterangan' => $request->keterangan,
            ]);

            return response()->json([
                'pesan' => 'sukses',
            ], 201);
        }

        // $simpan = SuratMasuk::create($data);
        // if ($simpan) {
        //     return redirect()->back()->with([Toastr::success('Data Jejak Ekstrakurikuler Santri Berhasil ditambahkan')]);
        // }
    }

    public function upload_berkas(Request $request)
    {
        $berkas = $request->file('file');

        $name = uniqid() . '_ks_' . trim($berkas->getClientOriginalName());

        $bulan = Carbon::parse($request->bulan)->isoFormat('MMMM_Y');

        $berkas->move('berkas/'.$bulan , $name);

        // --------- [ Resize Image ] ---------------
        // $img->resize(150, 200)->save('assets/foto_produk/'.$name);

        Berkas::create([
            'nama_berkas' => $name,
            'surat_type' => 'surat_masuk',
            'surat_id' => $request->id,
            'lokasi' => $bulan
        ]);

        return response()->json(['success' => $name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['sm'] = SuratMasuk::where('id', $id)->first();

        $data['berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_masuk')->get();

        return view('pages.showSM', $data);

        // return $data;
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
