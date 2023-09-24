<?php

namespace App\Http\Controllers;

use App\SuratMasuk;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use App\Berkas;
use FFI\Exception;
use Illuminate\Support\Facades\DB;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sm'] = SuratMasuk::with(['berkas' => function ($q) {
            $q->where('surat_type', 'surat_masuk');
        }])->orderBy('created_at', 'DESC')->get();
        return view('pages.dataSM', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $count = SuratMasuk::count();

        $data['id'] = ($count == 0) ? 1 : SuratMasuk::all()->last()->id + 1;
        $data['na'] = ($count == 0) ? 0 : SuratMasuk::all()->last()->nomor_agenda;

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
        // $date = Carbon::createFromFormat('d/m/Y', $request->tanggal_terima)->format('Y-m-d');
        $ss = ($request->sifat_surat == null) ? "" : implode(",", $request->sifat_surat);
        $lj = ($request->lajur_disposisi == null) ? "" : implode(",", $request->lajur_disposisi);
        $ct = ($request->catatan == null) ? "" : implode(",", $request->catatan);
        $tdl = ($request->tindak_lanjut == null) ? "" : implode(",", $request->tindak_lanjut);

        if ($request->ajax()) {
            SuratMasuk::create([
                'tanggal_terima' => $request->tanggal_terima,
                'asal_surat' => $request->asal_surat,
                'nomor_surat' => $request->nomor_surat . '_tgl_' . $request->tanggal_surat,
                'nomor_agenda' => $request->nomor_agenda,
                'perihal' => $request->perihal,
                'lajur_disposisi' => $lj,
                'catatan' => $ct,
                'sifat_surat' => $ss,
                'tindak_lanjut' => $tdl,
                'keterangan1' => $request->keterangan1,
                'keterangan2' => $request->keterangan2,
                'tls' => $request->tls,
            ]);

            return redirect('suratmasuk/' . $request->id_r);
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

        $berkas->move('berkas/' . $request->type . '/' . $bulan, $name);

        Berkas::create([
            'nama_berkas' => $name,
            'surat_type' => $request->type,
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
        $data['sm'] = SuratMasuk::findOrFail($id);

        $data['ss'] = ($data['sm']->sifat_surat == null) ? explode(",", "a") : explode(",", $data['sm']->sifat_surat);
        $data['lj'] = ($data['sm']->lajur_disposisi == null) ? explode(",", "a") : explode(",", $data['sm']->lajur_disposisi);
        $data['ct'] = ($data['sm']->catatan == null) ? explode(",", "a") : explode(",", $data['sm']->catatan);
        $data['tdl'] = ($data['sm']->tindak_lanjut == null) ? explode(",", "a") : explode(",", $data['sm']->tindak_lanjut);

        $data['berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_masuk')->get();

        return view('pages.showSM', $data);

        // return $data;
    }

    public function print($id)
    {
        $data['sm'] = SuratMasuk::where('id', $id)->first();

        $data['ss'] = explode(",", $data['sm']->sifat_surat);
        $data['lj'] = explode(",", $data['sm']->lajur_disposisi);
        $data['ct'] = explode(",", $data['sm']->catatan);
        $data['tdl'] = explode(",", $data['sm']->tindak_lanjut);

        $data['berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_masuk')->get();

        return view('pages.printSM', $data);

        // return $data;
    }

    public function printlama($id)
    {
        $data['sm'] = SuratMasuk::where('id', $id)->first();

        $data['ss'] = explode(",", $data['sm']->sifat_surat);
        $data['lj'] = explode(",", $data['sm']->lajur_disposisi);
        $data['ct'] = explode(",", $data['sm']->catatan);
        $data['tdl'] = explode(",", $data['sm']->tindak_lanjut);

        $data['berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_masuk')->get();

        return view('pages.printSMlama', $data);

        // return $data;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['sm'] = SuratMasuk::where('id', $id)->first();
        $data['ss'] = explode(",", $data['sm']->sifat_surat);
        $data['lj'] = explode(",", $data['sm']->lajur_disposisi);
        $data['ct'] = explode(",", $data['sm']->catatan);
        $data['tdl'] = explode(",", $data['sm']->tindak_lanjut);

        $data['berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_masuk')->get();

        return view('pages.editSM', $data);
        // return $data;

    }

    public function get_berkas($id)
    {
        $data['sm'] = SuratMasuk::where('id', $id)->first();

        $data['db_berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_masuk')->get();


        foreach ($data['db_berkas'] as $berkas) {
            // $tableImages[] = $berkas['lokasi'].'/'.$berkas['nama_berkas'];
            $namaBerkas[] = $berkas['nama_berkas'];
            $lokasi[] = $berkas['lokasi'];
        }

        $f = 'berkas/surat_masuk/' . $lokasi[0] . '/';
        $storeFolder = public_path('berkas/surat_masuk/' . $lokasi[0]);
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

    public function del_berkas($id)
    {
        $data = Berkas::where('id', $id)->first();
        $path = public_path('berkas/surat_masuk/') . $data->lokasi . '/' . $data->nama_berkas;

        if (file_exists($path)) {
            $data->delete();
            unlink($path);
            return redirect()->back()->with([Toastr::warning('Berkas Berhasil Dihapus')]);
        } else {
            return redirect()->back()->with([Toastr::error('Berkas Santri Gagal Dihapus')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ss = ($request->sifat_surat == null) ? "" : implode(",", $request->sifat_surat);
        $lj = ($request->lajur_disposisi == null) ? "" : implode(",", $request->lajur_disposisi);
        $ct = ($request->catatan == null) ? "" : implode(",", $request->catatan);
        $tdl = ($request->tindak_lanjut == null) ? "" : implode(",", $request->tindak_lanjut);

        $data = [
            'tanggal_terima' => $request->tanggal_terima,
            'asal_surat' => $request->asal_surat,
            'nomor_surat' => $request->nomor_surat . '_tgl_' . $request->tanggal_surat,
            'nomor_agenda' => $request->nomor_agenda,
            'perihal' => $request->perihal,
            'lajur_disposisi' => $lj,
            'catatan' => $ct,
            'sifat_surat' => $ss,
            'tindak_lanjut' => $tdl,
            'keterangan1' => $request->keterangan1,
            'keterangan2' => $request->keterangan2,
            'tls' => $request->tls,
        ];

        $simpan = SuratMasuk::where('id', $id)->update($data);
        if ($simpan) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $data['sm'] = SuratMasuk::where('id', $id)->first();

            $data['db_berkas'] = Berkas::where('surat_id', $data['sm']->id)->where('surat_type', 'surat_masuk')->get();


            // $data = Produk::with('foto_produk')->find($id);
            foreach ($data['db_berkas'] as $f) {
                $path = public_path('berkas/surat_masuk/') . $f->lokasi . '/' . $f->nama_berkas;
                unlink($path);
                Berkas::where('surat_id', $f->surat_id)->delete();

                // File::delete('assets/foto_produk/' . $f->foto_produk);
            }
            $hapus = $data['sm']->delete();
            if ($hapus) {
                DB::commit();
                return redirect('suratmasuk')->with([Toastr::success('Data Surat Masuk Berhasil Dihapus')]);
            }
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
