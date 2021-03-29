<?php

namespace App\Http\Controllers;

use App\SuratKeluar;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Berkas;
use FFI\Exception;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sk'] = SuratKeluar::with(['berkas2' => function ($q) {
            $q->where('surat_type', 'surat_keluar');
        }])->orderBy('id', 'DESC')->get();
        return view('pages.dataSK', $data);
        // return $data;
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
        $tdl = ($request->tindak_lanjut == null) ? "" : last($request->tindak_lanjut);

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

            return redirect('suratkeluar/' . $request->id_r);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['sk'] = SuratKeluar::findOrFail($id);

        $data['berkas'] = Berkas::where('surat_id', $data['sk']->id)->where('surat_type', 'surat_keluar')->get();

        return view('pages.showSK', $data);

        // return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['sk'] = SuratKeluar::where('id', $id)->first();
        $data['ss'] = explode(",", $data['sk']->tindak_lanjut);

        $data['berkas'] = Berkas::where('surat_id', $data['sk']->id)->where('surat_type', 'surat_keluar')->get();

        return view('pages.editSK', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tdl = ($request->tindak_lanjut == null) ? $request->tdl_null : last($request->tindak_lanjut);

        $data = [
            'tanggal_keluar' => $request->tanggal_keluar,
                'tujuan_surat' => $request->tujuan_surat,
                'nomor_surat' => $request->nomor_surat,
                'nomor_agenda' => $request->nomor_agenda,
                'perihal' => $request->perihal,
                'tindak_lanjut' => $tdl,
                'keterangan' => $request->keterangan,
                'konseptor' => $request->konseptor,
        ];

        $simpan = SuratKeluar::where('id', $id)->update($data);
        if ($simpan) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $data['sm'] = SuratKeluar::where('id', $id)->first();

            $data['db_berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_keluar')->get();


            // $data = Produk::with('foto_produk')->find($id);
            foreach ($data['db_berkas'] as $f) {
                $path = public_path('berkas/surat_keluar/') . $f->lokasi . '/' . $f->nama_berkas;
                unlink($path);
                Berkas::where('surat_id', $f->surat_id)->delete();
            }
            $hapus = $data['sm']->delete();
            if ($hapus) {
                DB::commit();
                return redirect('suratkeluar')->with([Toastr::success('Data Surat Keluar Berhasil Dihapus')]);
            }
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function get_berkas($id)
    {
        $data['sm'] = SuratKeluar::where('id', $id)->first();

        $data['db_berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_keluar')->get();


        foreach ($data['db_berkas'] as $berkas) {
            $namaBerkas[] = $berkas['nama_berkas'];
            $lokasi[] = $berkas['lokasi'];
        }

        $f = 'berkas/surat_keluar/' . $lokasi[0] . '/';
        $storeFolder = public_path('berkas/surat_keluar/' . $lokasi[0]);
        $files = scandir($storeFolder);

        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && in_array($file, $namaBerkas)) {
                $obj['name'] = $file;
                $file_path = public_path($f) . $file;
                $obj['size'] = filesize($file_path);
                $obj['path'] = url($f . $file);
                $datas[] = $obj;
            }
        }
        return $datas;
    }

    public function del_berkas_sk($id)
    {
        $data = Berkas::where('id', $id)->first();
        $path = public_path('berkas/surat_keluar/') . $data->lokasi . '/' . $data->nama_berkas;

        if (file_exists($path)) {
            $data->delete();
            unlink($path);
            return redirect()->back()->with([Toastr::warning('Berkas Berhasil Dihapus')]);
        } else {
            return redirect()->back()->with([Toastr::error('Berkas Santri Gagal Dihapus')]);
        }
    }
}
