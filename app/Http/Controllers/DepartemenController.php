<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Departemen;
use App\Models\DepartemenDetail;
use \Carbon\Carbon;
use Validator;
use DataTables;
use File;
class DepartemenController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->roles == 3){
            return redirect()->back();
        }else{
            if ($request->ajax()) {
                $data = Departemen::all();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('created_at', function($row){
                            return Carbon::parse($row->created_at)->isoFormat('LLLL');
                        })
                        ->addColumn('updated_at', function($row){
                            return Carbon::parse($row->updated_at)->isoFormat('LLLL');
                        })
                        ->addColumn('action', function($row){
                            $btn = '<button type="button" onclick="team(`'.$row->id.'`)" class="btn btn-primary btn-icon">
                                        <i class="fa fa-users"></i> Team
                                    </button>
                                    <button type="button" onclick="buatTeam(`'.$row->id.'`)" class="btn btn-success btn-icon">
                                        <i class="fa fa-plus"></i> Tambah Team
                                    </button>
                                    <button type="button" onclick="edit(`'.$row->id.'`)" class="btn btn-warning btn-icon">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" onclick="hapus(`'.$row->id.'`)" class="btn btn-danger btn-icon">
                                        <i class="fa fa-trash"></i>
                                    </button>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            $data['users'] = User::all();
            return view('backend.departemen.index',$data);
        }
    }

    public function simpan(Request $request)
    {
        $rules = [
            'nama_departemen' => 'required',
        ];

        $messages = [
            'nama_departemen.required'  => 'Departemen wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $input = $request->all();
            $input['id'] = Str::uuid()->toString();
            if (!File::isDirectory(public_path('berkas/'.$request->nama_departemen))) {
                File::makeDirectory(public_path('berkas/'.$request->nama_departemen),0777,true);
            }
            $departemen = Departemen::create($input);

            if($departemen){
                $message_title="Berhasil !";
                $message_content="Departemen ".$input['nama_departemen']." Berhasil Dibuat";
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
        $team = Departemen::find($id);
        if(empty($team)){
            return response()->json([
                'success' => false,
                'message' => 'Team Departemen Tidak Ditemukan'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => $team
        ]);
    }

    public function edit($id)
    {
        $departemen = Departemen::find($id);
        if(empty($departemen)){
            return response()->json([
                'success' => false,
                'message' => 'Team Departemen Tidak Ditemukan'
            ]);
        }

        foreach ($departemen->departemen_detail as $key => $departemen_detail) {
            $data[] = [
                'id' => $departemen_detail->id,
                'departemen_id' => $departemen_detail->departemen->nama_departemen,
                'user_id' =>  $departemen_detail->user->id,
                'user_name' =>  $departemen_detail->user->name,
                'user_isactive' => $departemen_detail->user->is_active
            ];
        }
        return response()->json([
            'success' => true,
            'data' => $departemen,
            'team' => $data
        ]);
    }

    public function team($id)
    {
        $team = Departemen::find($id);
        $teamDetailCek = DepartemenDetail::where('departemen_id',$id)->first();
        $teamDetail = DepartemenDetail::where('departemen_id',$id)
                                        ->whereHas('user', function($query){
                                            $query->where('is_active','!=','0');
                                        })
                                        ->get();
        
        // dd($id);
        if(empty($teamDetailCek)){
            $data[] = null;
        }else{
            foreach ($teamDetail as $key => $td) {
                $data[] = [
                    'id' => $td->id,
                    'departemen_id' => $td->departemen->nama_departemen,
                    'user_id' =>  $td->user->name,
                ];
            }
        }
        return response()->json([
            'success' => true,
            'detail' => $team,
            'data' => $data
        ]);
    }

    public function team_simpan(Request $request)
    {
        $rules = [
            'buat_user_id' => 'required',
        ];

        $messages = [
            'buat_user_id.required'  => 'Team Departemen wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            // $input = $request->all();
            $input['id'] = Str::uuid()->toString();
            $input['departemen_id'] = $request->buat_departemen_id;
            $input['user_id'] = $request->buat_user_id;
            $departemen = DepartemenDetail::create($input);

            if($departemen){
                $message_title="Berhasil !";
                $message_content="Team Departemen Berhasil Dibuat";
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

    public function team_update(Request $request)
    {
        // dd($request->status);

        $rules = [
            'status' => 'required',
        ];

        $messages = [
            'status.required'  => 'Status Team wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $users = User::whereIn('id',$request->user_id)->get();
            foreach ($users as $key => $user) {
                // dd(explode('|',$request->status[$key])[0]);
                User::find(explode('|',$request->status[$key])[0])->update([
                    'is_active' => explode('|',$request->status[$key])[1]
                ]);
            }
            $message_title="Berhasil !";
            $message_content="Team Departemen Berhasil Diupdate";
            $message_type="success";
            $message_succes = true;

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
