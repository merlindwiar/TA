<?php

namespace App\Http\Controllers;
use App\Models\Alat;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapAsamController extends Controller
{
    public function cetakform(){
        return view('content.Cetak-data-form');
    }
    public function cetakDataPertanggal(Request $request){
        // $cetakPertanggal=Data::orderBy('id', 'DESC')->whereBetween('created_at',[$tglawal,$tglakhir])->get();

        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $cetakPertanggal=Data::
            where('kadar_ph', '>', 9)
            ->orWhere('kadar_ph', '<', 6)
            ->whereDate('created_at','>=',$tglawal)
            ->whereDate('created_at','<=',$tglakhir)->get();
            // print_r($cetakPertanggal);
        return view('content.Cetak-data-pertanggal',compact('cetakPertanggal'));
        // dd("Tanggal Awal : ".$tglawal,"Tanggal Akhir : ".$tglakhir);

        // dd("Tanggal Awal : ".$tglawal,"Tanggal Akhir : ".$tglakhir);
    }
    // public function tampil(Request $request)
    // {
    //     // $pagename='Data Kuliah';
    //     $data=Data::orderBy('id', 'DESC')->get();
    //     // dd($request->all());

    //     // dd($data);
    //     return view('content.rekapasam_old', compact('data'));

    //     // return view('content.rekapasam', ['data' => Ph::all()]);
    // }
    public function index()
    {
        // $data = Data::all();
        $data=Data::orderBy('id', 'DESC')->get();
        return view('content.rekapasam_old', compact('data'));
    }
    // public function searcKeruh(){
        // $data=Ph::all();
        // $query=Ph::all()->select()->get();
        // dd($data);
        // return view('content.rekapasam',compact('data','query'));
    // }
    public function records(Request $request)
    {
        if ($request->ajax()) {

            if ($request->input('start_date') && $request->input('end_date')) {

                $start_date =($request->input('start_date'));
                $end_date = ($request->input('end_date'));

                if ($end_date->greaterThan($start_date)) {
                    $nilai = Data::whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $nilai = Data::latest()->get();
                }
            } else {
                $nilai = Data::latest()->get();
            }

            return response()->json([
                'nilai' => $nilai
            ]);
        } else {
            abort(403);
        }
    }


    public function cetakDataPertanggal2(Request $request){
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $cetakPertanggal=Data::
        whereDate('created_at','>=',$tglawal)
        ->whereDate('created_at','<=',$tglakhir)->get();
        // print_r($cetakPertanggal);
        return view('content.Cetak-data-pertanggal',compact('cetakPertanggal'));
        // print_r($tglawal);
        // print_r($tglakhir);
        // dd("Tanggal Awal : ".$tglawal,"Tanggal Akhir : ".$tglakhir);

    }
}
