<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FileManagers;
use App\Models\FileManagersList;
use App\Models\FileManagersDetails;
use App\Models\FileManagerDisk;
use App\Models\Departemen;
use App\Models\DepartemenDetail;
use App\Models\UserManagement;
use \Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Validator;
use File;

class FileManagersController extends Controller
{

    public function index()
    {
        // $data['file_managers'] = FileManagers::all();

        $data['departemen'] = DepartemenDetail::select('id','departemen_id')->where('user_id',auth()->user()->id)->first();
        $data['cek_departemen'] = Departemen::where('id',$data['departemen']['departemen_id'])->first();
        $data['file_manager_disk'] = FileManagerDisk::where('departemen_id',$data['departemen']['departemen_id'])->first();
        $data['UserManagement'] = UserManagement::where('user_id',auth()->user()->id)->first();
        
        $data['departemens'] = Departemen::all();
        if(empty($data['departemen'])){
            $data['departemen'] = null;
        }
        // $data['file_managers_details'] = FileManagersDetails::all();
        
        //check disk partition
        // $total_disk = disk_total_space('/');
        // $total_disk_size = $total_disk / 1073741824;
        
        // $free_disk = disk_free_space('/');
        // $used_disk = $total_disk - $free_disk;

        // $disk_used_size = $used_disk / 1073741824;
        // $use_disk = round(100 - (($disk_used_size / $total_disk_size) * 100));

        // $diskuse = round(100 - ($use_disk)) . '%';
        
        //disk directory
        $file_size = 0;
        foreach( File::allFiles(public_path('berkas/'.$data['cek_departemen']['nama_departemen'])) as $file)
        {
            $file_size += $file->getSize();
        }
        $total_disk = $data['file_manager_disk']['limit_disk'] * 1024 * 1024 * 1024;
        $total_disk_size = $total_disk / 1073741824;

        $free_disk = $total_disk - $file_size;
        $used_disk = $total_disk - $free_disk;

        $disk_used_size = $used_disk / 1073741824;
        $use_disk = round(100 - (($disk_used_size / $total_disk_size) * 100));

        $diskuse = round(100 - ($use_disk)) . '%';
        // dd($data['cek_departemen']);
        // dd($file_size/(1024*1024*1024));
        // dd(number_format($file_size / 1048576,2));
        
        return view('backend.filemanager.index',$data,compact('diskuse','total_disk_size','disk_used_size'));
    }

    public function berkas()
    {
        $departemens = Departemen::all();
        $status = true;
        foreach ($departemens as $key => $value) {
            $data[] = [
                'id' => $value->id,
                'nama_departemen' => $value->nama_departemen,
                'created_at' => Carbon::parse($value->created_at)->isoFormat('LLL'),
                'updated_at' => Carbon::parse($value->updated_at)->isoFormat('LLL'),
            ];
        }
        return response()->json([
            'success' => $status,
            'data' => $data
        ]);
    }

    // public function berkas()
    // {
    //     $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
    //     $cek_file_managers = FileManagers::where('departemen_id',$departemen->departemen_id)->first();
    //     if(empty($cek_file_managers)){
    //         $data[] = null;
    //         $status = false;
    //     }else{
    //         $file_managers = FileManagers::where('departemen_id',$departemen->departemen_id)->get();
    //         $status = true;
    //         foreach ($file_managers as $key => $value) {
    //             $data[] = [
    //                 'id' => $value->id,
    //                 'departemen_id' => $value->departemen_id,
    //                 'nama_berkas' => $value->nama_berkas,
    //                 'slug' => $value->slug,
    //                 'created_at' => Carbon::parse($value->created_at)->isoFormat('LLL'),
    //                 'updated_at' => Carbon::parse($value->updated_at)->isoFormat('LLL'),
    //             ];
    //         }
    //     }
    //     return response()->json([
    //         'success' => $status,
    //         'data' => $data
    //     ]);
    // }

    // public function subBerkas($id)
    // {
    //     $file_manager = FileManagers::find($id);
    //     $file_managers_detail = FileManagersDetails::where('file_managers_id',$id)->first();
    //     $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();

