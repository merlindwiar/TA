<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Ph;
// use App\Models\Kekeruhan;
// use App\Models\RataDataKeruh;
use Data;

class SensorController extends Controller
{
    public function Masuk(Request $request)
    {

        $status = $request->input('kadar_ph');
        if ($status<7.00) {
            $hasil='Asam';
        }
        elseif ($status>7.00) {
            $hasil='Basa';
        }
        else {
            $hasil ='Netral';
        }
        //proses create data baru
        $ph = Data::create([

            'kadar_ph' => $request->input('kadar_ph'),
            'status_ph' => $hasil,
        ]);

        if ($ph) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
                'ph' => $ph,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Disimpan!',
            ], 401);
        }

        $statusNtU = $request->input('NTU');
        if ($statusNtU<25.00) {
            $hasilNTU='Jernih';
        }
        elseif ($statusNtU>400.00) {
            $hasil='Keruh';
        }
        else{
            $hasilNTU='Normal';
        }
        //proses create data baru
        $ntu = Data::create([

            'NTU' => $request->input('NTU'),
            'status_kekeruhan' => $hasilNTU,
        ]);

        if ($ntu) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
                'NTU' => $ntu,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Gagal Disimpan!',
            ], 401);
        }
    }

    // public function NTUMasuk(Request $request)
    // {
    //     // $kekeruhan= Kekeruhan::avg('NTU');
    //     // dd($kekeruhan);
    //     // $rata = new RataDataKeruh;
    //     // $rata->NTU= $kekeruhan;
    //     // $rata->save();

    //     $statusNtU = $request->input('NTU');
    //     if ($statusNtU<25.00) {
    //         $hasilNTU='Jernih';
    //     }
    //     elseif ($statusNtU>400.00) {
    //         $hasil='Keruh';
    //     }
    //     else{
    //         $hasilNTU='Normal';
    //     }
    //     //proses create data baru
    //     $ntu = Kekeruhan::create([

    //         'NTU' => $request->input('NTU'),
    //         'status_kekeruhan' => $hasilNTU,
    //     ]);

    //     if ($ntu) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Post Berhasil Disimpan!',
    //             'NTU' => $ntu,
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Post Gagal Disimpan!',
    //         ], 401);
    //     }


    // }
}
