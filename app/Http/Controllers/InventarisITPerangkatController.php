<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\InventarisITPerangkat;
use App\Models\InventarisITPerangkatDetail;
use App\Models\InventarisITAsset;
use App\Models\InventarisITAssetDetail;
use App\Models\InventarisITAssetForm;
use App\Models\Departemen;
use App\Models\UserManagement;
use App\Models\Roles;
use \Carbon\Carbon;
use PDF;
use Validator;
use DataTables;
use DNS1D;
use DNS2D;
class InventarisITPerangkatController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = InventarisITPerangkat::all();
            return DataTables::of($data)
                                    ->addIndexColumn()
                                    ->addColumn('departemen_id', function($row){
                                        return $row->departemen->nama_departemen;
                                    })
                                    ->addColumn('action', function($row){
                                        $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                                        $btn = $btn.'<a href="'.route('inventaris.it.perangkat.detail',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                                        $btn = $btn.'<i class="fas fa-plus"></i> Tambah Data';
                                        $btn = $btn.'</a>';
                                        $btn = $btn.'</div>';
                                        return $btn;
                                    })
                                    ->rawColumns(['action'])
                                    ->make(true);
        }
        $data['departemens'] = Departemen::all();
        $data['UserManagement'] = UserManagement::where('user_id',auth()->user()->id)->first();
        $data['roles'] = Roles::find(auth()->user()->roles);
        return view('backend.inventaris.it_perangkat.index',$data);
    }

    public function simpan(Request $request)
    {
        $rules = [
            'kode_barcode' => 'required',
            'lokasi' => 'required',
            'departemen_id' => 'required',
        ];
        $messages = [
            'kode_barcode.required'  => 'Kode wajib diisi.',
            'lokasi.required'  => 'Lokasi wajib diisi.',
            'departemen_id.required'   => 'Departemen wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->passes()){
            $input['id'] = Str::uuid();
            $input['kode_barcode'] = $request->kode_barcode;
            $input['lokasi'] = $request->lokasi;
            $input['departemen_id'] = $request->departemen_id;

            $inventaris_it_perangkat = InventarisITPerangkat::create($input);

            if($inventaris_it_perangkat){
                $message_title="Berhasil !";
                $message_content="Kode Barcode ".$request->kode_barcode." Berhasil Dibuat";
                $message_type="success";
                $message_succes = true;
            }

            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
            );
            return response()->json($array_message);
        }

        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }

    public function detail(Request $request,$id)
    {
        $data['inventarisITPerangkat'] = InventarisITPerangkat::find($id);
        if(empty($data['inventarisITPerangkat'])){
            return redirect()->back()->with('error', 'Data Tidak Ditemukan');
        }
        // $data = InventarisITPerangkatDetail::where('inventaris_it_perangkat_id',$id)->get();
        // dd($data);
        if($request->ajax()){
            $data['InventarisITPerangkatDetail'] = InventarisITPerangkatDetail::where('inventaris_it_perangkat_id',$id)->get();
            return DataTables::of($data['InventarisITPerangkatDetail'])
                            ->addIndexColumn()
                            ->addColumn('status', function($row){
                                if($row->status == 1){
                                    return '<span class="badge badge-outline-success">Barang Ada</span>';
                                }else{
                                    return '<span class="badge badge-outline-danger">Barang Tidak Ada</span>';
                                }
                                // return $row->departemen->nama_departemen;
                            })
                            ->addColumn('action', function($row){
                                $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                                // $btn = $btn.'<a href="'.route('inventaris.it.perangkat.detail.edit',['id' => $row->id,'id_inventaris_p' => $row->inventaris_it_perangkat_id]).'" class="btn btn-warning btn-icon">';
                                // $btn = $btn.'<button onclick="checkData(`'.$row->id.'`,`'.$row->kode_asset.'`)" class="btn btn-primary btn-icon">';
                                $btn = $btn.'<button onclick="checkData(`'.$row->kode_asset.'`)" class="btn btn-primary btn-icon">';
                                $btn = $btn.'<i class="fas fa-check"></i> Check Data';
                                $btn = $btn.'</button>';
                                $btn = $btn.'<button onclick="edit(`'.$row->id.'`,`'.$row->inventaris_it_perangkat_id.'`)" class="btn btn-warning btn-icon">';
                                $btn = $btn.'<i class="fas fa-edit"></i> Edit';
                                $btn = $btn.'</button>';
                                $btn = $btn.'<a href="#" class="btn btn-danger btn-icon">';
                                $btn = $btn.'<i class="fas fa-trash"></i> Delete';
                                $btn = $btn.'</a>';
                                $btn = $btn.'</div>';
                                return $btn;
                            })
                            ->rawColumns(['action','status'])
                            ->make(true);
        }
        $data['inventarisITAssets'] = InventarisITAsset::all();
        return view('backend.inventaris.it_perangkat.detail',$data);
    }

    public function detail_simpan(Request $request, $id)
    {
        $rules = [
            'jenis_asset' => 'required',
            'kode_asset' => 'required',
        ];
        $messages = [
            'jenis_asset.required'  => 'Jenis Asset wajib diisi.',
            'kode_asset.required'  => 'Kode Asset wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->passes()){
            $input['id'] = Str::uuid();
            $input['inventaris_it_perangkat_id'] = $id;
            $input['jenis_asset'] = $request->jenis_asset;
            $input['kode_asset'] = $request->kode_asset;
            $input['status'] = $request->status;

            if($request->jenis_asset == "-" || $request->status == "-"){
                return redirect()->back()->with('error','Silahkan dipilih terlebih dahulu');
            }elseif($request->kode_asset == ''){
                $input['kode_asset'] = '-';
            }

            $inventaris_it_perangkat_detail = InventarisITPerangkatDetail::create($input);
            if($inventaris_it_perangkat_detail){
                $message_title="Berhasil !";
                $message_content="Jenis Asset ".$request->jenis_asset." Dan Kode Asset " .$request->kode_asset. " Berhasil Dibuat";
                $message_type="success";
                $message_succes = true;
            }

            // $array_message = array(
            //     'success' => $message_succes,
            //     'message_title' => $message_title,
            //     'message_content' => $message_content,
            //     'message_type' => $message_type,
            // );
            return redirect()->back()->with('success',$message_content);
            // return response()->json($array_message);
        }
        return redirect()->back()->with('error',$validator->errors()->all());
        // return response()->json(
        //     [
        //         'success' => false,
        //         'error' => $validator->errors()->all()
        //     ]
        // );
    }

    public function detail_edit($id, $id_inventaris_p)
    {
        $inventaris_it_perangkat_detail = InventarisITPerangkatDetail::where('id',$id)->where('inventaris_it_perangkat_id',$id_inventaris_p)->first();
        if(empty($inventaris_it_perangkat_detail)){
            $message_title="Gagal !";
            $message_content="Data Tidak Ditemukan";
            $message_type="error";
            $message_succes = true;

            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
            );
            return response()->json($array_message);
        }
        $inventarisITAsset = InventarisITAsset::get();
        return response()->json([
            'success' => true,
            'data' => $inventaris_it_perangkat_detail,
            'asset' => $inventarisITAsset
        ]);
    }

    public function check_data($id,$detail_form)
    {
        // dd($detail_form);
        $InventarisITAssetDetail = InventarisITAssetDetail::where('nama_label',$detail_form)->first();
        if(empty($InventarisITAssetDetail)){
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        $InventarisITAssetForm = InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$InventarisITAssetDetail->id)->first();
        // if(empty($InventarisITAssetForm)){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Data Tidak Ditemukan'
        //     ]);
        // }
        return response()->json([
            'success' => true,
            'data' => $InventarisITAssetDetail,
            'detail' => $InventarisITAssetForm
        ]);
    }

    public function print_barcode_all()
    {
        $printInventarisPerangkat = InventarisITPerangkat::all();
        foreach ($printInventarisPerangkat as $key => $print) {
            $data['pdfs'][] = [
                'id' => $print->id,
                // 'barcode' => '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />',
                // 'barcode' => '<img src="data:image/png;base64,'. DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5,5,'black', true) .'" alt="barcode" />',
                // 'barcode' => 'data:image/png;base64,'. DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5,5,'black', true) .' ',
                'barcode' => DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5.5,5.5,'black', true),
                'kode_barcode' => $print->kode_barcode,
                'lokasi' => $print->lokasi,
                'departemen' => $print->departemen->nama_departemen,
            ];
        }
        return view('backend.inventaris.it_perangkat.print', $data);
        // $pdf = Pdf::loadView('backend.inventaris.k3.print', $data);
        // return $pdf->stream();
    }

    public function ajaxSelect($jenis_asset)
    {

        $inventaris_asset = InventarisITAsset::where('nama_perangkat',$jenis_asset)->first();
        if(empty($inventaris_asset)){
            return response()->json([
                'status' => false,
                'message' => 'Asset Tidak Ditemukan'
            ]);
        }
        $inventaris_asset_detail = InventarisITAssetDetail::where('inventaris_it_asset_id',$inventaris_asset->id)
                                                        ->orderBy('nama_label','asc')
                                                        ->get();
        if(empty($inventaris_asset_detail)){
            return response()->json([
                'status' => false,
                'message' => 'Asset Detail Tidak Ditemukan'
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $inventaris_asset_detail
        ]);
    }
}
