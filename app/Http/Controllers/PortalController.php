<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departemen;
use App\Models\DepartemenDetail;
use App\Models\Portal;
use App\Models\PortalDepartemen;
use \Carbon\Carbon;
use Validator;
use DataTables;
use File;

class PortalController extends Controller
{
    public function index()
    {
        // $data['portals'] = [
        //     [
        //         'title' => 'Surat Office',
        //         'link' => route('home'),
        //         'kategori' => 'All Departemen',
        //         'images' => asset('portal/assets/images/icons/contract.png'),
        //         'color' => 'full-type',
        //         'akses' => 'All'
        //     ],
        //     [
        //         'title' => 'Payroll',
        //         'link' => '#',
        //         'kategori' => 'HRGA',
        //         'images' => asset('portal/assets/images/icons/payday.png'),
        //         'color' => 'internship-type',
        //         'akses' => 'HRGA'
        //     ],
        //     [
        //         'title' => 'Absensi',
        //         'link' => 'http://192.168.1.2/absensi/absensi',
        //         'kategori' => 'HRGA',
        //         'images' => asset('portal/assets/images/icons/deadline.png'),
        //         'color' => 'internship-type',
        //         'akses' => 'HRGA'
        //     ],
        //     [
        //         'title' => 'HRD Labs',
        //         'link' => 'http://192.168.1.2/HRDLabs/admin/',
        //         'kategori' => 'HRGA',
        //         'images' => asset('portal/assets/images/icons/id-card.png'),
        //         'color' => 'internship-type',
        //         'akses' => 'HRGA'
        //     ],
        // ];
        // $departemen = DepartemenDetail::where('user_id',auth()->user()->id)->first();

        // if($departemen->departemen->nama_departemen == 'HRGA' || $departemen->departemen->nama_departemen == 'IT'){
        //     $data['akses'] = true;
        //     $data['departemen'] = $departemen->departemen->nama_departemen;
        // }else{
        //     $data['akses'] = false;
        //     $data['departemen'] = null;
        // }
        $portals = Portal::all();
        foreach ($portals as $key => $portal) {
            $data['portals'][] = [
                'id' => $portal->id,
                'title' => $portal->title,
                'link' => $portal->link,
                'images' => asset('public/portal/assets/images/icons/'.$portal->images)
            ];
            $data['portal_departemens'] = PortalDepartemen::where('portal_id',$portal->id)->get();
        }
        // dd($data);
        return view('portal.index',$data);
    }

    public function payrol()
    {
        $data['links'] = 'http://192.168.1.2/absensi/absensi';
        return view('portal.payroll.index',$data);
    }

    public function b_portal(Request $request)
    {
        if(auth()->user()->roles == 1){
            if($request->ajax()){
                $data = Portal::all();
                return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('images', function($row){
                                    return "<img src='".url('public/portal/assets/images/icons/'.$row->images)."' width='100' />";
                                })
                                ->addColumn('action', function($row){
                                    $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                                    $btn = $btn.'<a href="'.route('portal.detail.buat',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                                    $btn = $btn.'<i class="fas fa-key"></i> Akses';
                                    $btn = $btn.'</a>';
                                    $btn = $btn.'<a href="#" class="btn btn-warning btn-icon">';
                                    $btn = $btn.'<i class="fas fa-edit"></i> Edit';
                                    $btn = $btn.'</a>';
                                    $btn = $btn.'<a href="#" class="btn btn-danger btn-icon">';
                                    $btn = $btn.'<i class="fas fa-trash"></i> Delete';
                                    $btn = $btn.'</a>';
                                    $btn = $btn.'</div>';
                                    return $btn;
                                })
                                ->rawColumns(['action','images'])
                                ->make(true);
            }
            return view('backend.portal.index');
        }else{
            return redirect()->back();
        }
    }

    public function b_simpan(Request $request)
    {
        $rules = [
            'title' => 'required',
            'link' => 'required',
            'images' => 'required',
        ];
        $messages = [
            'title.required'  => 'Title wajib diisi.',
            'link.required'  => 'Url wajib diisi.',
            'images.required'   => 'Icon wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->passes()){
            $input = $request->all();
            $input['link'] = $request->link;
            $image = $request->file('images');
            $img = \Image::make($image->path());
            $img = $img->encode('webp', 75);
            $input['images'] = time().'.webp';
            $img->save(public_path('portal/assets/images/icons/').$input['images']);

            $portal = Portal::create($input);

            if($portal){
                $message_title="Berhasil !";
                $message_content="Portal ".$input['title']." Berhasil Dibuat";
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

    public function b_portal_detail(Request $request,$id)
    {
        $data['portal'] = Portal::find($id);
        if(empty($data['portal'])){
            return redirect()->back();
        }

        if($request->ajax()){
            $data = PortalDepartemen::where('portal_id',$id)->get();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('portal_id', function($row){
                                return $row->portal->title;
                            })
                            ->addColumn('departemen_id', function($row){
                                return $row->departemen->nama_departemen;
                            })
                            ->addColumn('action', function($row){
                                $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                                // $btn = $btn.'<a href="'.route('portal.detail',['id' => $row->id]).'" class="btn btn-primary btn-icon">';
                                // $btn = $btn.'<i class="fas fa-key"></i> Akses';
                                // $btn = $btn.'</a>';
                                // $btn = $btn.'<a href="#" class="btn btn-warning btn-icon">';
                                // $btn = $btn.'<i class="fas fa-edit"></i> Edit';
                                // $btn = $btn.'</a>';
                                $btn = $btn.'<a href="#" class="btn btn-danger btn-icon">';
                                $btn = $btn.'<i class="fas fa-trash"></i> Delete';
                                $btn = $btn.'</a>';
                                $btn = $btn.'</div>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }

        $data['departemens'] = Departemen::all();
        // $data['portal_departemens'] = PortalDepartemen::where('portal_id',$id)->get();
        // return $portal;
        return view('backend.portal.akses',$data);
        // return view('backend.portal.akses2',$data);
    }

    public function b_portal_detail_buat($id)
    {
        $data['portal'] = Portal::find($id);
        if(empty($data['portal'])){
            return redirect()->back();
        }
        return view('backend.portal.akses2',$data);
    }

    public function b_portal_akses_simpan(Request $request,$id)
    {
        $rules = [
            'departemen_id' => 'required',
            'color' => 'required',
        ];
        $messages = [
            'departemen_id.required'  => 'Departemen wajib diisi.',
            'color.required'  => 'Warna wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->passes()){
            $input = $request->all();
            $input['portal_id'] = $id;
            $portal_departemen = PortalDepartemen::create($input);

            if($portal_departemen){
                $message_title="Berhasil !";
                $message_content="Portal Departemen Berhasil Dibuat";
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
