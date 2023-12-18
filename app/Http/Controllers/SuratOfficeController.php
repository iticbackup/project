<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SuratOffice;
use App\Models\SuratOfficeBerkas;
use App\Models\SuratOfficeVerifikasi;
use App\Models\UserManagement;
use App\Models\Departemen;
use App\Models\DepartemenDetail;
use \Carbon\Carbon;
use Validator;
use DataTables;
use File;
use Response;
use Storage;

class SuratOfficeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = SuratOffice::all();
            return DataTables::of($data)
                        ->addIndexColumn()
                        // ->addColumn('created_at', function($row){
                        //     return Carbon::parse($row->created_at)->isoFormat('LLLL');
                        // })
                        // ->addColumn('updated_at', function($row){
                        //     return Carbon::parse($row->updated_at)->isoFormat('LLLL');
                        // })
                        // ->addColumn('action', function($row){
                        //     $Roles = Roles::find(auth()->user()->roles);
                        //     $UserManagement = UserManagement::where('user_id',auth()->user()->id)->first();
                        //     $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                        //     if($Roles->id == 1){
                        //         $btn = $btn.'<button type="button" onclick="reset(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                        //         $btn = $btn.'<i class="fas fa-undo-alt"></i> Reset Password';
                        //         $btn = $btn.'</button>';
                        //     }
                        //     if($UserManagement->u == "Y"){
                        //         $btn = $btn.'<button type="button" onclick="edit(`'.$row->id.'`)" class="btn btn-warning btn-icon">';
                        //         $btn = $btn.'<i class="fa fa-edit"></i>';
                        //         $btn = $btn.'</button>';
                        //     }
                        //     if($UserManagement->d == "Y"){
                        //         $btn = $btn.'<button type="button" onclick="hapus(`'.$row->id.'`)" class="btn btn-danger btn-icon">';
                        //         $btn = $btn.'<i class="fa fa-trash"></i>';
                        //         $btn = $btn.'</button>';
                        //     }
                        //     $btn = $btn.'</div>';
                        //     return $btn;
                        // })
                        ->addColumn('tanggal', function($row){
                            // $date=date_create($row->tanggal);
                            // return date_format($date,"Y/m/d");
                            // echo date_format($date,"Y/m/d H:i:s");
                            // return Carbon::create($row->tanggal)->isoFormat('LLL');
                            if($row->tanggal){
                                return Carbon::create($row->tanggal)->isoFormat('LL');
                            }
                        })
                        ->addColumn('pengguna', function($row){
                            $exploded = explode("|",$row->pengguna);
                            return $exploded[0];
                        })
                        ->addColumn('status', function($row){
                            // $surat_office_verifikasis = SuratOfficeVerifikasi::where('surat_office_id',$row->id)->get();
                            // $ul = '<ul class="steppedprogress pt-1">';
                            // if($row->status == 0){
                            //     $ul = $ul.'li class="complete continuous"><span>Available</span></li>';
                            //     $ul = $ul.'<li class="complete"><span>Menunggu Persetujuan</span></li>';
                            //     $ul = $ul.'<li class="complete"><span>Perlu Diupdate</span></li>';
                            //     $ul = $ul.'<li class="complete"><span>Verifikasi</span></li>';
                            // }else{
                            //     $ul = $ul.'<li class="complete"><span>Available</span></li>';
                            //     foreach($surat_office_verifikasis as $key => $sov){

                            //         if($sov->status == 1){
                            //             $status = 'Menunggu Persetujuan';
                            //         }elseif($sov->status == 2){
                            //             $status = 'Verifikasi';
                            //         }elseif($sov->status == 3){
                            //             $status = 'Perlu Diupdate';
                            //         }elseif($sov->status == 4){
                            //             $status = 'Ditolak';
                            //         }else{
                            //             $status = 'Available';
                            //         }

                            //         if($sov->continuous == 1){
                            //             $ul = $ul.'<li class="complete continuous"><span>'.$status.'</span></li>';
                            //         }elseif ($sov->continuous == 0) {
                            //             $ul = $ul.'<li class="complete"><span>'.$status.'</span></li>';
                            //         }
                            //     }
                            // }
                            // $ul = $ul.'</ul>';
                            // return $ul;

                            $surat_office_verifikasis = SuratOfficeVerifikasi::where('surat_office_id',$row->id)->get();

                            $div =      '<div>';
                            // $div = $div.    '<div class="row">';
                            // $div = $div.        '<div class="col-md-6">';
                            // $div = $div.            '<div class="media mb-3">';
                            // $div = $div.                '<div class="media-body align-self-center text-truncate ms-3">';
                            // $div = $div.                    '<h4 class="m-0 font-weight-semibold text-dark font-16">Nomor Surat: '.$row->nomor_surat.'</h4>';
                            // $div = $div.                    '<p class="mb-0 font-13"><span class="text-dark">Perihal : </span>'.$row->keterangan.'</p>';
                            // $div = $div.                '</div>';
                            // $div = $div.            '</div>';
                            // $div = $div.        '</div>';
                            // $div = $div.        '<div class="col-md-6 text-lg-right">';
                            // if($row->tanggal){
                            //    $tanggal = Carbon::create($row->tanggal)->isoFormat('LL');
                            //    $updated_at = Carbon::create($row->updated_at)->isoFormat('LLL');
                            // }else{
                            //     $tanggal = '-';
                            //     $updated_at = '-';
                            // }
                            // $div = $div.                    '<h6 class="font-weight-semibold m-0">Tanggal : <span class="text-muted font-weight-normal"> '.$tanggal.'</span></h6>';
                            // $div = $div.                    '<h6 class="font-weight-semibold  mb-0 mt-2">Tanggal Pembaruan : <span class="text-muted font-weight-normal"> '.$updated_at.'</span></h6>';
                            // $div = $div.        '</div>';
                            // $div = $div.    '</div>';
                            $div = $div.    '<div class="holder">';
                            $div = $div.        '<ul class="steppedprogress pt-1">';
                             if($row->status == 0){
                                $div = $div.        '<li class="complete continuous"><span>Available</span></li>';
                                $div = $div.        '<li class="complete"><span>Menunggu Persetujuan</span></li>';
                                $div = $div.        '<li class="complete"><span>Perlu Diupdate</span></li>';
                                $div = $div.        '<li class="complete"><span>Verifikasi</span></li>';
                            }else{
                                $div = $div.'       <li class="complete"><span>Available</span></li>';
                                foreach($surat_office_verifikasis as $key => $sov){

                                    if($sov->status == 1){
                                        // $notif = 'finish';
                                        $notif = 'continuous';
                                        $status = 'Menunggu Persetujuan';
                                    }elseif($sov->status == 2){
                                        $notif = 'finish';
                                        $status = 'Verifikasi';
                                    }elseif($sov->status == 3){
                                        $notif = 'update';
                                        $status = 'Perlu Diupdate';
                                    }elseif($sov->status == 4){
                                        $notif = 'reject';
                                        $status = 'Ditolak';
                                    }else{
                                        $status = 'Available';
                                    }

                                    if($sov->continuous == 1){
                                        $div = $div.'<li class="complete '.$notif.'"><span>'.$status.'</span></li>';
                                    }elseif ($sov->continuous == 0) {
                                        $div = $div.'<li class="complete"><span>'.$status.'</span></li>';
                                    }
                                }
                            }
                            $div = $div.        '</ul>';
                            $div = $div.    '</div>';
                            $div = $div.'</div>';
                            return $div;
                        })
                        ->addColumn('action', function($row){
                            $nomor_surat = explode("/",$row->nomor_surat);
                            $fix_nomor_surat = $nomor_surat[1].'_'.$nomor_surat[2].'_'.$nomor_surat[3];
                            
                            $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                            $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                            // if($row->status == 0){
                            //     $btn = $btn.'<a href="'.route('surat_office.edit',['id' => $row->id]).'" class="btn btn-success btn-icon">';
                            //     $btn = $btn.'<i class="fas fa-plus"></i> Pengajuan';
                            //     $btn = $btn.'</a>';
                            // }elseif($row->status == 2){
                            //     $btn = $btn.'<a href="'.route('surat_office.edit',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                            //     $btn = $btn.'<i class="fas fa-eye"></i> Preview';
                            //     $btn = $btn.'</a>';
                            // }elseif($row->status == 3){
                            //     $btn = $btn.'<button type="button" onclick="pengajuan_update(`'.$row->id.'`)" class="btn btn-warning btn-icon">';
                            //     $btn = $btn.'<i class="fas fa-edit"></i> Edit Pengajuan';
                            //     $btn = $btn.'</button>';
                            // }
                            // else{
                            //     if($departemen->departemen->nama_departemen == 'Corsec' || $departemen->departemen->nama_departemen == 'IT'){
                            //         if($row->status == 1 || $row->status == 3){
                            //             $btn = $btn.'<button type="button" onclick="lihat(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                            //             $btn = $btn.'<i class="fas fa-eye"></i> Lihat';
                            //             $btn = $btn.'</button>';
                            //         }
                            //     }
                            // }
                            if($departemen->departemen->nama_departemen == 'Corsec' || $departemen->departemen->nama_departemen == 'IT'){
                                if($row->status == 0){
                                    $btn = $btn.'<a href="'.route('surat_office.edit',['id' => $row->id]).'" class="btn btn-success btn-icon">';
                                    $btn = $btn.'<i class="fas fa-plus"></i> Pengajuan';
                                    $btn = $btn.'</a>';
                                }elseif($row->status == 1){
                                    $btn = $btn.'<button type="button" onclick="lihat(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-eye"></i> Lihat';
                                    $btn = $btn.'</button>';
                                }elseif($row->status == 2){
                                    $btn = $btn.'<button type="button" onclick="previews(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-eye"></i> Preview';
                                    $btn = $btn.'</button>';
                                    $btn = $btn.'<button type="button" onclick="file_download(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-download"></i> Download';
                                    $btn = $btn.'</button>';
                                    // $btn = $btn.'<a href="'.route('surat_office.download',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                                    // $btn = $btn.'<i class="fas fa-download"></i> Download';
                                    // $btn = $btn.'</a>';
                                }elseif($row->status == 3){
                                    $btn = $btn.'<button type="button" onclick="lihat(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-eye"></i> Lihat';
                                    $btn = $btn.'</button>';
                                    $btn = $btn.'<a href="'.route('surat_office.pengajuan.edit',['id' => $row->id]).'" class="btn btn-warning btn-icon">';
                                    $btn = $btn.'<i class="fas fa-edit"></i> Edit Pengajuan';
                                    $btn = $btn.'</a>';
                                }elseif($row->status == 4){
                                    $btn = $btn.'<button type="button" onclick="previews(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-eye"></i> Preview';
                                    $btn = $btn.'</button>';
                                    $btn = $btn.'<a href="'.route('surat_office.pengajuan_ulang',['id' => $row->id]).'" class="btn btn-warning btn-icon">';
                                    $btn = $btn.'<i class="fas fa-plus"></i> Pengajuan Ulang';
                                    $btn = $btn.'</a>';
                                }
                            }else{
                                if($row->status == 0){
                                    $btn = $btn.'<a href="'.route('surat_office.edit',['id' => $row->id]).'" class="btn btn-success btn-icon">';
                                    $btn = $btn.'<i class="fas fa-plus"></i> Pengajuan';
                                    $btn = $btn.'</a>';
                                }elseif($row->status == 1){
                                    $btn = $btn.'<button type="button" onclick="previews(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-eye"></i> Preview';
                                    $btn = $btn.'</button>';
                                }elseif($row->status == 2){
                                    $btn = $btn.'<button type="button" onclick="previews(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-eye"></i> Preview';
                                    $btn = $btn.'</button>';
                                    $btn = $btn.'<button type="button" onclick="file_download(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-download"></i> Download';
                                    $btn = $btn.'</button>';
                                    // $btn = $btn.'<a href="'.route('surat_office.download',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                                    // $btn = $btn.'<i class="fas fa-download"></i> Download';
                                    // $btn = $btn.'</a>';
                                }elseif($row->status == 3){
                                    $btn = $btn.'<button type="button" onclick="previews(`'.$row->id.'`)" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-eye"></i> Preview';
                                    $btn = $btn.'</button>';
                                    $btn = $btn.'<a href="'.route('surat_office.pengajuan.edit',['id' => $row->id]).'" class="btn btn-warning btn-icon">';
                                    $btn = $btn.'<i class="fas fa-edit"></i> Edit Pengajuan';
                                    $btn = $btn.'</a>';
                                }elseif($row->status == 4){
                                    $btn = $btn.'<a href="'.route('surat_office.pengajuan_ulang',['id' => $row->id]).'" class="btn btn-warning btn-icon">';
                                    $btn = $btn.'<i class="fas fa-plus"></i> Pengajuan Ulang';
                                    $btn = $btn.'</a>';
                                }
                            }
                            $btn = $btn.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['action','status'])
                        ->make(true);
        }
        $data['UserManagement'] = UserManagement::where('user_id',auth()->user()->id)->first();
        $data['bulan'] = [
            ['no' => 1,'nama_bulan' => 'Januari'],
            ['no' => 2,'nama_bulan' => 'Februari'],
            ['no' => 3,'nama_bulan' => 'Maret'],
            ['no' => 4,'nama_bulan' => 'April'],
            ['no' => 5,'nama_bulan' => 'Mei'],
            ['no' => 6,'nama_bulan' => 'Juni'],
            ['no' => 7,'nama_bulan' => 'Juli'],
            ['no' => 8,'nama_bulan' => 'Agustus'],
            ['no' => 9,'nama_bulan' => 'September'],
            ['no' => 10,'nama_bulan' => 'Oktober'],
            ['no' => 11,'nama_bulan' => 'November'],
            ['no' => 12,'nama_bulan' => 'Desember'],
        ];
        return view('backend.surat_office.index',$data);
    }

    public function simpan(Request $request)
    {
        // $data['awal'] = '001';
        $rules = [
            'nama_kop_surat' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required',
        ];
        $messages = [
            'nama_kop_surat.required'  => 'Nama kop surat wajib diisi.',
            'bulan.required'  => 'Bulan wajib diisi.',
            'tahun.required'   => 'Tahun wajib diisi.',
            'jumlah.required'   => 'Jumlah wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->passes()){
            $data['nama_kop_surat'] = $request->nama_kop_surat;
            $data['bulan'] = $request->bulan;
            $data['tahun'] = $request->tahun;
            $data['jumlah'] = $request->jumlah;
            $data['bulan_romawi'] = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
            $no = 1;
            for ($i=1; $i <= $data['jumlah']; $i++) { 
                $input['nomor_surat'] = sprintf("%03s",$i).'/'.$data['nama_kop_surat'].'/'.$data['bulan_romawi'][$data['bulan']].'/'.$data['tahun'];
                $input['status'] = 0;
                $suratOffice = SuratOffice::create($input);
            }

            if($suratOffice){
                $message_title="Berhasil !";
                $message_content="Surat Office Berhasil Dibuat";
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
            // return $data['hasil'];
        }
        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }

    public function pengajuan($id)
    {
        $surat_office = SuratOffice::find($id);
        if(empty($surat_office)){
            return redirect()->back();
        }
        $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
        return view('backend.surat_office.pengajuan',compact('surat_office','departemen'));
    }

    public function pengajuan_simpan(Request $request, $id)
    {
        $rules = [
            'pengajuan_tanggal'  => 'required',
            'pengajuan_perihal'  => 'required',
            'pengajuan_pengguna'  => 'required',
            'pengajuan_files'  => 'required',
        ];
 
        $messages = [
            'pengajuan_tanggal.required'  => 'Tanggal wajib diisi.',
            'pengajuan_perihal.required'  => 'Perihal wajib diisi.',
            'pengajuan_pengguna.required'  => 'Pengguna wajib diisi.',
            'pengajuan_files.required'   => 'Upload File wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input['tanggal'] = $request->pengajuan_tanggal;
            $input['keterangan'] = $request->pengajuan_perihal;
            $input['pengguna'] = $request->pengajuan_pengguna;
            $input['status'] = 1;

            $surat_office = SuratOffice::find($id)->update($input);
            if($surat_office){
                // $inputs['files'] = $request->pengajuan_files;
                $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                if (!File::isDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen))) {
                    File::makeDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen));
                }
                $surat_officer = SuratOffice::find($id);
                $format_tanggal = Carbon::create($input['tanggal'])->isoFormat('LL').'_'.date('h-i-sa');
                $file = $request->file('pengajuan_files');
                $fileName = $surat_officer->nomor_surat.'_'.$input['pengguna'].'_'.$file->getClientOriginalName();
                // $fileName = $format_tanggal.'_'.$input['pengguna'].'_'.$file->getClientOriginalName();
                $file->move(public_path('berkas/'.$departemen->departemen->nama_departemen), $fileName);
                $inputs['files'] = $fileName;

                $surat_office_berkas = SuratOfficeBerkas::create([
                    'surat_office_id' => $id,
                    'departemen_id' => $departemen->id,
                    'files' => $inputs['files'],
                    'status' => $input['status'],
                ]);

                $suratOfficeVerifikasi = SuratOfficeVerifikasi::create([
                    'surat_office_id' => $id,
                    'continuous' => 1,
                    'status' => $input['status']
                ]);

                $message_title="Berhasil !";
                $message_content="Berkas ".$fileName." Berhasil Diupload";
                $message_type="success";
                $message_succes = true;
                $message_id = $id;

                // return redirect()->route('surat_office');
            }
            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
                'message_id' => $message_id,
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

    public function pengajuan_konfirmasi(Request $request)
    {
        $rules = [
            'status'  => 'required',
        ];
 
        $messages = [
            'status.required'  => 'Status Verifikasi wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            $input['id'] = $request->preview_id;
            $input['status'] = $request->status;
            $surat_office = SuratOffice::find($input['id']);
            if($surat_office){
                $surat_office->update($input);
                // $surat_office_berkas = SuratOfficeBerkas::where('surat_office_id',$input['id'])->update([
                //     'status' => $request->status
                // ]);
                $surat_office_berkas_max = SuratOfficeBerkas::select('status')
                                                                        ->where('surat_office_id',$request->preview_id)
                                                                        ->orderBy('id', 'desc')
                                                                        ->take(1);
                $surat_office_berkas_max->update([
                    'status' => $request->status,
                    'remaks' => $request->remaks
                ]);

                $surat_office_verifikasis_max = SuratOfficeVerifikasi::select('continuous')
                                                                        ->where('surat_office_id',$request->preview_id)
                                                                        ->orderBy('id', 'desc')
                                                                        ->take(1);
                $surat_office_verifikasis_max->update([
                    'continuous' => 0,
                ]);
                // if($surat_office_verifikasis_max == 1){
                // }
                $suratOfficeVerifikasi = SuratOfficeVerifikasi::create([
                    'surat_office_id' => $request->preview_id,
                    'continuous' => 1,
                    'status' => $input['status']
                ]);

                $message_title="Berhasil !";
                $message_content="Status Verifikasi Berhasil";
                $message_type="success";
                $message_succes = true;
                $message_id = $input['id'];
                
                $array_message = array(
                    'success' => $message_succes,
                    'message_title' => $message_title,
                    'message_content' => $message_content,
                    'message_type' => $message_type,
                    'message_id' => $message_id,
                );
                return response()->json($array_message);
            }
        }
        return response()->json(
            [
                'success' => false,
                'error' => $validator->errors()->all()
            ]
        );
    }

    public function pengajuan_edit($id)
    {
        $surat_office = SuratOffice::find($id);
        if(empty($surat_office)){
            return redirect()->back();
        }
        $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
        return view('backend.surat_office.pengajuan_edit',compact('surat_office','departemen'));
    }

    public function pengajuan_edit_update(Request $request, $id)
    {
        $rules = [
            'pengajuan_tanggal'  => 'required',
            'pengajuan_perihal'  => 'required',
            'pengajuan_pengguna'  => 'required',
            'pengajuan_files'  => 'required',
        ];
 
        $messages = [
            'pengajuan_tanggal.required'  => 'Tanggal wajib diisi.',
            'pengajuan_perihal.required'  => 'Perihal wajib diisi.',
            'pengajuan_pengguna.required'  => 'Pengguna wajib diisi.',
            'pengajuan_files.required'   => 'Upload File wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input['tanggal'] = $request->pengajuan_tanggal;
            $input['keterangan'] = $request->pengajuan_perihal;
            $input['pengguna'] = $request->pengajuan_pengguna;
            $input['status'] = 1;

            $surat_office = SuratOffice::find($id)->update($input);
            if($surat_office){
                // $inputs['files'] = $request->pengajuan_files;
                $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                if (!File::isDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen))) {
                    File::makeDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen));
                }
                $format_tanggal = Carbon::create($input['tanggal'])->isoFormat('LL');
                $file = $request->file('pengajuan_files');
                $fileName = 'Update_'.$format_tanggal.'_'.date('h-i-sa').'_'.$input['pengguna'].'_'.$file->getClientOriginalName();
                // $fileName = $file->getClientOriginalName();
                $file->move(public_path('berkas/'.$departemen->departemen->nama_departemen), $fileName);
                $inputs['files'] = $fileName;

                $surat_office_berkas = SuratOfficeBerkas::create([
                    'surat_office_id' => $id,
                    'departemen_id' => $departemen->id,
                    'files' => $inputs['files'],
                    'status' => $input['status'],
                ]);

                $surat_office_verifikasis_max = SuratOfficeVerifikasi::select('continuous')
                                                                        ->where('surat_office_id',$id)
                                                                        ->orderBy('id', 'desc')
                                                                        ->take(1);
                $surat_office_verifikasis_max->update([
                    'continuous' => 0,
                ]);

                $suratOfficeVerifikasi = SuratOfficeVerifikasi::create([
                    'surat_office_id' => $id,
                    'continuous' => 1,
                    'status' => $input['status']
                ]);

                $message_title="Berhasil !";
                $message_content="Berkas ".$fileName." Berhasil Diupload";
                $message_type="success";
                $message_succes = true;
                $message_id = $id;

                // return redirect()->route('surat_office');
            }
            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
                'message_id' => $message_id,
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

    public function pengajuan_ulang($id)
    {
        $surat_office = SuratOffice::find($id);
        if(empty($surat_office)){
            return redirect()->back();
        }
        $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
        return view('backend.surat_office.pengajuan_ulang',compact('surat_office','departemen'));
    }

    public function pengajuan_ulang_simpan(Request $request, $id)
    {
        $rules = [
            'pengajuan_tanggal'  => 'required',
            'pengajuan_perihal'  => 'required',
            'pengajuan_pengguna'  => 'required',
            'pengajuan_files'  => 'required',
        ];
 
        $messages = [
            'pengajuan_tanggal.required'  => 'Tanggal wajib diisi.',
            'pengajuan_perihal.required'  => 'Perihal wajib diisi.',
            'pengajuan_pengguna.required'  => 'Pengguna wajib diisi.',
            'pengajuan_files.required'   => 'Upload File wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input['tanggal'] = $request->pengajuan_tanggal;
            $input['keterangan'] = $request->pengajuan_perihal;
            $input['pengguna'] = $request->pengajuan_pengguna;
            $input['status'] = 1;

            $surat_office = SuratOffice::find($id)->update($input);
            if($surat_office){
                // $inputs['files'] = $request->pengajuan_files;
                $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
                if (!File::isDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen))) {
                    File::makeDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen));
                }
                $file = $request->file('pengajuan_files');
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('berkas/'.$departemen->departemen->nama_departemen), $fileName);
                $inputs['files'] = $fileName;

                $surat_office_berkas = SuratOfficeBerkas::create([
                    'surat_office_id' => $id,
                    'files' => $inputs['files'],
                    'status' => $input['status'],
                ]);

                // $surat_office_verifikasis_max = SuratOfficeVerifikasi::select('continuous')
                //                                                         ->where('surat_office_id',$id)
                //                                                         ->orderBy('id', 'desc')
                //                                                         ->take(1);
                // $surat_office_verifikasis_max->update([
                //     'continuous' => 0,
                // ]);
                $surat_office_verifikasis_max = SuratOfficeVerifikasi::select('continuous')
                                                                        ->where('surat_office_id',$id)
                                                                        ->delete();

                $suratOfficeVerifikasi = SuratOfficeVerifikasi::create([
                    'surat_office_id' => $id,
                    'continuous' => 1,
                    'status' => $input['status']
                ]);

                $message_title="Berhasil !";
                $message_content="Berkas ".$file." Berhasil Diupload";
                $message_type="success";
                $message_succes = true;
                $message_id = $id;

                // return redirect()->route('surat_office');
            }
            $array_message = array(
                'success' => $message_succes,
                'message_title' => $message_title,
                'message_content' => $message_content,
                'message_type' => $message_type,
                'message_id' => $message_id,
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

    public function lihat($id)
    {
        $surat_office = SuratOffice::find($id);
        $surat_office_berkas = SuratOfficeBerkas::where('surat_office_id',$id)->get();
        if(empty($surat_office) && empty($surat_office_berkas)){
            return response()->json([
                'success' => false,
                'message' => 'Surat Office Tidak Ditemukan'
            ]);
        }
        // if(empty($surat_office)){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Surat Office Tidak Ditemukan'
        //     ]);
        // }
        foreach ($surat_office_berkas as $key => $sob) {
            $departemen = DepartemenDetail::where('id',$sob->departemen_id)->first();
            $file_office[] = [
                'id' => $sob->id,
                'surat_office_id' => $sob->surat_office_id,
                'departemen' => $departemen->departemen->nama_departemen,
                'files' => $sob->files,
                'download' => asset('berkas/'.$departemen->departemen->nama_departemen.'/'.$sob->files),
                'status' => $sob->status,
                // 'extension' => pathinfo($fml->files, PATHINFO_EXTENSION),
                // 'created_at' => Carbon::parse($fml->created_at)->isoFormat('LLL'),
                // 'updated_at' => Carbon::parse($fml->updated_at)->isoFormat('LLL'),
            ];
        }
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $surat_office->id,
                'nomor_surat' => $surat_office->nomor_surat,
                'tanggal' => $surat_office->tanggal,
                'keterangan' => $surat_office->keterangan,
                'pengguna' => $surat_office->pengguna,
                'status' => $surat_office->status,
            ],
            'berkas' => $file_office
        ]);
    }
    public function previews($id)
    {
        $surat_office = SuratOffice::find($id);
        $surat_office_berkas = SuratOfficeBerkas::where('surat_office_id',$id)->get();
        if(empty($surat_office) && empty($surat_office_berkas)){
            return response()->json([
                'success' => false,
                'message' => 'Surat Office Tidak Ditemukan'
            ]);
        }
        foreach ($surat_office_berkas as $key => $sob) {
            $departemen = DepartemenDetail::where('id',$sob->departemen_id)->first();
            $file_office[] = [
                'id' => $sob->id,
                'surat_office_id' => $sob->surat_office_id,
                'departemen' => $departemen->departemen->nama_departemen,
                'files' => $sob->files,
                'remaks' => $sob->remaks,
                'download' => asset('berkas/'.$departemen->departemen->nama_departemen.'/'.$sob->files),
                'status' => $sob->status,
                // 'extension' => pathinfo($fml->files, PATHINFO_EXTENSION),
                // 'created_at' => Carbon::parse($fml->created_at)->isoFormat('LLL'),
                // 'updated_at' => Carbon::parse($fml->updated_at)->isoFormat('LLL'),
            ];
        }
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $surat_office->id,
                'nomor_surat' => $surat_office->nomor_surat,
                'tanggal' => Carbon::parse($surat_office->tanggal)->isoFormat('LL'),
                'keterangan' => $surat_office->keterangan,
                'pengguna' => $surat_office->pengguna,
                'status' => $surat_office->status,
            ],
            'berkas' => $file_office
        ]);
    }

    public function download($id)
    {
        $surat_office_berkas = SuratOfficeBerkas::where('surat_office_id',$id)
                                                ->where('status', 2)
                                                // ->orderBy('id', 'desc')
                                                ->first();

        if(empty($surat_office_berkas)){
            return response()->json([
                'success' => false,
                'message' => 'File Tidak Ditemukan'
            ]);
            // return redirect()->back();
        }

        $departemen = DepartemenDetail::where('id',$surat_office_berkas->departemen_id)->first();
        $file = asset('berkas/'.$departemen->departemen->nama_departemen.'/'.$surat_office_berkas->files);

        // return Storage::disk('public')->download($file);
        return response()->json([
            'success' => true,
            'message' => $surat_office_berkas->files,
            'download' => $file
        ]);
        // return Response::download(asset('berkas/'.$departemen->departemen->nama_departemen.'/'.$surat_office_berkas->files));
    }
}
