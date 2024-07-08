<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarisK3;
use App\Models\InventarisK3Detail;
use App\Models\FormApart;
use App\Models\FormApartDetail;
use App\Models\FormHydrant;
use App\Models\FormHydrantDetail;

use App\Models\InventarisITAssetDetail;
use App\Models\InventarisITAssetForm;
use \Carbon\Carbon;
class ScanQRController extends Controller
{
    public function index()
    {
        return view('backend.portal.scanqr.index');
    }
    public function scanqr($qr)
    {
        $scanqr1 = InventarisK3::where('kode_barcode',$qr)->first();
        if(empty($scanqr1)){
            return response()->json([
                'success' => false,
                'message' => 'Kode QR tidak terdeteksi'
            ]);
        }
        $scanqr1_1 = InventarisK3Detail::where('inventaris_k3_id',$scanqr1->id)->get();
        if(empty($scanqr1_1)){
            return response()->json([
                'success' => false,
                'message' => 'Data APAR / HYDRANT tidak terdeteksi'
            ]);
        }
        foreach ($scanqr1_1 as $key => $inventarisK3Detail) {
            $formApart = FormApart::where('inventaris_k3_detail_id',$inventarisK3Detail->id)
                                    ->where('status','Y')
                                    ->first();
            $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisK3Detail->id)
                                        ->where('status','Y')
                                        ->first();
            if($inventarisK3Detail->jenis_barang == "APAR"){
                // $scanqr1_1_detail[] = $formApart;
                $explode_apar = explode("-",Carbon::now()->isoFormat('d-MMMM-Y'));
                // dd($explode_apar);
                $searchBulanApar = sprintf("%'.02d",$explode_apar[0]).'|'.$explode_apar[1].'|'.$explode_apar[2];
                // dd($searchBulanApar);
                $formAparDetails = FormApartDetail::where('form_apart_id',$formApart->id)
                                                    // ->where('bulan','<=','LIKE','%'.$searchApar.'%')
                                                    // ->where('bulan','<=',$searchBulanApar)
                                                    // ->where('bulan','LIKE','%'.Carbon::now()->format('Y').'%')
                                                    ->orderBy('bulan','asc')
                                                    ->get();
                foreach ($formAparDetails as $key => $formAparDetail) {
                    $explode_bulan = explode("|",$formAparDetail->bulan);
                    $scanqr1_1_detail_pengecekan_apar[] = [
                        'no' => $key+1,
                        'bulan' => $explode_bulan[1].' '.Carbon::parse($formAparDetail->created_at)->format('Y'),
                        'tanggal' => $formAparDetail->tanggal == null ? '-' : Carbon::parse($formAparDetail->tanggal)->format('d-m-Y'),
                        'pressure' => $formAparDetail->pressure == null ? '-' : $formAparDetail->pressure,
                        'nozzel' => $formAparDetail->nozzel == null ? '-' : $formAparDetail->nozzel,
                        'segel' => $formAparDetail->segel == null ? '-' : $formAparDetail->segel,
                        'tuas' => $formAparDetail->tuas == null ? '-' : $formAparDetail->tuas,
                        'keterangan' => $formAparDetail->keterangan == null ? '-' : $formAparDetail->keterangan,
                        'petugas' => $formAparDetail->ttd == null ? '-' : $formAparDetail->ttd,
                        'status' => $formAparDetail->status == null ? '-' : $formAparDetail->status,
                        'image_apar' => asset('public/berkas_k3/'.$formAparDetail->images)
                    ];
                }
                $scanqr1_1_detail[] = [
                    'jenis_barang' => $inventarisK3Detail->jenis_barang,
                    'kode_tabung' => $formApart->kode_tabung,
                    'lokasi' => $formApart->tempat,
                    'jenis' => $formApart->jenis,
                    'warna' => $formApart->warna,
                    'berat' => $formApart->berat,
                    'detail_pengecekan' => $scanqr1_1_detail_pengecekan_apar
                ];
            }elseif($inventarisK3Detail->jenis_barang == "HYDRANT"){
                // $scanqr1_1_detail[] = $formHydrant;
                $formHydrantDetails = FormHydrantDetail::where('form_hydrant_id',$formHydrant->id)
                                                        // ->where('bulan','LIKE','%'.Carbon::now()->format('Y').'%')
                                                        ->orderBy('bulan','asc')
                                                        ->get();
                foreach ($formHydrantDetails as $key => $formHydrantDetail) {
                    $explode_bulan_2 = explode("|",$formHydrantDetail->bulan);
                    $selang = json_decode($formHydrantDetail->selang);
                    $kran = json_decode($formHydrantDetail->kran);
                    $nozzel = json_decode($formHydrantDetail->nozzel);
                    $scanqr1_1_detail_pengecekan_hydrant[] = [
                        'no' => $key+1,
                        'bulan' => $explode_bulan_2[1],
                        'tanggal' => $formHydrantDetail->tanggal == null ? '-' : $formHydrantDetail->tanggal,
                        'selang' => [
                            $selang
                        ],
                        'kran' => [
                            $kran
                        ],
                        'nozzel' => [
                            $nozzel
                        ],
                        'keterangan' => $formHydrantDetail->keterangan == null ? '-' : $formHydrantDetail->keterangan,
                        'petugas' => $formHydrantDetail->checker == null ? '-' : $formHydrantDetail->checker,
                        'image_hydrant' => asset('public/berkas_k3/'.$formHydrantDetail->images),
                        'status' => $formHydrantDetail->status == null ? '-' : $formHydrantDetail->status,
                    ];
                }
                $scanqr1_1_detail[] = [
                    'jenis_barang' => $inventarisK3Detail->jenis_barang,
                    'kode_hydrant' => $formHydrant->kode_hydrant,
                    'lokasi' => $formHydrant->lokasi,
                    'periode' => $formHydrant->periode,
                    'detail_pengecekan' => $scanqr1_1_detail_pengecekan_hydrant,
                ];
            }
        }
        return response()->json([
            'success' => true,
            'data_1' => [
                'kode_barcode' => $scanqr1->kode_barcode,
                'lokasi' => $scanqr1->lokasi,
            ],
            'data_2' => [
                'jenis_barang' => $scanqr1_1,
                'detail' => $scanqr1_1_detail
            ]
        ],200);
    }

    public function scanQRAsset($qr)
    {
        $assetITDetail = InventarisITAssetDetail::where('nama_label',$qr)->first();
        if(empty($assetITDetail)){
            return response()->json([
                'success' => false,
                'message' => 'Kode QR tidak terdeteksi'
            ]);
        }
        $assetITAssetForm = InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$assetITDetail->id)->first();
        if(empty($assetITDetail)){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data_1' => $assetITDetail,
            'data_2' => $assetITAssetForm
        ]);
    }
}
