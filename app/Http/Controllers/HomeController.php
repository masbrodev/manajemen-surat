<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SuratMasuk;
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

        $year = ['2015','2016','2017','2018','2019','2020','2021'];

        $user = [];
        foreach ($year as $key => $value) {
            $user[] = User::where(SuratMasuk::raw("DATE_FORMAT(tanggal_terima, '%YYYY')"),$value)->count();
        }

    	// return view('home')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));
        // return view('home');
        return $year;
    }
}
