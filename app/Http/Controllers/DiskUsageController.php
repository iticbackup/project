<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Departemen;
use App\Models\DepartemenDetail;
use App\Models\FileManagerDisk;
use App\Notifications\DiskManagemenNotification;
use \Carbon\Carbon;
use Validator;
use DataTables;
use File;
use Notification;

class DiskUsageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FileManagerDisk::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('departemen_id', function($row){
                        return $row->departemen->nama_departemen;
                    })
                    ->addColumn('limit_disk', function($row){
                        return $row->limit_disk.' GB';
                    })
                    ->addColumn('disk_storage', function($row){
                        $file_size = 0;
                        foreach( File::allFiles(public_path('berkas/'.$row->departemen->nama_departemen)) as $file)
                        {
                            $file_size += $file->getSize();
                        }
                        
                        //disk directory
                        $total_disk = $row->limit_disk * 1024 * 1024 * 1024;
                        $total_disk_size = $total_disk / 1073741824;

                        $free_disk = $total_disk - $file_size;
                        $used_disk = $total_disk - $free_disk;

                        $disk_used_size = $used_disk / 1073741824;
                        $use_disk = round(100 - (($disk_used_size / $total_disk_size) * 100));

                        $diskuse = round(100 - ($use_disk)) . '%';
                        //end disk directory

                        $disk = '<div class="card">';

                        $disk = $disk.'<div class="card-body">';

                        $disk = $disk.'<small class="float-end">'.$diskuse.'</small>';
                        $disk = $disk.'<h6 class="mt-0">'.round($disk_used_size,2).' GB / '.round($total_disk_size,2).' GB Used'.'</h6>';

                        $disk = $disk.'<div class="progress" style="height: 5px;">';
                        
                        if($diskuse >= '90 %'){
                            $disk = $disk.'<div class="progress-bar bg-danger" role="progressbar" style="width:'.$diskuse.';" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100">'.'</div>';
                        }else{
                            $disk = $disk.'<div class="progress-bar bg-success" role="progressbar" style="width:'.$diskuse.';" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100">'.'</div>';
                        }

                        $disk = $disk.'</div>';

                        $disk = $disk.'</div>';

                        $disk = $disk.'</div>';
                        return $disk;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<button type="button" onclick="edit(`'.$row->id.'`)" class="btn btn-warning btn-icon">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" onclick="hapus(`'.$row->id.'`)" class="btn btn-danger btn-icon">
                                    <i class="fa fa-trash"></i>
                                </button>';
                        return $btn;
                    })
                    ->rawColumns(['action','disk_storage'])
                    ->make(true);
        }
        $data['departemens'] = Departemen::all();
        return view('backend.filemanager.disk_usage.index',$data);
    }

    public function simpan(Request $request)
    {
        $rules = [
            'departemen_id' => 'required',
        ];

        $messages = [
            'departemen_id.required'  => 'Departemen wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input = $request->all();
            $input['id'] = Str::uuid()->toString();
            $departemen = DepartemenDetail::where('departemen_id',$request->departemen_id)->first();
            
            $offerData = [
                // 'jumlah' => $lembur->total_gaji,
                'title' => 'Disk Management '.$departemen->departemen->nama_departemen,
                'message' => 'Penyimpanan '.$departemen->departemen->nama_departemen.' berhasil dibuat',
                'url' => 'file-managers',
                'icon' => 'database',
                'color_icon' => 'success'
            ];
            $users = User::where('id',$departemen->user->id)->get();
            foreach ($users as $key => $user) {
                Notification::send($user, new DiskManagemenNotification($offerData));
            }
            $file_manager_disk = FileManagerDisk::create($input);

            if($file_manager_disk){
                $message_title="Berhasil !";
                $message_content="Disk Management Berhasil Dibuat";
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

    public function detail($id)
    {
        $file_manager_disk = FileManagerDisk::find($id);
        if(empty($file_manager_disk)){
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $file_manager_disk->id,
                'departemen' => $file_manager_disk->departemen->nama_departemen,
                'departemen_id' => $file_manager_disk->departemen_id,
                'limit_disk' => $file_manager_disk->limit_disk,
                'status' => $file_manager_disk->status,
            ]
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'edit_departemen_id'  => 'required',
            'edit_limit_disk'  => 'required',
        ];
 
        $messages = [
            'edit_departemen_id.required'  => 'Departemen wajib diisi.',
            'edit_limit_disk.required'  => 'Limit Disk wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            // $input = $request->all();
            $input['departemen_id'] = $request->edit_departemen_id;
            $input['limit_disk'] = $request->edit_limit_disk;
            $departemen = DepartemenDetail::where('departemen_id',$request->edit_departemen_id)->first();
            // dd($departemen);
            $offerData = [
                'title' => 'Penyimpanan '.$departemen->departemen->nama_departemen,
                'message' => 'Penyimpanan '.$departemen->departemen->nama_departemen.' berhasil ditambah',
                // 'jumlah' => $lembur->total_gaji,
                'url' => 'file-managers',
                'icon' => 'database',
                'color_icon' => 'success'
            ];
            
            // $users1 = User::where('id',$departemen->user->id)->first();
            // dd($users1);

            $departemen_user = DepartemenDetail::where('departemen_id',$request->edit_departemen_id)->get();
            foreach ($departemen_user as $key => $du) {
                # code...
                $users = User::where('id',$du->user_id)->first();
                Notification::send($users, new DiskManagemenNotification($offerData));
            }

            // $users = User::where('id',$departemen->user->id)->get();
            // foreach ($users as $key => $user) {
            //     Notification::send($user, new DiskManagemenNotification($offerData));
            // }
            $file_manager_disk = FileManagerDisk::find($request->edit_file_manager_disk_id)->update($input);

            if($file_manager_disk){
                $message_title="Berhasil !";
                $message_content="Disk Management Berhasil Update";
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
