<?php

namespace App\Http\Controllers;

use App\Berkas;
use Illuminate\Http\Request;
use App\User;
use App\SuratMasuk;
use App\SuratKeluar;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['sm'] = SuratMasuk::count();
        $data['sk'] = SuratKeluar::count();
        $data['ts'] = $data['sm'] + $data['sk'];
        $data['bk'] = Berkas::count();

        $data['lb'] = ['Surat Masuk', 'Surat Keluar'];
        $data['dt'] = [$data['sm'], $data['sk']];

        $year = [1,2,3,4,5,6,7,8,9,10,11,12];


        $data['dtm'] = [];
        $data['dtk'] = [];
        foreach ($year as $key => $value) {
            $data['dtm'][] = SuratMasuk::where(SuratMasuk::raw("DATE_FORMAT(tanggal_terima, '%m')"),$value)->count();
            $data['dtk'][] = SuratKeluar::where(SuratKeluar::raw("DATE_FORMAT(tanggal_keluar, '%m')"),$value)->count();
        }

        $data['ssm'] = SuratMasuk::with(['berkas' => function ($q) {
            $q->where('surat_type', 'surat_masuk');
        }])->orderBy('id', 'DESC')->take(3)->get();

        $data['ssk'] = SuratKeluar::with(['berkas2' => function ($q) {
            $q->where('surat_type', 'surat_keluar');
        }])->orderBy('id', 'DESC')->take(3)->get();

        // $data['dtsa'] = Arr::collapse([$ssm,$ssk]);
        // $o = collect($data['dtsa'])->sortBy('id')->take(5);

        // $data['aa'] = collect();

        // foreach ($data['dtsa'] as $o){
        //     $data['aa']->push([
        //         'id' => $o->id,
        //     ]);

        // }

        return view('home', $data);
        // return $data['aa'];
    }

    public function api()
    {
        $data['sm'] = SuratMasuk::count();
        $data['sk'] = SuratKeluar::count();
        $data['ts'] = $data['sm'] + $data['sk'];
        $data['bk'] = Berkas::count();

        $data['lb'] = ['Surat Masuk', 'Surat Keluar'];
        $data['dt'] = [$data['sm'], $data['sk']];

        $year = [1,2,3,4,5,6,7,8,9,10,11,12];


        $data['dtm'] = [];
        $data['dtk'] = [];
        foreach ($year as $key => $value) {
            $data['dtm'][] = SuratMasuk::where(SuratMasuk::raw("DATE_FORMAT(tanggal_terima, '%m')"),$value)->count();
            $data['dtk'][] = SuratKeluar::where(SuratKeluar::raw("DATE_FORMAT(tanggal_keluar, '%m')"),$value)->count();
        }

        $data['ssm'] = SuratMasuk::with(['berkas' => function ($q) {
            $q->where('surat_type', 'surat_masuk');
        }])->orderBy('id', 'DESC')->take(3)->get();

        $data['ssk'] = SuratKeluar::with(['berkas2' => function ($q) {
            $q->where('surat_type', 'surat_keluar');
        }])->orderBy('id', 'DESC')->take(3)->get();

        return $data;
    }
}