    //     if(empty($file_managers_detail)){
    //         $file_managers_detail_output[] = null;
    //     }else{
    //         $file_managers_detail = FileManagersDetails::where('file_managers_id',$id)->get();
    //         // $file_managers_detail = FileManagersDetails::where('file_managers_id',$id)->get();
    //         foreach ($file_managers_detail as $key => $value) {
    //             $file_managers_detail_output[] = [
    //                 'id' => $value->id,
    //                 'file_managers_id' => $value->file_managers_id,
    //                 'files' => $value->files,
    //                 'extension' => pathinfo($value->files, PATHINFO_EXTENSION),
    //                 'created_at' => Carbon::parse($value->created_at)->isoFormat('LLL'),
    //                 'size' => File::size(public_path('berkas/'.$departemen->departemen->nama_departemen), $value->files)
    //                 // 'size' => File::size(asset('berkas/'.$departemen->departemen->nama_departemen.'/'.$value->files))
    //             ];
    //         }
    //     }
    //     return response()->json([
    //         'detail' => $file_manager,
    //         'data' => $file_managers_detail_output
    //     ]);
    // }

    public function subBerkas($id)
    {
        $file_managers_list = FileManagersList::where('id',$id)->first();
        $file_managers_cek = FileManagersDetails::where('file_managers_list_id',$id)->first();
        $file_managers_detail = FileManagersDetails::where('file_managers_list_id',$id)->get();
        
        $user = auth()->user()->id;
        $departemen = DepartemenDetail::where('user_id',$user)->first();
        if($user == $departemen->user_id){
            $cek_user = true;
        }else{
            $cek_user = false;
        }

        if(empty($file_managers_cek)){
            $file_ml = null;
        }
        else{
            $user = auth()->user()->id;
            $departemen = DepartemenDetail::where('departemen_id',$file_managers_cek->file_manager_list->departemen_id)->first();
            if($user == $departemen->user_id){
                $cek_user = true;
            }else{
                $cek_user = false;
            }
            foreach ($file_managers_detail as $key => $fml) {
            $file_ml[] = [
                'id' => $fml->id,
                'file_managers_id' => $fml->departemen_id,
                'files' => $fml->files,
                'user' => $cek_user,
                'extension' => pathinfo($fml->files, PATHINFO_EXTENSION),
                'created_at' => Carbon::parse($fml->created_at)->isoFormat('LLL'),
                'updated_at' => Carbon::parse($fml->updated_at)->isoFormat('LLL'),
            ];
            }
        }
        return response()->json([
            'success' => true,
            'user_departemen' => $cek_user,
            'detail' => $file_managers_list,
            'data' => $file_ml,
        ]);
    }

