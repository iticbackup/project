<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\FileManagers;
use App\Models\FileManagersList;
use App\Models\FileManagersDetails;
use App\Models\Departemen;
use App\Models\DepartemenDetail;
use \Carbon\Carbon;
use Validator;

class FileManagersController extends Controller
{
    public function index()
    {
        $data['file_managers'] = FileManagers::all();
        $data['departemen'] = DepartemenDetail::select('id','departemen_id')->where('user_id',auth()->user()->id)->first();
        // $data['file_managers_details'] = FileManagersDetails::all();
        return view('backend.filemanager.index',$data);
    }

    public function berkas()
    {
        $file_managers = FileManagers::all();
        foreach ($file_managers as $key => $value) {
            $data[] = [
                'id' => $value->id,
                'departemen_id' => $value->departemen_id,
                'nama_berkas' => $value->nama_berkas,
                'slug' => $value->slug,
                'created_at' => Carbon::parse($value->created_at)->isoFormat('LLL'),
                'updated_at' => Carbon::parse($value->updated_at)->isoFormat('LLL'),
            ];
        }
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    public function subBerkas($id)
    {
        $file_manager = FileManagers::find($id);
        $file_managers_cek = FileManagersList::where('file_managers_id',$file_manager->id)->first();
        $file_managers_list = FileManagersList::where('file_managers_id',$file_manager->id)->get();
        
        $file_managers_detail = FileManagersList::where('file_managers_id',$id)->first();
        $file_managers_detail_cek = FileManagersDetails::where('file_managers_list_id',$file_managers_detail->id)->first();
        $file_managers_detail_list = FileManagersDetails::where('file_managers_list_id',$file_managers_detail->id)->get();
        
        if(empty($file_managers_detail_cek)){
            $dataFmdl[] = null;
        }else{
            foreach ($file_managers_detail_list as $key => $fmdl) {
                $dataFmdl[] = [
                    'id' => $fmdl->id,
                    'file_managers_list_id' => $fmdl->file_managers_list_id,
                    'nama_file' => $fmdl->nama_file,
                    'slug' => $fmdl->slug,
                    'created_at' => Carbon::parse($fmdl->created_at)->isoFormat('LL'),
                    'updated_at' => Carbon::parse($fmdl->updated_at)->isoFormat('LL'),
                ];
            }
        }

        if(empty($file_managers_cek)){
            $dataFml[] = null;
        }else{
            foreach ($file_managers_list as $key => $fml) {
                $dataFml[] = [
                    'id' => $fml->id,
                    'file_managers_id' => $fml->file_managers_id,
                    'sub_nama_berkas' => $fml->sub_nama_berkas,
                    'slug' => $fml->slug,
                    'created_at' => Carbon::parse($fml->created_at)->isoFormat('LL'),
                    'updated_at' => Carbon::parse($fml->updated_at)->isoFormat('LL'),
                    'file_managers_detail_list' => $dataFmdl
                ];
            }
        }
        // foreach ($file_managers_detail_list as $key => $fmdl) {
        //     if (empty($fmdl)) {
        //         $dataFmdl[] = [
        //             'id' => null,
        //             'file_managers_list_id' => null,
        //             'nama_file' => null,
        //             'slug' => null,
        //             'created_at' => null,
        //             'updated_at' => null,
        //         ];
        //     }else{
        //         $dataFmdl[] = [
        //             'id' => $fmdl->id,
        //             'file_managers_list_id' => $fmdl->file_managers_list_id,
        //             'nama_file' => $fmdl->nama_file,
        //             'slug' => $fmdl->slug,
        //             'created_at' => Carbon::parse($fmdl->created_at)->isoFormat('LL'),
        //             'updated_at' => Carbon::parse($fmdl->updated_at)->isoFormat('LL'),
        //         ];
        //     }
        // }
        
        return response()->json([
            'success' => true,
            'file_manager' => $file_manager,
            'file_managers_list' => $dataFml,
            'file_managers_detail' => $file_managers_detail,
            'file_managers_detail_list' => $dataFmdl
        ]);
        // return response()->json([
        //     'success' => true,
        //     'file_manager' => $file_manager,
        //     'file_managers_list' => $dataFml,
        //     'file_managers_detail' => $file_managers_detail,
        //     'file_managers_detail_list' => $dataFmdl
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
                'nama_berkas' => $file_manager->nama_berkas
            ]
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
            $input['id'] = Str::uuid()->toString();
            $input['departemen_id'] = $request->buat_nama_departemen;
            $input['nama_berkas'] = $request->buat_nama_berkas;
            $input['slug'] = Str::slug($request->buat_nama_berkas);
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

    public function detailSubKategoriSimpan(Request $request)
    {
        $rules = [
            'buat_sub_nama_berkas' => 'required',
        ];
        $messages = [
            'buat_sub_nama_berkas.required'  => 'Sub Folder wajib diisi.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->passes()) {
            $input['id'] = Str::uuid()->toString();
            $input['file_managers_id'] = $request->buat_file_managers_id;
            $input['sub_nama_berkas'] = $request->buat_sub_nama_berkas;
            $input['slug'] = Str::slug($request->buat_sub_nama_berkas);
            $file_manager_list = FileManagersList::create($input);

            if($file_manager_list){
                $message_title="Berhasil !";
                $message_content="Berkas ".$request->buat_sub_nama_berkas." Berhasil Dibuat";
                $message_type="success";
                $message_succes = true;
                $message_id = $input['file_managers_id'];
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
}
