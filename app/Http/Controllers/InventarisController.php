<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\InventarisK3;
use App\Models\InventarisK3Detail;
use App\Models\FormApart;
use App\Models\FormApartDetail;
use App\Models\FormHydrant;
use App\Models\FormHydrantDetail;
use App\Models\Departemen;
use App\Models\DepartemenDetail;
use App\Models\UserManagement;
use App\Notifications\InventarisK3Notification;
use App\Models\Roles;
use App\Models\User;
use \Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\File;
use Notification;
use Validator;
use DataTables;
use DNS1D;
use DNS2D;
use Intervention\Image\ImageManagerStatic as Image;

class InventarisController extends Controller
{
    public function index_k3(Request $request)
    {
        
        if($request->ajax()){
            $data = InventarisK3::all();
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('barcode', function($row){
                                    // return $row->kode_barcode;
                                    // return DNS1D::getBarcodeHTML($row->kode_barcode, 'C39');
                                    return DNS2D::getBarcodeHTML($row->kode_barcode, 'QRCODE',5,5,'black', true);
                                })
                                // ->addColumn('kode_barcode', function($row){
                                //     return '<a href="'.route('inventaris.k3.detail',['id' => $row->id]).'">'.$row->kode_barcode.'</a>';
                                //     // return $row->departemen->nama_departemen;
                                // })
                                ->addColumn('kode_barcode', function($row){
                                    $inventarisK3Details = InventarisK3Detail::where('inventaris_k3_id',$row->id)->get();
                                    foreach ($inventarisK3Details as $key => $inventarisK3Detail) {
                                        if($inventarisK3Detail->jenis_barang == 'APAR'){
                                            $formApart = FormApart::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
                                            if (env('OPEN_INVENTARIS_K3') == 'yes') {
                                                $tgl_sekarang = Carbon::now()->subMonth()->isoFormat('MM|MMMM|YYYY');
                                                $formApartDetail = FormApartDetail::where('form_apart_id',$formApart->id)
                                                                        ->where('bulan',$tgl_sekarang)
                                                                        // ->whereMonth('tanggal',Carbon::now()->subMonth()->format('m'))
                                                                        // ->whereYear('tanggal',Carbon::now()->subMonth()->format('Y'))
                                                                        // ->whereMonth('tanggal','<=',Carbon::now()->format('m'))
                                                                        // ->whereYear('tanggal',Carbon::now()->format('Y'))
                                                                        ->first();
                                            }else{
                                                $tgl_sekarang = Carbon::now()->isoFormat('MM|MMMM|YYYY');
                                                $formApartDetail = FormApartDetail::where('form_apart_id',$formApart->id)
                                                                        ->where('bulan',$tgl_sekarang)
                                                                        // ->whereMonth('tanggal',Carbon::now()->format('m'))
                                                                        // ->whereYear('tanggal',Carbon::now()->format('Y'))
                                                                        ->first();
                                            }

                                            // dd($formApartDetail->bulan);

                                            // if($formApartDetail->bulan <= Carbon::now()){
                                            //     $statusApart = $formApartDetail;
                                            // }
                                                                    // dd($formApartDetail);
                                            // if(empty($formApartDetail)){
                                            //     $statusApart = '-';
                                            // }else{
                                            //     $statusApart = $formApartDetail->status;
                                            // }

                                            $statusApart = $formApartDetail;

                                            // if($statusApart == '0'){
                                            //     $statusApartNotif = '<span class="badge badge-outline-warning">Menunggu Persetujuan</span>';
                                            // }
                                            // dd($formApartDetail);
                                        }elseif($inventarisK3Detail->jenis_barang == 'HYDRANT'){
                                            $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
                                            if (env('OPEN_INVENTARIS_K3') == 'yes') {
                                                $tgl_sekarang = Carbon::now()->subMonth()->isoFormat('MM|MMMM|YYYY');
                                                // dd($tgl_sekarang);
                                                $formHydrantDetail = FormHydrantDetail::where('form_hydrant_id',$formHydrant->id)
                                                                    ->where('bulan',$tgl_sekarang)
                                                                    // ->whereMonth('tanggal',Carbon::now()->subMonth()->format('m'))
                                                                    // ->whereYear('tanggal',Carbon::now()->subMonth()->format('Y'))
                                                                    // ->whereMonth('tanggal','<=',Carbon::now()->subMonth()->format('m'))
                                                                    // ->whereYear('tanggal',Carbon::now()->format('Y'))
                                                                    ->first();
                                                // dd($formHydrantDetail);
                                            }else{
                                                $tgl_sekarang = Carbon::now()->isoFormat('MM|MMMM|YYYY');
                                                $formHydrantDetail = FormHydrantDetail::where('form_hydrant_id',$formHydrant->id)
                                                                        ->where('bulan',$tgl_sekarang)
                                                                        // ->whereMonth('tanggal',Carbon::now()->format('m'))
                                                                        // ->whereYear('tanggal',Carbon::now()->format('Y'))
                                                                        ->first();
                                            }
                                                                    // dd('HYDRANT = '.$formHydrantDetail->status);
                                            // if(empty($formHydrantDetail)){
                                            //     $statusHydrant = '-';
                                            // }else{
                                            //     $statusHydrant = $formHydrantDetail->status;
                                            // }
                                            $statusHydrant = $formHydrantDetail;
                                                                    // dd($statusHydrant);
                                        }
                                    }
                                    
                                    if(empty($statusApart)){
                                        $statusApartNotif = null;
                                        // $statusApartNotif = ' - <span class="badge badge-outline-primary">Data APAR Belum Diinput</span>';
                                    }
                                    else{
                                        // $explode_bulan = explode('|', $statusApart->bulan);
                                        // $tgl_old = $explode_bulan[0] . '|' . $explode_bulan[1] . '|' .$explode_bulan[2];
                                        // $backDate = Carbon::now()->subMonth()->isoFormat('MM|MMMM|YYYY');
                                        // dd($backDate);
                                        // $bulan = $explode_bulan[1] . ' ' .$explode_bulan[2];

                                        // dd($statusApart->bulan.' '.$backDate);

                                        $explode_bulan = explode('|', $statusApart->bulan);
                                        $bulan = $explode_bulan[1] . ' ' .$explode_bulan[2];
                                        if($statusApart->status == '0'){
                                            $statusApartNotif = ' - <span class="badge badge-outline-warning">Waiting for approval APAR '.$bulan.'</span>';
                                        }
                                        elseif($statusApart->status == 'Y'){
                                            $statusApartNotif = ' - <span class="badge bg-success">Verified APAR '.$bulan.'</span>';
                                        }
                                        elseif($statusApart->status == 'T'){
                                            $statusApartNotif = ' - <span class="badge bg-danger">Verified APAR Denied '.$bulan.'</span>';
                                        }
                                        elseif($statusApart->status == null){
                                            $statusApartNotif = ' - <span class="badge badge-outline-primary">APAR Belum Diinput ' .$bulan.'</span>';
                                        }

                                        // if ($tgl_old == $backDate) {
                                        //     if($statusApart->status == '0'){
                                        //         $statusApartNotif = ' - <span class="badge bg-warning">Waiting for approval APAR '.$bulan.'</span>';
                                        //     }
                                        //     if($statusApart->status == 'Y'){
                                        //         $statusApartNotif = ' - <span class="badge bg-success">Verified APAR '.$bulan.'</span>';
                                        //     }
                                        //     if($statusApart->status == 'T'){
                                        //         $statusApartNotif = ' - <span class="badge bg-danger">Verified APAR Denied '.$bulan.'</span>';
                                        //     }
                                        //     if($statusApart->status == null){
                                        //         $statusApartNotif = ' - <span class="badge bg-primary">APAR Belum Diinput ' .$bulan.'</span>';
                                        //     }
                                        // }
                                        // if($statusApart->status == '0'){
                                        //     $statusApartNotif = ' - <span class="badge bg-warning">Waiting for approval APAR '.$bulan.'</span>';
                                        // }
                                        // if($statusApart->status == 'Y'){
                                        //     $statusApartNotif = ' - <span class="badge bg-success">Verified APAR '.$bulan.'</span>';
                                        // }
                                        // if($statusApart->status == 'T'){
                                        //     $statusApartNotif = ' - <span class="badge bg-danger">Verified APAR Denied '.$bulan.'</span>';
                                        // }
                                        // if($statusApart->status == null){
                                        //     $statusApartNotif = ' - <span class="badge bg-primary">APAR Belum Diinput ' .$bulan.'</span>';
                                        // }
                                        // else{
                                        //     $statusApartNotif = 'no';
                                        // }

                                        // if($statusApart->status == '0'){
                                        //     $statusApartNotif = ' - <span class="badge bg-warning">Waiting for approval APAR '.Carbon::parse($statusApart->tanggal)->isoFormat('MM MMMM YYYY').'</span>';
                                        // }
                                        // elseif($statusApart->status == 'Y'){
                                        //     $statusApartNotif = ' - <span class="badge bg-success">Verified APAR '.Carbon::parse($statusApart->updated_at)->isoFormat('MM MMMM YYYY').'</span>';
                                        // }
                                        // elseif($statusApart->status == 'T'){
                                        //     $statusApartNotif = ' - <span class="badge bg-danger">Verified APAR Denied '.Carbon::parse($statusApart->tanggal)->isoFormat('MM MMMM YYYY').'</span>';
                                        // }
                                        // else{
                                        //     $statusApartNotif = ' - <span class="badge bg-primary">APAR Belum Diinput ' .Carbon::parse($statusApart->tanggal)->isoFormat('MM MMMM YYYY').'</span>';
                                        // }
                                        
                                    }

                                    if(empty($statusHydrant)){
                                        $statusHydrantNotif = null;
                                        // $statusHydrantNotif = ' - <span class="badge badge-outline-primary">HYDRANT Belum Diinput</span>';
                                    }
                                    else{
                                        // $explode_bulan = explode('|',$statusHydrant->bulan);
                                        // $tgl_old = $explode_bulan[0] . '|' . $explode_bulan[1] . '|' .$explode_bulan[2];
                                        // $backDate = Carbon::now()->subMonth()->isoFormat('MM|MMMM|YYYY');

                                        // $bulan = $explode_bulan[1] . ' ' .$explode_bulan[2];

                                        $explode_bulan = explode('|', $statusHydrant->bulan);
                                        $bulan = $explode_bulan[1] . ' ' .$explode_bulan[2];

                                        if($statusHydrant->status == '0'){
                                            $statusHydrantNotif = ' - <span class="badge badge-outline-warning">Waiting for approval HYDRANT '.$bulan.'</span>';
                                        }
                                        elseif($statusHydrant->status == 'Y'){
                                            $statusHydrantNotif = ' - <span class="badge bg-success">Verified HYDRANT '.$bulan.'</span>';
                                        }
                                        elseif($statusHydrant->status == 'T'){
                                            $statusHydrantNotif = ' - <span class="badge bg-danger">Verified HYDRANT Denied '.$bulan.'</span>';
                                        }
                                        elseif($statusHydrant->status == null){
                                            $statusHydrantNotif = ' - <span class="badge badge-outline-primary">HYDRANT Belum Diinput '.$bulan.'</span>';
                                        }
                                        
                                        // if($tgl_old <= $backDate){
                                        //     if($statusHydrant->status == '0'){
                                        //         $statusHydrantNotif = ' - <span class="badge bg-warning">Waiting for approval HYDRANT '.$bulan.'</span>';
                                        //     }
                                        //     elseif($statusHydrant->status == 'Y'){
                                        //         $statusHydrantNotif = ' - <span class="badge bg-success">Verified HYDRANT '.$bulan.'</span>';
                                        //     }
                                        //     elseif($statusHydrant->status == 'T'){
                                        //         $statusHydrantNotif = ' - <span class="badge bg-danger">Verified HYDRANT Denied '.$bulan.'</span>';
                                        //     }
                                        //     else{
                                        //         $statusHydrantNotif = ' - <span class="badge badge-outline-primary">HYDRANT Belum Diinput '.$bulan.'</span>';
                                        //     }
                                        // }else{
                                        //     if($statusHydrant->status == '0'){
                                        //         $statusHydrantNotif = ' - <span class="badge bg-warning">Waiting for approval HYDRANT '.$bulan.'</span>';
                                        //     }
                                        //     elseif($statusHydrant->status == 'Y'){
                                        //         $statusHydrantNotif = ' - <span class="badge bg-success">Verified HYDRANT '.$bulan.'</span>';
                                        //     }
                                        //     elseif($statusHydrant->status == 'T'){
                                        //         $statusHydrantNotif = ' - <span class="badge bg-danger">Verified HYDRANT Denied '.$bulan.'</span>';
                                        //     }
                                        //     else{
                                        //         $statusHydrantNotif = ' - <span class="badge badge-outline-primary">HYDRANT Belum Diinput '.$bulan.'</span>';
                                        //     }
                                        // }
                                    }

                                    // if(empty($statusApart)){
                                    //     $statusApartNotif = null;
                                    //     // $statusApartNotif = ' - <span class="badge badge-outline-primary">Data APAR Belum Diinput</span>';
                                    // }
                                    // return $row->kode_barcode.' - '.$statusApart.' - '.$statusHydrant;
                                    // return $row->kode_barcode.$statusApartNotif;
                                    // return $row->kode_barcode.$statusApartNotif.$statusHydrantNotif;
                                    // return $row->kode_barcode;
                                    return $row->kode_barcode.$statusApartNotif.$statusHydrantNotif;
                                })
                                ->addColumn('departemen_id', function($row){
                                    return $row->departemen->nama_departemen;
                                })
                                ->addColumn('expired', function($row){
                                    $datas = $row->detail_inventaris_k3_detail->detail_form_apar;
                                    if(empty($datas->expired)){
                                        return '-';
                                    }
                                    return Carbon::parse($datas->expired)->format('d-m-Y');
                                    // return $row->detail_inventaris_k3_detail->detail_form_apar->expired;
                                    // dd($row->detail_inventaris_k3_detail->detail_form_apar);
                                })
                                ->addColumn('action', function($row){
                                    $inventarisK3Detail = InventarisK3Detail::where('inventaris_k3_id',$row->id)->first();
                                    $formApart = FormApart::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
                                    $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
                                    $UserManagement = UserManagement::where('user_id',auth()->user()->id)->first();
                                    
                                    $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                                    // dd($inventarisK3Detail);
                                    $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                                    if($inventarisK3Detail->jenis_barang == "APAR" || $inventarisK3Detail->jenis_barang == "HYDRANT"){
                                        if($UserManagement->c == "Y"){
                                            if($departemen->departemen->nama_departemen == "HRGA" || $departemen->departemen->nama_departemen == "IT"){
                                                if(empty($formApart) && empty($formHydrant)){
                                                    if(auth()->user()->roles != 3){
                                                    $btn = $btn.'<a href="'.route('inventaris.k3.detail',['id' => $row->id]).'" class="btn btn-success btn-icon">';
                                                    $btn = $btn.'<i class="fas fa-plus"></i> Input Data';
                                                    $btn = $btn.'</a>';
                                                    }
                                                }
                                                if(!empty($formApart) || !empty($formHydrant)){
                                                     if(auth()->user()->roles != 3){
                                                         $btn = $btn.'<a href="'.route('inventaris.k3.detail.form',['id' => $row->id]).'" class="btn btn-success btn-icon">';
                                                         $btn = $btn.'<i class="fas fa-plus"></i> Input Data';
                                                         $btn = $btn.'</a>';
                                                     }
                                                }   
                                            }else{
                                                if(!empty($formApart) || !empty($formHydrant)){
                                                    $btn = $btn.'<a href="'.route('inventaris.k3.detail.form',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                                                    $btn = $btn.'<i class="fas fa-clipboard"></i> Check Data';
                                                    $btn = $btn.'</a>';
                                                } 
                                            }
                                        }
                                    }
                                    // else{
                                    //     $btn = $btn.'<a href="'.route('inventaris.k3.detail.form',['id' => $row->id]).'" class="btn btn-success btn-icon">';
                                    //     $btn = $btn.'<i class="fas fa-plus"></i> Input Data';
                                    //     $btn = $btn.'</a>';
                                    // }
                                    if($UserManagement->u == "Y"){
                                        if($departemen->departemen->nama_departemen == "HRGA" || $departemen->departemen->nama_departemen == "IT"){
                                            $btn = $btn.'<a href="'.route('inventaris.k3.edit',['id' => $row->id]).'" class="btn btn-warning btn-icon">';
                                            $btn = $btn.'<i class="fas fa-edit"></i> Edit';
                                            $btn = $btn.'</a>';
                                        }
                                    }
                                    if($UserManagement->r == "Y"){
                                        if($departemen->departemen->nama_departemen == "HRGA" || $departemen->departemen->nama_departemen == "IT"){
                                            $btn = $btn.'<a href="'.route('inventaris.k3.printBarcode.detail',['id' => $row->id]).'" class="btn btn-primary btn-icon" target="_blank">';
                                            $btn = $btn.'<i class="fas fa-print"></i> Print Barcode';
                                            $btn = $btn.'</a>';
                                        }
                                        $btn = $btn.'<a href="'.route('inventaris.k3.detail.download',['id' => $row->id]).'" class="btn btn-primary btn-icon" target="_blank">';
                                        $btn = $btn.'<i class="fas fa-download"></i> Download Report';
                                        $btn = $btn.'</a>';
                                    }
                                    if($UserManagement->d == "Y"){
                                        $btn = $btn.'<button onclick="hapus(`'.$row->id.'`)" class="btn btn-danger btn-icon"><i class="fas fa-trash"></i> Delete</button>';
                                    }
                                    if(auth()->user()->roles == 3){
                                        $btn = $btn.'<a href="'.route('inventaris.k3.checkData',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                                        $btn = $btn.'<i class="fas fa-check"></i> Check Data';
                                        $btn = $btn.'</a>';
                                    }
                                    $btn = $btn.'</div>';
                                    return $btn;
                                })
                                ->rawColumns(['action','kode_barcode'])
                                ->make(true);
        }
        $data['departemens'] = Departemen::all();
        $data['departemen'] = DepartemenDetail::where('user_id',auth()->user()->id)->first();

        $data['UserManagement'] = UserManagement::where('user_id',auth()->user()->id)->first();
        $data['roles'] = Roles::find(auth()->user()->roles);
        return view('backend.inventaris.k3.index',$data);
    }
    
    public function simpan_k3(Request $request)
    {
        $rules = [
            'kode_barcode' => 'required',
            'kode_barcode' => 'required|unique:inventaris_k3',
            'lokasi' => 'required|unique:inventaris_k3',
            'departemen_id' => 'required',
            'jenis_barang' => 'required',
            'status' => 'required',
        ];
        $messages = [
            'kode_barcode.required'  => 'Kode wajib diisi.',
            'kode_barcode.unique'  => 'Kode Barcode '.$request->kode_barcode.' sudah ada.',
            'lokasi.required'  => 'Lokasi wajib diisi.',
            'lokasi.unique'  => 'Lokasi '.$request->lokasi.' sudah ada.',
            'departemen_id.required'   => 'Departemen wajib diisi.',
            'jenis_barang.required'   => 'Jenis Barang wajib diisi.',
            'status.required'   => 'Status Barang wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->passes()){

            // if($request->departemen_id == 0 || $request->status == 0){
            //     $message_title="Gagal !";
            //     $message_content="Inputan Departemen / Status wajib diisi";
            //     $message_type="danger";
            //     $message_succes = true;
            // }
            $input1['id'] = Str::uuid();
            $input1['kode_barcode'] = $request->kode_barcode;
            $input1['lokasi'] = $request->lokasi;
            $input1['departemen_id'] = $request->departemen_id;

            // $input2['id'] = Str::uuid();
            // $input2['inventaris_k3_id'] = $input1['id'];
            // $input2['jenis_barang'] = $request->jenis_barang;
            // $input2['status'] = $request->status;

            $inventaris_k3 = InventarisK3::create($input1);

            if($inventaris_k3){
                foreach ($request['jenis_barang'] as $key => $value) {
                    InventarisK3Detail::create([
                        'id' => Str::uuid(),
                        'inventaris_k3_id' => $input1['id'],
                        'jenis_barang' => $value,
                        'status' => $request->status
                    ]);
                }
                $message_title="Berhasil !";
                $message_content="Kode Barcode ".$request->kode_barcode." Berhasil Dibuat";
                $message_type="success";
                $message_succes = true;
            }

            // foreach ($request['jenis_barang'] as $key => $value) {
            //     // dd($value);
            //     InventarisK3Detail::create([
            //         'id' => Str::uuid(),
            //         'inventaris_k3_id' => $input1['id'],
            //         'jenis_barang' => $value,
            //         'status' => $request->status
            //     ]);
            // }
            // $message_title="Berhasil !";
            // $message_content="Kode Barcode ".$request->kode_barcode." Berhasil Dibuat";
            // $message_type="success";
            // $message_succes = true;

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
        
        // dd($data);
        // dd($request->all());
    }

    public function edit($id)
    {
        $data['inventaris'] = InventarisK3::find($id);
        if(empty($data['inventaris'])){
            return redirect()->back()->with('error','Data Tidak Ditemukan');
        }
        $data['inventarisDetails'] = InventarisK3Detail::where('inventaris_k3_id',$data['inventaris']['id'])->get();
        foreach($data['inventarisDetails'] as $inventarisDetail){
            if($inventarisDetail->jenis_barang == "APAR"){
                $data['formApar'] = FormApart::where('inventaris_k3_detail_id',$inventarisDetail->id)->where('status','Y')->first();
            }
            else if($inventarisDetail->jenis_barang == "HYDRANT"){
                $data['formHydrant'] = FormHydrant::where('inventaris_k3_detail_id',$inventarisDetail->id)->where('status','Y')->first();
            }
        }
        return view('backend.inventaris.k3.edit',$data);
    }

    public function edit_update(Request $request, $id)
    {
        $data['inventaris'] = InventarisK3::find($id);
        if(empty($data['inventaris'])){
            return redirect()->back()->with('error','Data Tidak Ditemukan');
        }
        $data['inventarisDetails'] = InventarisK3Detail::where('inventaris_k3_id',$data['inventaris']['id'])->get();
        foreach($data['inventarisDetails'] as $inventarisDetail){
            if($inventarisDetail->jenis_barang == "APAR"){
                $data['formApar'] = FormApart::where('inventaris_k3_detail_id',$inventarisDetail->id)->where('status','Y')->update([
                    'kode_tabung' => $request->kode_tabung,
                    'berat' => $request->berat,
                    'jenis' => $request->jenis,
                    'expired' => $request->expired,
                    'warna' => $request->warna,
                    'tempat' => $request->tempat
                ]);
                if($data['formApar']){
                    $status = 'success';
                    $message = 'Form berhasil diupdate';
                }else{
                    $status = 'error';
                    $message = 'Form APAR tidak berhasil diupdate';
                    return redirect()->back()->with($status,$message);
                }
            }
            else if($inventarisDetail->jenis_barang == "HYDRANT"){
                $data['formHydrant'] = FormHydrant::where('inventaris_k3_detail_id',$inventarisDetail->id)->where('status','Y')->update([
                    'kode_hydrant' => $request->kode_hydrant,
                    'periode' => $request->periode,
                    'lokasi' => $request->lokasi
                ]);
                if($data['formHydrant']){
                    $status = 'success';
                    $message = 'Form berhasil diupdate';
                }else{
                    $status = 'error';
                    $message = 'Form HYDRANT tidak berhasil diupdate';
                    return redirect()->back()->with($status,$message);
                }
            }
        }
        return redirect()->route('inventaris.k3')->with($status,$message);
    }

    public function delete($id)
    {
        // return response()->json($id);
        $invetarisK3 = InventarisK3::find($id);
        if(empty($invetarisK3)){
            return response()->json([
                'success' => false,
                'notif' => 'error',
                'message' => 'Data Tidak Ditemukan'
            ]);
        }

        $inventarisK3Details = InventarisK3Detail::where('inventaris_k3_id',$invetarisK3->id)->get();
        if(empty($inventarisK3Details)){
            $invetarisK3->delete();
            return response()->json([
                'success' => false,
                'notif' => 'error',
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        foreach ($inventarisK3Details as $key => $inventarisK3Detail) {
            if($inventarisK3Detail->jenis_barang == "APAR"){
                $formApart = FormApart::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
                if(!empty($formApart)){
                    $formApartDetails = FormApartDetail::where('form_apart_id',$formApart->id)->delete();
                    $formApart->delete();
                }
            }
            else if($inventarisK3Detail->jenis_barang == "HYDRANT"){
                $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
                if(!empty($formHydrant)){
                    $formHydrantDetails = FormHydrantDetail::where('form_hydrant_id',$formHydrant->id)->delete();
                    $formHydrant->delete();
                }
            }
            $inventarisK3Detail->delete();
        }
        $invetarisK3->delete();
        return response()->json([
            'success' => true,
            'notif' => 'success',
            'message' => 'Data Berhasil Dihapus'
        ]);

    }

    public function print_barcode_k3()
    {
        $printInventaris = InventarisK3::all();
        foreach ($printInventaris as $key => $print) {
            $data['pdfs'][] = [
                'id' => $print->id,
                // 'barcode' => '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />',
                // 'barcode' => '<img src="data:image/png;base64,'. DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5,5,'black', true) .'" alt="barcode" />',
                // 'barcode' => 'data:image/png;base64,'. DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5,5,'black', true) .' ',
                'barcode' => DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',8.3,8.3,'black', true),
                'kode_barcode' => $print->kode_barcode,
                'lokasi' => $print->lokasi,
                'departemen' => $print->departemen->nama_departemen,
            ];
        }
        return view('backend.inventaris.k3.print', $data);
        // $pdf = Pdf::loadView('backend.inventaris.k3.print', $data);
        // return $pdf->stream();
    }

    public function print_barcode_k3_detail($id)
    {
        $printInventaris = InventarisK3::where('id',$id)->get();
        foreach ($printInventaris as $key => $print) {
            $data['pdfs'][] = [
                'id' => $print->id,
                // 'barcode' => '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />',
                // 'barcode' => '<img src="data:image/png;base64,'. DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5,5,'black', true) .'" alt="barcode" />',
                // 'barcode' => 'data:image/png;base64,'. DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',5,5,'black', true) .' ',
                'barcode' => DNS2D::getBarcodeHTML($print->kode_barcode, 'QRCODE',8.3,8.3,'black', true),
                'kode_barcode' => $print->kode_barcode,
                'lokasi' => $print->lokasi,
                'departemen' => $print->departemen->nama_departemen,
            ];
        }
        return view('backend.inventaris.k3.print', $data);
    }

    public function check_data($id)
    {
        $data['inventaris'] = InventarisK3::find($id);
        $data['inventarisDetails'] = InventarisK3Detail::where('inventaris_k3_id',$data['inventaris']['id'])->get();
        $data['UserManagement'] = UserManagement::where('user_id',auth()->user()->id)->first();

        return view('backend.inventaris.k3.checkData',$data);
    }

    public function detail_k3($id)
    {
        $data['inventaris'] = InventarisK3::find($id);
        if(empty($data['inventaris'])){
            return redirect()->back();
        }

        $data['inventarisDetails'] = InventarisK3Detail::where('inventaris_k3_id',$data['inventaris']['id'])->get();

        if(empty($data['inventarisDetails'])){
            return redirect()->back();
        }

        // foreach($data['inventarisDetails'] as $inventarisDetail){
        //     $formApart = FormApart::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
        //     $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();

        //     if($inventarisK3Detail->jenis_barang == "APAR" || $inventarisK3Detail->jenis_barang == "HYDRANT"){
        //         if(empty($formApart) && empty($formHydrant)){
        //             return view('backend.inventaris.k3.detail',$data);
        //         }
        //         if(!empty($formApart) || !empty($formHydrant)){
        //             return redirect()->route('inventaris.k3.detail.form',['id' => $id]);
        //         }
        //     }
        // }
        // return view('backend.inventaris.k3.form',$data);
        $data['roles'] = Roles::find(auth()->user()->roles);
        if($data['roles']['id'] != 3){
            return view('backend.inventaris.k3.detail',$data);
        }else{
            return redirect()->back();
        }
    }

    public function detail_k3_form($id)
    {
        $data['inventaris'] = InventarisK3::find($id);
        $data['inventarisDetails'] = InventarisK3Detail::where('inventaris_k3_id',$data['inventaris']['id'])->get();
        $data['UserManagement'] = UserManagement::where('user_id',auth()->user()->id)->first();

        return view('backend.inventaris.k3.form',$data);
    }

    // public function detail_k3_simpan_backup(Request $request,$id)
    // {
    //     $data['inventarisDetails'] = InventarisK3Detail::where('inventaris_k3_id',$id)->first();
    //     if($data['inventarisDetails']['jenis_barang'] == "APAR"){
    //         $input1['id'] = Str::uuid();
    //         $input1['inventaris_k3_detail_id'] = $data['inventarisDetails']['id'];
    //         $input1['kode_tabung'] = $request->kode_tabung;
    //         $input1['jenis'] = $request->jenis;
    //         $input1['warna'] = $request->warna;
    //         $input1['berat'] = $request->berat;
    //         $input1['expired'] = $request->expired;
    //         $input1['tempat'] = $request->tempat;

    //         $data['form_apart'] = FormApart::create($input1);
    //         $data['bulan'] = array("", "Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");

    //         for ($i=1; $i <= 12 ; $i++) { 
    //             // $data['form_aparts'][] = [
    //             //     'no' => $i,
    //             //     'bulan' => $data['bulan'][$i]
    //             // ];
    //             FormApartDetail::create([
    //                 'id' => Str::uuid(),
    //                 'form_apart_id' => $data['form_apart']['id'],
    //                 'bulan' => sprintf("%02s",$i).'|'.$data['bulan'][$i]
    //             ]);
    //         }
    //     }elseif($data['inventarisDetails']['jenis_barang'] == "HYDRANT"){
    //         $input2['id'] = Str::uuid();
    //         $input2['inventaris_k3_detail_id'] = $data['inventarisDetails']['id'];
    //         $input2['kode_hydrant'] = $request->kode_hydrant;
    //         $input2['lokasi'] = $request->lokasi;
    //         $input2['periode'] = $request->periode;

    //         $data['form_hydrant'] = FormHydrant::create($input2);
    //         $data['bulan'] = array("", "Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");

    //         for ($i=1; $i <= 12 ; $i++) { 
    //             // $data['form_aparts'][] = [
    //             //     'no' => $i,
    //             //     'bulan' => $data['bulan'][$i]
    //             // ];
    //             FormHydrantDetail::create([
    //                 'id' => Str::uuid(),
    //                 'form_hydrant_id' => $data['form_hydrant']['id'],
    //                 'bulan' => $i.'|'.$data['bulan'][$i]
    //             ]);
    //         }
    //     }

    //     return redirect()->back();
    //     // dd($request->all());
    // }

    public function detail_k3_simpan(Request $request,$id)
    {
        $inventarisDetails = InventarisK3Detail::where('inventaris_k3_id',$id)->get();
        foreach($inventarisDetails as $inventarisDetail){
            if($inventarisDetail->jenis_barang == "APAR"){
                $input1['id'] = Str::uuid();
                $input1['inventaris_k3_detail_id'] = $inventarisDetail->id;
                $input1['kode_tabung'] = $request->kode_tabung;
                $input1['jenis'] = $request->jenis;
                $input1['warna'] = $request->warna;
                $input1['berat'] = $request->berat;
                $input1['expired'] = $request->expired;
                $input1['tempat'] = $request->tempat;
                $input1['periode'] = $request->periode;
                $input1['status'] = 'Y';
    
                $data['form_apart'] = FormApart::create($input1);
                $data['bulan'] = array("", "Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
    
                for ($i=1; $i <= 12 ; $i++) { 
                    // $data['form_aparts'][] = [
                    //     'no' => $i,
                    //     'bulan' => $data['bulan'][$i]
                    // ];
                    FormApartDetail::create([
                        'id' => Str::uuid(),
                        'form_apart_id' => $data['form_apart']['id'],
                        'bulan' => sprintf("%02s",$i).'|'.$data['bulan'][$i].'|'.Carbon::now()->format('Y')
                    ]);
                }
            }elseif($inventarisDetail->jenis_barang == "HYDRANT"){
                $input2['id'] = Str::uuid();
                $input2['inventaris_k3_detail_id'] = $inventarisDetail->id;
                $input2['kode_hydrant'] = $request->kode_hydrant;
                $input2['lokasi'] = $request->lokasi;
                $input2['periode'] = $request->periode;
                $input2['status'] = 'Y';
    
                $data['form_hydrant'] = FormHydrant::create($input2);
                $data['bulan'] = array("", "Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
    
                for ($i=1; $i <= 12 ; $i++) { 
                    // $data['form_aparts'][] = [
                    //     'no' => $i,
                    //     'bulan' => $data['bulan'][$i]
                    // ];
                    FormHydrantDetail::create([
                        'id' => Str::uuid(),
                        'form_hydrant_id' => $data['form_hydrant']['id'],
                        'bulan' => sprintf("%02s",$i).'|'.$data['bulan'][$i].'|'.Carbon::now()->format('Y')
                    ]);
                }
            }
        }

        return redirect()->route('inventaris.k3');
        // dd($request->all());
    }

    public function detail_k3_update(Request $request,$id){
        // dd($request->all());
        // dd($request->all());
        $inventarisDetails = InventarisK3Detail::where('inventaris_k3_id',$id)->get();
        foreach ($inventarisDetails as $inventarisDetail) {
            if($inventarisDetail->jenis_barang == "APAR"){
                $formApart = FormApart::where('inventaris_k3_detail_id',$inventarisDetail->id)->first();
                $cekFormApart = FormApartDetail::where('id',$request->id_apar)->first();
                if($cekFormApart->tanggal == null || 
                    $cekFormApart->pressure == null || 
                    $cekFormApart->nozzel == null ||
                    $cekFormApart->segel == null ||
                    $cekFormApart->tuas == null ||
                    $cekFormApart->keterangan == null ||
                    $cekFormApart->ttd == null
                    ){
                        if ($request->apar_images) {
                            $image = $request->file('apar_images');
                            $img = Image::make($image->path());
                            $img = $img->encode('webp', 75);
                            $input['images'] = 'APAR'.'_'.time().'.webp';
                            $img->save(public_path('berkas_k3/').$input['images']);
                            
                            if (env('OPEN_INVENTARIS_K3') == "yes") {
                                $formApartDetail = FormApartDetail::where('id',$request->id_apar)->update([
                                    'tanggal' => $request->tanggal_apar.' '.date("H:i:s"),
                                    'pressure' => $request->apar_pressure,
                                    'nozzel' => $request->apar_nozzel,
                                    'segel' => $request->apar_segel,
                                    'tuas' => $request->apar_tuas,
                                    'keterangan' => $request->apar_keterangan,
                                    'ttd' => auth()->user()->name,
                                    'status' => 0,
                                    'images' => $input['images']
                                ]);
                            }else{
                                $formApartDetail = FormApartDetail::where('id',$request->id_apar)->update([
                                    'tanggal' => Carbon::now(),
                                    'pressure' => $request->apar_pressure,
                                    'nozzel' => $request->apar_nozzel,
                                    'segel' => $request->apar_segel,
                                    'tuas' => $request->apar_tuas,
                                    'keterangan' => $request->apar_keterangan,
                                    'ttd' => auth()->user()->name,
                                    'status' => 0,
                                    'images' => $input['images']
                                ]);
                            }
                        }
                        // $departemenDetails = DepartemenDetail::where('user_id',auth()->user()->id)->get();
                        // $departemens = Departemen::where('id',$departemenDetail->id)->get();
                        $offerData = [
                            // 'jumlah' => $lembur->total_gaji,
                            'title' => 'Checklist APAR',
                            'message' => 'Petugas '.auth()->user()->name.' Checklist APAR berhasil dibuat',
                            'url' => route('inventaris.k3.detail.form',['id' => $id]),
                            'icon' => 'check',
                            'color_icon' => 'success'
                        ];

                        $departemenDetail = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                        $departemen_details = DepartemenDetail::where('departemen_id',$departemenDetail->departemen_id)->get();
                        foreach ($departemen_details as $key => $departemen_detail) {
                            $users = User::find($departemen_detail->user_id);
                            Notification::send($users, new InventarisK3Notification($offerData));
                        }
                        $message = 'success';
                        $messageText = 'Form Berhasil Disimpan';
                    }
                else{
                    $message = 'error';
                    $messageText = 'Form Gagal Disimpan';
                }
            }elseif ($inventarisDetail->jenis_barang == "HYDRANT") {
                $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisDetail->id)->first();
                $cekFormHydrant = FormHydrantDetail::where('id',$request->id_hydrant)->first();
                if($cekFormHydrant->tanggal == null ||
                    $cekFormHydrant->selang == null ||
                    $cekFormHydrant->kran == null ||
                    $cekFormHydrant->nozzel == null ||
                    $cekFormHydrant->checker == null ||
                    $cekFormHydrant->keterangan == null
                ){
                    if ($request->hydrant_images) {
                        $image = $request->file('hydrant_images');
                        $img = \Image::make($image->path());
                        $img = $img->encode('webp', 75);
                        $input['images'] = 'HYDRANT'.'_'.time().'.webp';
                        $img->save(public_path('berkas_k3/').$input['images']);

                        if (env('OPEN_INVENTARIS_K3') == "yes") {
                            $formHydrantDetail = FormHydrantDetail::where('id',$request->id_hydrant)->update([
                                'tanggal' => $request->tanggal_hydrant.' '.date("H:i:s"),
                                'selang' => [
                                    'besar' => $request->hydrant_selang_besar,
                                    'kecil' => $request->hydrant_selang_kecil,
                                ],
                                'kran' => [
                                    'besar' => $request->hydrant_kran_besar,
                                    'kecil' => $request->hydrant_kran_kecil,
                                ],
                                'nozzel' => [
                                    'besar' => $request->hydrant_nozzel_besar,
                                    'kecil' => $request->hydrant_nozzel_kecil,
                                ],
                                'checker' => auth()->user()->name,
                                'keterangan' => $request->hydrant_keterangan,
                                'status' => 0,
                                'images' => $input['images']
                            ]);
                        } else {
                            $formHydrantDetail = FormHydrantDetail::where('id',$request->id_hydrant)->update([
                                'tanggal' => Carbon::now(),
                                'selang' => [
                                    'besar' => $request->hydrant_selang_besar,
                                    'kecil' => $request->hydrant_selang_kecil,
                                ],
                                'kran' => [
                                    'besar' => $request->hydrant_kran_besar,
                                    'kecil' => $request->hydrant_kran_kecil,
                                ],
                                'nozzel' => [
                                    'besar' => $request->hydrant_nozzel_besar,
                                    'kecil' => $request->hydrant_nozzel_kecil,
                                ],
                                'checker' => auth()->user()->name,
                                'keterangan' => $request->hydrant_keterangan,
                                'status' => 0,
                                'images' => $input['images']
                            ]);
                        }
                    }

                    $offerData = [
                        // 'jumlah' => $lembur->total_gaji,
                        'title' => 'Checklist HYDRANT',
                        'message' => 'Petugas '.auth()->user()->name.' Checklist HYDRANT berhasil dibuat',
                        'url' => route('inventaris.k3.detail.form',['id' => $id]),
                        'icon' => 'check',
                        'color_icon' => 'success'
                    ];

                    $departemenDetail = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                    $departemen_details = DepartemenDetail::where('departemen_id',$departemenDetail->departemen_id)->get();
                    foreach ($departemen_details as $key => $departemen_detail) {
                        $users = User::find($departemen_detail->user_id);
                        Notification::send($users, new InventarisK3Notification($offerData));
                    }

                    $message = 'success';
                    $messageText = 'Form Berhasil Disimpan';
                }
                else{
                    $message = 'error';
                    $messageText = 'Form Gagal Disimpan';
                }
            }
        }
        return redirect()->back()->with($message,$messageText);
    }

    public function detail_k3_status_apar(Request $request, $id)
    {
        // dd($_GET['apar_status']);
        $inventarisDetails = InventarisK3Detail::where('inventaris_k3_id',$id)->get();
        foreach ($inventarisDetails as $inventarisDetail) {
            if($inventarisDetail->jenis_barang == "APAR"){
                $formApart = FormApart::where('inventaris_k3_detail_id',$inventarisDetail->id)->first();
                $cekFormApart = FormApartDetail::where('id',$_GET['id_apar'])->first();
                // dd($formApart);
                $getAparStatus = $_GET['apar_status'];
                if($getAparStatus != '-'){
                    $cekFormApart->status = $getAparStatus;
                }
                if($getAparStatus == "T"){
                    $cekFormApart->tanggal = null;
                    $cekFormApart->pressure = null;
                    $cekFormApart->nozzel = null;
                    $cekFormApart->segel = null;
                    $cekFormApart->tuas = null;
                    $cekFormApart->keterangan = null;
                    // $cekFormApart->images = null;
                    if (file_exists(public_path('berkas_k3/'.$cekFormApart->images))) {
                        unlink(public_path('berkas_k3/'.$cekFormApart->images));
                        $cekFormApart->images = null;
                    }
                    // dd($cekFormApart);
                }
                $cekFormApart->approval = auth()->user()->name;
                $cekFormApart->update();

                if($getAparStatus == "Y"){
                    $status = "Approval";
                    $message = 'success';

                    $offerData = [
                        // 'jumlah' => $lembur->total_gaji,
                        'title' => 'Verifikasi APAR Disetujui',
                        'message' => 'Verifikasi '.auth()->user()->name.' Checklist APAR disetujui',
                        'url' => route('inventaris.k3.detail.form',['id' => $id]),
                        'icon' => 'check',
                        'color_icon' => 'success'
                    ];

                    $departemenDetail = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                    $departemen_details = DepartemenDetail::where('departemen_id',$departemenDetail->departemen_id)->get();
                    foreach ($departemen_details as $key => $departemen_detail) {
                        // $users = User::where('id','!=',$departemen_detail->user_id)->first();
                        $users = User::find($departemen_detail->user_id);
                        Notification::send($users, new InventarisK3Notification($offerData));
                    }

                }elseif($getAparStatus == "T"){
                    $status = "Not Approval";
                    $message = 'success';

                    $offerData = [
                        // 'jumlah' => $lembur->total_gaji,
                        'title' => 'Verifikasi APAR Ditolak',
                        'message' => 'Verifikasi '.auth()->user()->name.' Checklist APAR ditolak',
                        'url' => route('inventaris.k3.detail.form',['id' => $id]),
                        'icon' => 'x',
                        'color_icon' => 'danger'
                    ];

                    $departemenDetail = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                    $departemen_details = DepartemenDetail::where('departemen_id',$departemenDetail->departemen_id)->get();
                    foreach ($departemen_details as $key => $departemen_detail) {
                        $users = User::find($departemen_detail->user_id);
                        Notification::send($users, new InventarisK3Notification($offerData));
                    }
                    // if (File::exists(public_path('berkas_k3/'.$cekFormApart->images))) {
                    //     File::delete(public_path('berkas_k3/'.$cekFormApart->images));
                    // }
                    // if(file_exists(public_path('berkas_k3/'.$cekFormApart->images)))
                    // {
                    //     unlink(public_path('berkas_k3/'.$cekFormApart->images));
                    // }
                }
                $messageText = 'Status pengecekkan '.$status;
            }
        }
        return response()->json([
            'success' => true,
            'message_status' => $message,
            'message_title' => $messageText,
        ]);
    }

    public function detail_k3_status_hydrant(Request $request, $id)
    {
        // dd($_GET['apar_status']);
        $inventarisDetails = InventarisK3Detail::where('inventaris_k3_id',$id)->get();
        foreach ($inventarisDetails as $inventarisDetail) {
            if($inventarisDetail->jenis_barang == "HYDRANT"){
                $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisDetail->id)->first();
                $cekFormHydrant = FormHydrantDetail::where('id',$_GET['id_hydrant'])->first();
                // $cekFormHydrant->status = $request->hydrant_status;
                $getHydrantStatus = $_GET['hydrant_status'];
                if($getHydrantStatus != '-'){
                    $cekFormHydrant->status = $getHydrantStatus;
                }
                if($getHydrantStatus == "T"){
                    $cekFormHydrant->tanggal = null;
                    $cekFormHydrant->selang = null;
                    $cekFormHydrant->kran = null;
                    $cekFormHydrant->nozzel = null;
                    $cekFormHydrant->keterangan = null;
                    // $cekFormHydrant->images = null;
                    if (file_exists(public_path('berkas_k3/'.'/'.$cekFormHydrant->images))) {
                        unlink(public_path('berkas_k3/'.'/'.$cekFormHydrant->images));
                        $cekFormHydrant->images = null;
                    }
                }
                $cekFormHydrant->approval = auth()->user()->name;
                $cekFormHydrant->update();
                if($getHydrantStatus == "Y"){
                    $message = 'success';
                    $status = "Approval";

                    $offerData = [
                        // 'jumlah' => $lembur->total_gaji,
                        'title' => 'Verifikasi HYDRANT Disetujui',
                        'message' => 'Verifikasi '.auth()->user()->name.' Checklist HYDRANT disetujui',
                        'url' => route('inventaris.k3.detail.form',['id' => $id]),
                        'icon' => 'check',
                        'color_icon' => 'success'
                    ];

                    $departemenDetail = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                    $departemen_details = DepartemenDetail::where('departemen_id',$departemenDetail->departemen_id)->get();
                    foreach ($departemen_details as $key => $departemen_detail) {
                        $users = User::find($departemen_detail->user_id);
                        Notification::send($users, new InventarisK3Notification($offerData));
                    }

                }elseif($getHydrantStatus == "T"){
                    $status = "Not Approval";
                    $message = 'success';

                    $offerData = [
                        // 'jumlah' => $lembur->total_gaji,
                        'title' => 'Verifikasi HYDRANT Ditolak',
                        'message' => 'Verifikasi '.auth()->user()->name.' Checklist HYDRANT ditolak',
                        'url' => route('inventaris.k3.detail.form',['id' => $id]),
                        'icon' => 'x',
                        'color_icon' => 'danger'
                    ];

                    $departemenDetail = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                    $departemen_details = DepartemenDetail::where('departemen_id',$departemenDetail->departemen_id)->get();
                    foreach ($departemen_details as $key => $departemen_detail) {
                        $users = User::find($departemen_detail->user_id);
                        Notification::send($users, new InventarisK3Notification($offerData));
                    }
                    
                    // if (File::exists(public_path('berkas_k3/'.$cekFormHydrant->images))) {
                    //     File::delete(public_path('berkas_k3/'.$cekFormHydrant->images));
                    // }
                    // if(file_exists(public_path('berkas_k3/'.$cekFormHydrant->images)))
                    // {
                    //     unlink(public_path('berkas_k3/'.$cekFormHydrant->images));
                    // }
                }
                $messageText = 'Status pengecekkan '.$status;
            }
            // elseif ($inventarisDetail->jenis_barang == "HYDRANT") {
            //     $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisDetail->id)->first();
            //     $cekFormHydrant = FormHydrantDetail::where('id',$_GET['id_hydrant'])->first();
            //     // $cekFormHydrant->status = $request->hydrant_status;
            //     $getHydrantStatus = $_GET['hydrant_status'];
            //     if($getHydrantStatus != '-'){
            //         $cekFormHydrant->status = $getHydrantStatus;
            //     }
            //     $cekFormHydrant->update();
            //     if($getHydrantStatus == "Y"){
            //         $status = "Approval";
            //     }elseif($getHydrantStatus == "T"){
            //         $status = "Ditolak";
            //     }
            //     $message = 'success';
            //     $messageText = 'Status pengecekkan '.$status;
            // }
        }
        return response()->json([
            'success' => true,
            'message_status' => $message,
            'message_title' => $messageText,
        ]);
    }

    public function scans(){
        return view('backend.inventaris.k3.scan');
    }

    public function cek_scans($kode_barcode){
        $inventarisK3 = InventarisK3::where('kode_barcode',$kode_barcode)->first();
        if(empty($inventarisK3)){
            return redirect()->back();
        }
        $inventarisK3Details = InventarisK3Detail::where('inventaris_k3_id',$inventarisK3->id)->get();
        if(empty($inventarisK3Details)){
            return redirect()->route('inventaris.k3.detail',['id' =>$inventarisK3->id]);
        }
        foreach($inventarisK3Details as $inventarisK3Detail){
            $formApart = FormApart::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
            $formHydrant = FormHydrant::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
            if($inventarisK3Detail->jenis_barang == "APAR" || $inventarisK3Detail->jenis_barang == "HYDRANT"){
                if(empty($formApart) && empty($formHydrant)){
                    return redirect()->route('inventaris.k3.detail',['id' =>$inventarisK3->id]);
                }
                if(!empty($formApart) || !empty($formHydrant)){
                    return redirect()->route('inventaris.k3.detail.form',['id' =>$inventarisK3->id]);
                }
            }
        }
        // return redirect()->route('inventaris.k3.detail.form',['id' =>$inventarisK3->id]);
        // return redirect()->route('inventaris.k3.detail',['id' =>$inventarisK3->id]);
    }

    public function download_file($id){
        $data['inventaris'] = InventarisK3::find($id);
        if(empty($data['inventaris'])){
            return redirect()->back();
        }
        $data['inventarisK3Details'] = InventarisK3Detail::where('inventaris_k3_id',$data['inventaris']['id'])->get();
        // dd($inventarisK3Details);
        foreach($data['inventarisK3Details'] as $inventarisK3Detail){
            if($inventarisK3Detail->jenis_barang == "APAR"){
                $data['formApars'] = FormApart::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
                if(empty($data['formApars'])){
                    $data['formApars'] = [
                        'kode_tabung' => '-',
                        'jenis' => '-',
                        'expired' => '-',
                        'warna' => '-',
                        'tempat' => '-',
                    ];
                }
                $data['formAparDetails'] = FormApartDetail::where('form_apart_id',$data['formApars']['id'])->orderBy('bulan','asc')->get();

            }elseif($inventarisK3Detail->jenis_barang == "HYDRANT"){
                $data['formHydrants'] = FormHydrant::where('inventaris_k3_detail_id',$inventarisK3Detail->id)->first();
                if(empty($data['formHydrants'])){
                    $data['formHydrants'] = [
                        'kode_hydrant' => '-',
                        'periode' => '-',
                        'lokasi' => '-',
                    ];
                }
                $data['formHydrantDetails'] = FormHydrantDetail::where('form_hydrant_id',$data['formHydrants']['id'])->orderBy('bulan','asc')->get();
            }
        }
        $pdf = new PDF();
        $pdf = PDF::loadView('backend.inventaris.k3.print_pdf', $data);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
        // return view('backend.inventaris.k3.scan');
    }

    public function periode()
    {
        $data['inventarisK3s'] = InventarisK3::get();
        return view('backend.inventaris.k3.periode.index',$data);
    }

    public function periode_simpan(Request $request)
    {
        // $input = $request->all();
        $periode = $request->periode;
        $data_form_apars = FormApart::where('status','Y')
                                    ->orderBy('created_at','desc')
                                    // ->limit(2)
                                    ->get();
        $data_form_hydrants = FormHydrant::where('status','Y')
                                        ->orderBy('created_at','desc')
                                        // ->limit(2)
                                        ->get();

        foreach ($data_form_apars as $key => $data_form_apar) {
            if($periode >= $data_form_apar->periode){
                $data['form_apart'] = FormApart::create([
                                                'id' => Str::uuid(),
                                                'inventaris_k3_detail_id' => $data_form_apar->inventaris_k3_detail_id,
                                                'kode_tabung' => $data_form_apar->kode_tabung,
                                                'jenis' => $data_form_apar->jenis,
                                                'warna' => $data_form_apar->warna,
                                                'berat' => $data_form_apar->berat,
                                                'expired' => $data_form_apar->expired,
                                                'tempat' => $data_form_apar->tempat,
                                                'periode' => $periode,
                                                'status' => 'Y'
                                            ]);

                $data['bulan'] = array("", "Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
                for ($i=1; $i <= 12 ; $i++) { 
                    // $data['form_aparts'][] = [
                    //     'no' => $i,
                    //     'bulan' => $data['bulan'][$i]
                    // ];
                    FormApartDetail::create([
                        'id' => Str::uuid(),
                        'form_apart_id' => $data['form_apart']['id'],
                        'bulan' => sprintf("%02s",$i).'|'.$data['bulan'][$i].'|'.$periode
                    ]);
                }

                FormApart::where('periode','<',$periode)->update([
                    'status' => 'N',
                ]);
            }
        }
        foreach ($data_form_hydrants as $key => $data_form_hydrant) {
            if($periode >= $data_form_hydrant->periode){
                $data['form_hydrant'] = FormHydrant::create([
                                                    'id' => Str::uuid(),
                                                    'inventaris_k3_detail_id' => $data_form_hydrant->inventaris_k3_detail_id,
                                                    'kode_hydrant' => $data_form_hydrant->kode_hydrant,
                                                    'lokasi' => $data_form_hydrant->lokasi,
                                                    'periode' => $periode,
                                                    'status' => 'Y'
                                                ]);
                $data['bulan'] = array("", "Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
                for ($i=1; $i <= 12 ; $i++) { 
                    // $data['form_aparts'][] = [
                    //     'no' => $i,
                    //     'bulan' => $data['bulan'][$i]
                    // ];
                    FormHydrantDetail::create([
                        'id' => Str::uuid(),
                        'form_hydrant_id' => $data['form_hydrant']['id'],
                        'bulan' => sprintf("%02s",$i).'|'.$data['bulan'][$i].'|'.$periode
                    ]);
                }
                FormHydrant::where('periode','<',$periode)->update([
                    'status' => 'N',
                ]);
            }
        }
        // return response()->json([
        //     $data
        // ]);
        // return redirect()->back();
        return response()->json([
            'status' => true,
            'message' => 'Input Periode '.$periode.' berhasil disimpan'
        ]);
    }

    public function report_all()
    {
        return view('backend.inventaris.k3.report');
    }

    public function report_periode(Request $request)
    {
        $data['periode_from'] = $request->periode_from;
        $data['periode_to'] = $request->periode_to;

        $data['inventarisK3Details'] = InventarisK3Detail::orderBy('jenis_barang','asc')->get();
        $pdf = new PDF();
        $pdf = PDF::loadView('backend.inventaris.k3.print_periode', $data);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Form Checklist APAR HYDRANT Periode '.$data['periode_from'].' To '.$data['periode_to']);
    }
}
