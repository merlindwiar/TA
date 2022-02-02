<?php

namespace App\Http\Controllers;
use App\Models\Data;
use Illuminate\Http\Request;



class RekapKeruhController extends Controller
{
    public function cetakform(){
        return view('content.Cetak-data-form-kekeruhan');
    }

    public function cetakDataPertanggal(Request $request){
        // $cetakPertanggal=Data::orderBy('id', 'DESC')->whereBetween('created_at',[$tglawal,$tglakhir])->get();
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $cetakPertanggal=Data::
            where('NTU', '>=', 1750)
            ->whereDate('created_at','>=',$tglawal)
            ->whereDate('created_at','<=',$tglakhir)->get();
            // print_r($cetakPertanggal);
        return view('content.Cetak-data-pertanggal-kekeruhan',compact('cetakPertanggal'));
        // dd("Tanggal Awal : ".$tglawal,"Tanggal Akhir : ".$tglakhir);

        // dd("Tanggal Awal : ".$tglawal,"Tanggal Akhir : ".$tglakhir);
    }
    public function index()
    {
        $data=Data::orderBy('id', 'DESC')->get();
        return view('content.rekapkeruh_old', compact('data'));    }

    public function records(Request $request)
    {
        if ($request->ajax()) {

            if ($request->input('start_date') && $request->input('end_date')) {

                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));

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

    public function search(){
        // $formDate='2021-08-04';
        // $toDate='2021-08-09';
        $formDate = date('2018-01-01');
        $toDate = date('2018-05-02');

        $data=DB::table('kekeruhans')->select()
        ->where('created_at', '>=', $formDate)
        ->where('created_at', '<=', $toDate)
        ->get();
        dd($data);

        return view('content.rekapkeruh', compact('data'));
     }
}
