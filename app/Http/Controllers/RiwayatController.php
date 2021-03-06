<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\RiwayatPekerjaan;
use App\RiwayatPendidikan;

class RiwayatController extends APIBaseController
{
    public function update(Request $request, $id){

        $input = $request->all();

        $listPendidikan = array();

        for ($i = 0; $i < count($input['pendidikan']); $i++) {

            $pendidikan = RiwayatPendidikan::find($input['pendidikan'][$i]['id_riwayat_pendidikan']);

            if(is_null($pendidikan)){
                $postPendidikan = RiwayatPendidikan::create([
                    'id_pegawai' => $id,
                    'nama_institusi' => $input['pendidikan'][$i]['nama_institusi'],
                    'strata' => $input['pendidikan'][$i]['strata'],
                    'jurusan' => $input['pendidikan'][$i]['jurusan'],
                    'tahun_masuk' => $input['pendidikan'][$i]['tahun_masuk'],
                    'tahun_keluar' => $input['pendidikan'][$i]['tahun_keluar'],
                ]);
                array_push($listPendidikan, $postPendidikan->id_riwayat_pendidikan);
            }else{
                $pendidikan->id_pegawai = $input['pendidikan'][$i]['id_pegawai'];
                $pendidikan->nama_institusi = $input['pendidikan'][$i]['nama_institusi'];
                $pendidikan->strata = $input['pendidikan'][$i]['strata'];
                $pendidikan->jurusan = $input['pendidikan'][$i]['jurusan'];
                $pendidikan->tahun_masuk = $input['pendidikan'][$i]['tahun_masuk'];
                $pendidikan->tahun_keluar = $input['pendidikan'][$i]['tahun_keluar'];

                $pendidikan->save();
                array_push($listPendidikan, $input['pendidikan'][$i]['id_riwayat_pendidikan']);
            }

        }

        $data = RiwayatPendidikan::where('id_pegawai',$id)->whereNotIn('id_riwayat_pendidikan', $listPendidikan);
        $data->delete();

        $listPekerjaan = array();

        for ($i = 0; $i < count($input['pekerjaan']); $i++) {

            $pekerjaan = RiwayatPekerjaan::find($input['pekerjaan'][$i]['id_riwayat_pekerjaan']);

            if(is_null($pekerjaan)){
                $postPekerjaan = RiwayatPekerjaan::create([
                    'id_pegawai' => $id,
                    'nama_institusi' => $input['pekerjaan'][$i]['nama_institusi'],
                    'posisi' => $input['pekerjaan'][$i]['posisi'],
                    'tahun_masuk' => $input['pekerjaan'][$i]['tahun_masuk'],
                    'tahun_keluar' => $input['pekerjaan'][$i]['tahun_keluar'],
                ]);
                array_push($listPekerjaan, $postPekerjaan->id_riwayat_pekerjaan);
            }else{   
                $pekerjaan->id_pegawai = $input['pekerjaan'][$i]['id_pegawai'];
                $pekerjaan->nama_institusi = $input['pekerjaan'][$i]['nama_institusi'];
                $pekerjaan->posisi = $input['pekerjaan'][$i]['posisi'];
                $pekerjaan->tahun_masuk = $input['pekerjaan'][$i]['tahun_masuk'];
                $pekerjaan->tahun_keluar = $input['pekerjaan'][$i]['tahun_keluar'];

                $pekerjaan->save();
                array_push($listPekerjaan, $input['pekerjaan'][$i]['id_riwayat_pekerjaan']);
            }
            
        }

        $data = RiwayatPekerjaan::where('id_pegawai',$id)->whereNotIn('id_riwayat_pekerjaan', $listPekerjaan);
        $data->delete();

        return $this->sendResponse($input, 'Riwayat Pendidikan & Pekerjaan updated successfully.');
    }
}