    public function unduh($id)
    {
        $file_manager = FileManagersDetails::find($id);
        // $file_manager = FileManagersDetails::where('id',$id)->first();
        // dd($file_managers_detail);
        if(empty($file_manager)){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
        $file = public_path('berkas/'.$file_manager->file_manager_list->departemen->nama_departemen.'/'.$file_manager->file_manager_list->sub_nama_berkas.'/'.$file_manager->files);
        return response()->download($file);
        // return response()->json([
        //     'success' => false,
        //     'message' => 'Data tidak ditemukan'
        // ]);
    }

    public function detailSubKategori($id)
    {
        $file_manager = FileManagers::find($id);
        if(empty($file_manager)){
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $file_manager->id,
                'departemen_id' => $file_manager->departemen->nama_departemen,
                'nama_berkas' => $file_manager->nama_berkas,
                'slug' => $file_manager->slug
            ]
        ]);
    }

    public function detailSubFolderSimpan(Request $request)
    {
        $rules = [
            'buatSubFolder' => 'required',
        ];
        $messages = [
            'buatSubFolder.required'  => 'Sub Folder wajib diisi.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()){
            $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
            $input['id'] = Str::uuid()->toString();
            $input['departemen_id'] = $departemen->departemen_id;
            $input['sub_nama_berkas'] = $request->buatSubFolder;
            $input['slug'] = Str::slug($request->buatSubFolder);
            if (!File::isDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen.'/'.$request->buatSubFolder))) {
                File::makeDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen.'/'.$request->buatSubFolder),0777,true);
            }
            $file_managers_list = FileManagersList::create($input);

            if($file_managers_list){
                $message_title="Berhasil !";
                $message_content="Berkas ".$request->buat_sub_nama_berkas." Berhasil Dibuat";
                $message_type="success";
                $message_succes = true;
                $message_id = $departemen->departemen->id;
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

    public function detailSubKategoriSimpan(Request $request)
    {
        $rules = [
            'files' => 'required',
        ];
        $messages = [
            'files.required'  => 'Upload File wajib diisi.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
            $file_manager_disk = FileManagerDisk::where('departemen_id',$departemen['departemen_id'])->first();
            
            $file_size = 0;
            foreach( File::allFiles(public_path('berkas/'.$departemen->departemen->nama_departemen)) as $file)
            {
                $file_size += $file->getSize();
            }
            $total_disk = $file_manager_disk['limit_disk'] * 1024 * 1024 * 1024;
            $total_disk_size = $total_disk / 1073741824;

            $free_disk = $total_disk - $file_size;
            $used_disk = $total_disk - $free_disk;

            $disk_used_size = $used_disk / 1073741824;
            $use_disk = round(100 - (($disk_used_size / $total_disk_size) * 100));

            $diskuse = round(100 - ($use_disk)) . '%';

            if($diskuse >= '100%'){
                $message_title="Memory Penuh !";
                $message_content="Silahkan hapus file terlebih dahulu";
                $message_type="danger";
                $message_succes = false;
                $message_id = $request->buat_file_managers_id;
            }else{
                $file = $request->file('files');
                if (!File::isDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen.'/'.$request->buatKategoriFolder))) {
                    File::makeDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen.'/'.$request->buatKategoriFolder),0777,true);
                }
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('berkas/'.$departemen->departemen->nama_departemen.'/'.$request->buatKategoriFolder), $fileName);
                
                $input['id'] = Str::uuid()->toString();
                $input['file_managers_list_id'] = $request->buat_file_managers_id;
                // $input['sub_nama_berkas'] = $request->buat_sub_nama_berkas;
                // $input['slug'] = Str::slug($request->buat_sub_nama_berkas);
                $input['files'] = $fileName;
    
                $file_manager_detail = FileManagersDetails::create($input);
    
                if($file_manager_detail){
                    $message_title="Berhasil !";
                    $message_content="Berkas ".$request->buat_sub_nama_berkas." Berhasil Dibuat";
                    $message_type="success";
                    $message_succes = true;
                    $message_id = $input['file_managers_list_id'];
                }
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

    public function delete($id)
    {
        $file_manager = FileManagersDetails::find($id);
        if(empty($file_manager)){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        if (File::exists(public_path('berkas/'.$file_manager->file_manager_list->departemen->nama_departemen.'/'.$file_manager->file_manager_list->sub_nama_berkas.'/'.$file_manager->files))) {
            File::delete(public_path('berkas/'.$file_manager->file_manager_list->departemen->nama_departemen.'/'.$file_manager->file_manager_list->sub_nama_berkas.'/'.$file_manager->files),0777,true);
        }
        // dd('berkas/'.$file_manager->file_manager->departemen->nama_departemen.'/'.$file_manager->file_manager->nama_berkas.'/'.$file_manager->files);
        $file_manager->delete();
        if($file_manager){
            $message_title="Berhasil !";
            $message_content=$file_manager->files." Berhasil Dihapus";
            $message_type="success";
            $message_succes = true;
            $message_id = $file_manager->file_manager_list->id;
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

    public function viewPdf($id)
    {
        $file_manager = FileManagersDetails::find($id);
        // $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
        // $pdf = Pdf::loadFile(public_path('berkas/'.$departemen->departemen->nama_departemen.'/'.$file_manager->files));
        $pdf = asset('public/berkas/'.$file_manager->file_manager_list->departemen->nama_departemen.'/'.$file_manager->file_manager_list->sub_nama_berkas.'/'.$file_manager->files);
        // dd('berkas/'.$file_manager->file_manager_list->departemen->nama_departemen.'/'.$file_manager->file_manager_list->sub_nama_berkas.'/'.$file_manager->files);
        // dd('berkas/'.$);
        // return $pdf->stream();
        // return response()->file($pdf);

        return response()->json([
            'title' => $file_manager->files,
            'url' => 'https://view.officeapps.live.com/op/embed.aspx?src='.rawurlencode($pdf),
            // 'url' => $pdf,
        ]);
    }

    public function subBerkasDetail($id,$id_sub)
    {
        $file_managers_detail = FileManagersDetails::where('file_managers_list_id',$id_sub)->get();
        return response()->json([
            'success' => true,
            'data' => $file_managers_detail
        ]);
    }

    public function kategori(Request $request)
    {
        $rules = [
            'buat_nama_berkas' => 'required',
        ];
        $messages = [
            'buat_nama_berkas.required'  => 'Nama Berkas wajib diisi.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();
            $input['id'] = Str::uuid()->toString();
            $input['departemen_id'] = $departemen->departemen->id;
            $input['nama_berkas'] = $request->buat_nama_berkas;
            $input['slug'] = Str::slug($request->buat_nama_berkas);
            if (!File::isDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen.'/'.$request->buat_nama_berkas))) {
                File::makeDirectory(public_path('berkas/'.$departemen->departemen->nama_departemen.'/'.$request->buat_nama_berkas),0777,true);
            }
            $file_manager = FileManagers::create($input);

            if($file_manager){
                $message_title="Berhasil !";
                $message_content="Berkas ".$request->nama_berkas." Berhasil Dibuat";
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

}
