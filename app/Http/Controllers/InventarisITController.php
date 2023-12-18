<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\InventarisITAsset;
use App\Models\InventarisITAssetDetail;
use App\Models\InventarisITAssetForm;
use PDF;
use Validator;
use DNS2D;
use DB;
use DataTables;
class InventarisITController extends Controller
{
    protected $inventaris_it_asset;
    protected $inventaris_it_asset_detail;

    function __construct(
        InventarisITAsset $inventaris_it_asset,
        InventarisITAssetDetail $inventaris_it_asset_detail
    )
    {
        $this->inventaris_it_asset = $inventaris_it_asset;
        $this->inventaris_it_asset_detail = $inventaris_it_asset_detail;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $data = InventarisITAsset::all();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                                $btn = $btn.'<a href="'.route('inventaris.it.detail',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                                $btn = $btn.'<i class="fas fa-plus"></i> Tambah / Edit Data';
                                $btn = $btn.'</a>';
                                $btn = $btn.'<button onclick="hapus(`'.$row->id.'`)" class="btn btn-danger btn-icon">';
                                $btn = $btn.'<i class="fas fa-trash"></i> Delete';
                                $btn = $btn.'</button>';
                                // if($UserManagement->r == "Y"){
                                // }
                                // if(auth()->user()->roles == 1){
                                //     $btn = $btn.'<a href="#" class="btn btn-danger btn-icon">';
                                //     $btn = $btn.'<i class="fas fa-trash"></i> Delete';
                                //     $btn = $btn.'</a>';
                                // }
                                $btn = $btn.'</div>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('backend.inventaris.it.index');
    }

    public function simpan(Request $request)
    {
        $rules = [
            'nama_perangkat' => 'required',
        ];
        $messages = [
            'nama_perangkat.required'  => 'Perangkat wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->passes()){
            $input['id'] = Str::uuid();
            $input['nama_perangkat'] = $request->nama_perangkat;
            $inventaris_it = InventarisITAsset::create($input);
            if($inventaris_it){
                $message_title="Berhasil !";
                $message_content="Perangkat ".$request->nama_perangkat." Berhasil Dibuat";
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

    public function delete($id)
    {
        $inventarisITAsset = InventarisITAsset::find($id);
        if(empty($inventarisITAsset)){
            return response()->json([
                'success' => false,
                'message' => 'Data Asset tidak ditemukan'
            ]);
        }

        $inventarisITAssetDetail = InventarisITAssetDetail::where('inventaris_it_asset_id',$inventarisITAsset->id)->get();
        if(empty($inventarisITAssetDetail)){
            return response()->json([
                'success' => false,
                'message' => 'Data Asset Detail tidak ditemukan'
            ]);
        }

        foreach ($inventarisITAssetDetail as $key => $iiad) {
            $inventarisITAssetDetailForm = InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$iiad->id)->get();
            // if(empty($$inventarisITAssetDetailForm)){
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Data Asset Form tidak ditemukan'
            //     ]);
            // }
            foreach ($inventarisITAssetDetailForm as $key => $iiadf) {
                $iiadf->delete();
            }
            $iiad->delete();
        }
        $inventarisITAsset->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data '.$inventarisITAsset->nama_perangkat.' Berhasil Dihapus'
        ]);
    }

    public function detail(Request $request,$id)
    {
        $data['inventaris_asset'] = InventarisITAsset::find($id);
        if(empty($data['inventaris_asset'])){
            return redirect()->back()->with('error','Data Tidak Ditemukan');
        }
        if($request->ajax()){
            $data = InventarisITAssetDetail::where('inventaris_it_asset_id',$data['inventaris_asset']['id'])->get();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('status', function($row){
                                if($row->status == 0){
                                    return '<span class="badge badge-outline-primary">Available</span>';
                                }elseif($row->status == 1){
                                    return '<span class="badge badge-outline-success">Used</span>';
                                }elseif($row->status == 2){
                                    return '<span class="badge badge-outline-danger">Any</span>';
                                }
                            })
                            ->addColumn('merek', function($row){
                                $asset_form = InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$row->id)->first();
                                if(empty($asset_form)){
                                    return '-';
                                }
                                return $asset_form->jenis_merk;
                            })
                            ->addColumn('type', function($row){
                                $asset_form = InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$row->id)->first();
                                if(empty($asset_form)){
                                    return '-';
                                }
                                return $asset_form->jenis_type;
                            })
                            ->addColumn('action', function($row){
                                $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                                $btn = $btn.'<button onclick="checkForm(`'.$row->id.'`,`'.$row->inventaris_it_asset_id.'`)" class="btn btn-primary btn-icon">';
                                $btn = $btn.'<i class="fas fa-eye"></i> Cek Data';
                                $btn = $btn.'</button>';
                                $btn = $btn.'<button onclick="detailForm(`'.$row->id.'`,`'.$row->inventaris_it_asset_id.'`)" class="btn btn-success btn-icon">';
                                $btn = $btn.'<i class="fas fa-plus"></i> Input Data';
                                $btn = $btn.'</button>';
                                $btn = $btn.'<button onclick="edit(`'.$row->id.'`)" class="btn btn-warning btn-icon">';
                                $btn = $btn.'<i class="fas fa-edit"></i> Edit';
                                $btn = $btn.'</button>';
                                // if($UserManagement->r == "Y"){
                                // }
                                // if(auth()->user()->roles == 1){
                                //     $btn = $btn.'<a href="#" class="btn btn-danger btn-icon">';
                                //     $btn = $btn.'<i class="fas fa-trash"></i> Delete';
                                //     $btn = $btn.'</a>';
                                // }
                                $btn = $btn.'</div>';
                                return $btn;
                            })
                            ->rawColumns(['action','status'])
                            ->make(true);
        }
        return view('backend.inventaris.it.detail',$data);
    }

    public function detail_simpan(Request $request, $id)
    {
        $rules = [
            'label' => 'required',
        ];
        $messages = [
            'label.required'  => 'Label wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->passes()){
            $nomor_inventaris_asset = InventarisITAssetDetail::where('inventaris_it_asset_id',$id)->orderBy('nama_label','desc')->count();
            if($nomor_inventaris_asset == null){
                $norut = 1;
                $label = $request->label.'-'.sprintf("%03s",$norut);
            }else{
                $norut = $nomor_inventaris_asset+1;
                $label = $request->label.'-'.sprintf("%03s",$norut);
            }
            $input['id'] = Str::uuid();
            $input['inventaris_it_asset_id'] = $id;
            $input['nama_label'] = $label;
            $input['keterangan'] = $request->keterangan;
            $input['status'] = 1;
            $InventarisITAssetDetail = InventarisITAssetDetail::create($input);
            // for ($i=1; $i <= $request->jumlah; $i++) { 
            //     $input['id'] = Str::uuid();
            //     $input['inventaris_it_asset_id'] = $id;
            //     $input['nama_label'] = $request->label.'-'.sprintf("%03s",$i);
            //     $input['status'] = 0;
            //     $InventarisITAssetDetail = InventarisITAssetDetail::create($input);
            // }
            if($InventarisITAssetDetail){
                $message_title="Berhasil !";
                $message_content="Label Perangkat ".$request->label." Berhasil Dibuat";
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

    public function detail_edit($id_ipld,$id)
    {
        $data['inventaris_asset_detail'] = InventarisITAssetDetail::where('id',$id)
                                                    ->where('inventaris_it_asset_id',$id_ipld)->first();
        // dd($data);
        if(empty($data['inventaris_asset_detail'])){
            return redirect()->back()->with('error','Data Tidak Ditemukan');
        }
        $data['inventaris_asset_detail_form'] = InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$data['inventaris_asset_detail']['id'])
                                                        ->first();
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function detail_edit_update(Request $request, $id_ipld, $id)
    {
        // dd($data['detail'] = [
        //     'data1' => $request->all(),
        //     'id1' => $id_ipld,
        //     'id2' => $id
        // ]);
        $rules = [
            'edit_kode_label' => 'required',
            'edit_keterangan' => 'required',
        ];
        $messages = [
            'edit_kode_label.required'  => 'Kode Label wajib diisi.',
            'edit_keterangan.required'  => 'Keterangan wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        // dd($request->all());
        if($validator->passes()){
            $inventaris_asset_detail = InventarisITAssetDetail::where('id',$id)
                                                    ->where('inventaris_it_asset_id',$id_ipld)
                                                    ->first();
            // dd($inventaris_asset_detail);
            $inventaris_asset_detail_form = InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$inventaris_asset_detail->id)
                                                                    ->first();

            if($request->edit_perubahan_data == 'true'){
                $inventaris_asset_detail_form->jenis_merk = $request->edit_jenis_merk;
                $inventaris_asset_detail_form->jenis_type = $request->edit_jenis_type;
                $inventaris_asset_detail_form->update();
            }elseif($request->edit_perubahan_data == 'false'){
                if($request->edit_status == 3){
                    $inventaris_asset_detail_form->keterangan = $request->view_keterangan;
                    $inventaris_asset_detail_form->update();
                    $inventaris_asset_detail_form->delete();
    
                    $inventaris_asset_detail->keterangan = '-';
                    $inventaris_asset_detail->status = 0;
                }elseif($request->edit_status == 1){
                    $inventaris_asset_detail->nama_label = $request->edit_kode_label;
                    $inventaris_asset_detail->keterangan = $request->edit_keterangan;
            
                    // $inventaris_asset_detail_form->keterangan = $request->view_keterangan;
                    $inventaris_asset_detail_form->update();
                    $inventaris_asset_detail_form->delete();
    
                    $inventaris_asset_detail_form_descending = DB::table('inventaris_it_asset_detail_form')
                                                                ->where('inventaris_it_perangkat_detail_id',$inventaris_asset_detail->id)
                                                                ->where('deleted_at','!=',null)
                                                                ->orderBy('created_at','desc')
                                                                ->take(1)
                                                                ->first();
                                                                
                    // dd($inventaris_asset_detail_form_descending);
                    //Terakhir koding
                    $inventaris_asset_detail_form_new = new InventarisITAssetForm();
                    $inventaris_asset_detail_form_new->id = Str::uuid();
                    $inventaris_asset_detail_form_new->inventaris_it_perangkat_detail_id = $inventaris_asset_detail->id;
                    $inventaris_asset_detail_form_new->lokasi = $request->edit_keterangan;
                    $inventaris_asset_detail_form_new->jenis_merk = $inventaris_asset_detail_form_descending->jenis_merk;
                    $inventaris_asset_detail_form_new->jenis_type = $inventaris_asset_detail_form_descending->jenis_type;
                    $inventaris_asset_detail_form_new->spesifikasi = $inventaris_asset_detail_form_descending->spesifikasi;
                    $inventaris_asset_detail_form_new->save();
    
                    // dd($inventaris_asset_detail_form_descending);
                    // dd($inventaris_asset_detail_form_descending);
                }
                else{
                    $inventaris_asset_detail->nama_label = $request->edit_kode_label;
                    $inventaris_asset_detail->keterangan = $request->edit_keterangan;
                    $inventaris_asset_detail->status = $request->edit_status;
                }
                $inventaris_asset_detail->update();
            }

            // dd($request->all());

            // dd($inventaris_asset_detail);
            if($inventaris_asset_detail){
                $message_title="Berhasil !";
                $message_content="Label Perangkat ".$request->edit_kode_label." Berhasil Diubah";
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

    public function detail_form($id,$detail_form)
    {
        $inventaris_asset_detail = InventarisITAssetDetail::where('id',$id)->where('inventaris_it_asset_id',$detail_form)->first();
        // dd($inventaris_asset_detail);
        if(empty($inventaris_asset_detail)){
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $inventaris_asset_detail
        ]);
    }

    public function detail_form_simpan(Request $request,$id,$detail_form)
    {
        // dd($request->all());
        // return $request->all();
        $rules = [
            'edit_form_lokasi' => 'required',
            'edit_form_jenis_merek' => 'required',
            'edit_form_jenis_type' => 'required',
            'edit_form_spesifikasi' => 'required',
        ];
        $messages = [
            'edit_form_lokasi.required'  => 'Lokasi Label wajib diisi.',
            'edit_form_jenis_merek.required'  => 'Jenis Merek wajib diisi.',
            'edit_form_jenis_type.required'  => 'Jenis Type wajib diisi.',
            'edit_form_spesifikasi.required'  => 'Spesifikasi wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->passes()){
            $input['id'] = Str::uuid();
            $input['inventaris_it_perangkat_detail_id'] = $detail_form;
            $input['lokasi'] = $request->edit_form_lokasi;
            $input['jenis_merk'] = $request->edit_form_jenis_merek;
            $input['jenis_type'] = $request->edit_form_jenis_type;
            $input['spesifikasi'] = $request->edit_form_spesifikasi;

            // dd($inventaris_asset_detail);

            $inventaris_asset_form = InventarisITAssetForm::create($input);
            // dd($inventaris_asset_detail);
            // $inventaris_asset_detail->nama_label = $request->edit_kode_label;
            // $inventaris_asset_detail->keterangan = $request->edit_keterangan;
            // $inventaris_asset_detail->status = $request->edit_status;
            // $inventaris_asset_detail->update();
            // dd($inventaris_asset_detail);

            if($inventaris_asset_form){
                $inventaris_asset_detail = InventarisITAssetDetail::where('id',$detail_form)->first();
                $inventaris_asset_detail->keterangan = $request->edit_form_lokasi;
                $inventaris_asset_detail->status = 1;
                $inventaris_asset_detail->update();

                $message_title="Berhasil !";
                $message_content="Label Perangkat Berhasil Disimpan";
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

    public function detail_from_check($id,$detail_form)
    {
        $InventarisITAssetDetailForm = InventarisITAssetForm::where('inventaris_it_perangkat_detail_id',$detail_form)
                                        ->first();
        if(empty($InventarisITAssetDetailForm)){
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $InventarisITAssetDetailForm->id,
                'title' => $InventarisITAssetDetailForm->it_asset_detail->nama_label,
                'lokasi' => $InventarisITAssetDetailForm->lokasi,
                'jenis_merk' => $InventarisITAssetDetailForm->jenis_merk,
                'jenis_type' => $InventarisITAssetDetailForm->jenis_type,
                'spesifikasi' => $InventarisITAssetDetailForm->spesifikasi,
            ]
        ]);
    }

    public function print_barcode_all($id)
    {
        $printInventarisPerangkat = InventarisITAssetDetail::where('inventaris_it_asset_id',$id)->orderBy('nama_label','asc')->get();
        foreach ($printInventarisPerangkat as $key => $print) {
            $data['pdfs'][] = [
                'id' => $print->id,
                // 'barcode' => '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />',
                // 'barcode' => '<img src="data:image/png;base64,'. DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5,5,'black', true) .'" alt="barcode" />',
                // 'barcode' => 'data:image/png;base64,'. DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5,5,'black', true) .' ',
                'barcode' => DNS2D::getBarcodeHTML($print->nama_label, 'QRCODE',5.5,5.5,'black', true),
                'kode_barcode' => $print->nama_label,
                // 'lokasi' => $print->lokasi,
                // 'departemen' => $print->departemen->nama_departemen,
            ];
        }
        return view('backend.inventaris.it.print', $data);
        // $pdf = Pdf::loadView('backend.inventaris.k3.print', $data);
        // return $pdf->stream();
    }

    public function download_report()
    {
        // return 'Test';
        // return view('backend.inventaris.it.report_inventaris');
        $asset = array(
            '32603eed-17e3-47bb-bee3-c66564d1eeb1',
	    '49622916-b214-4333-9486-3ac357af4e53',
	    '59ab073d-f952-49e8-8bea-5787cf45c9d1',
	    '7f126d0c-d49f-4d8e-a9c7-3ebd0fd5dc30',
	    '83a6d22a-f48c-42a9-a30e-24d51f7fcc24',
	    '9e130376-5b48-4336-b2ef-786afe940b9b',
	    '9ec3fffc-5675-4e6b-be87-61c9739fba77',
	    'a84a4a09-08f7-426e-9d00-0c6377aaff94'
        );
        // $asset = array('Monitor','UPS','Printer','PC','Access Point','Switch');
        // $data['inventaris_it_assets'] = $this->inventaris_it_asset->all();
        $data['inventaris_it_asset_details'] = $this->inventaris_it_asset_detail
                                                ->whereIn('inventaris_it_asset_id',$asset)
                                                ->orderBy('nama_label','asc')
                                                ->get();
        $pdf = new PDF();
        $pdf = PDF::loadView('backend.inventaris.it.report_inventaris',$data);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    
}
