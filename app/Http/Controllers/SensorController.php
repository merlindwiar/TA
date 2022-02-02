<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Ph;
// use App\Models\Kekeruhan;
// use App\Models\RataDataKeruh;
use App\Models\Data;
use App\Models\Grafik;


class SensorController extends Controller
{
    public function Masuk(Request $request)
    {
        $statusNtU = $request->input('NTU');
        if ($statusNtU<25.00) {
            $hasilNTU='Jernih';
        }
        elseif ($statusNtU>400.00) {
            $hasilNTU='Keruh';
        }
        else{
            $hasilNTU='Normal';
        }

        $status = $request->input('kadar_ph');
        if ($status<7.00) {
            $hasilPH='Asam';
        }
        elseif ($status>7.00) {
            $hasilPH='Basa';
        }
        else {
            $hasilPH ='Netral';
        }


        //proses create data baru
        $data = Data::create([

            'NTU' => $request->input('NTU'),
            'kadar_ph' => $request->input('kadar_ph'),
            'status_kekeruhan' => $hasilNTU,
            'status_ph' => $hasilPH,
        ]);
        $grafik = Grafik::create([

            'NTU' => $request->input('NTU'),
            'kadar_ph' => $request->input('kadar_ph'),
            'status_kekeruhan' => $hasilNTU,
            'status_ph' => $hasilPH,
        ]);
        notify()->success('Berhasil kirim data');

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan!',
                'data' => $data,
            ], 200);
            redirect()->route('keasaman-air');
            redirect()->route('kekeruhan-air');
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
