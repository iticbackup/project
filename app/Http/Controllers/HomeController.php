<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DepartemenDetail;
use App\Models\Departemen;
use App\Models\FileManagerDisk;
use App\Models\SuratOffice;
use App\Models\UserManagement;
use File;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $data['user'] = User::find(auth()->user()->id);
        // $data['departemen'] = DepartemenDetail::where('user_id',auth()->user()->id)->first();
        // $data['departemen_details'] = DepartemenDetail::where('departemen_id',$data['departemen']['departemen']['id'])
        //                             ->where('user_id','!=',auth()->user()->id)
        //                             ->get();
        // // dd($data['departemen_details']);
        // $data['cek_departemen'] = Departemen::where('id',$data['departemen']['departemen_id'])->first();
        // $data['file_manager_disk'] = FileManagerDisk::where('departemen_id',$data['departemen']['departemen_id'])->first();
        
        // $file_size = 0;
        // foreach( File::allFiles(public_path('berkas/'.$data['cek_departemen']['nama_departemen'])) as $file)
        // {
        //     $file_size += $file->getSize();
        // }
        // $total_disk = $data['file_manager_disk']['limit_disk'] * 1024 * 1024 * 1024;
        // $total_disk_size = $total_disk / 1073741824;

        // $free_disk = $total_disk - $file_size;
        // $used_disk = $total_disk - $free_disk;

        // $disk_used_size = $used_disk / 1073741824;
        // $use_disk = round(100 - (($disk_used_size / $total_disk_size) * 100));

        // $diskuse = round(100 - ($use_disk)) . '%';
        // $diskuses = round(100 - ($use_disk));

        // if($data['departemen']['departemen']['nama_departemen'] == 'Corsec' || $data['departemen']['departemen']['nama_departemen'] == 'IT'){
        //     $data['surat_offices'] = SuratOffice::paginate(10);
        // }else{
        //     $data['surat_offices'] = SuratOffice::where('pengguna',$data['departemen']['departemen']['nama_departemen'])->paginate(10);
        // }
        // return view('backend.home.index',$data,compact('diskuse','diskuses','total_disk_size','disk_used_size'));
        if(auth()->user()->roles != 3){
            $data['user'] = User::find(auth()->user()->id);
            $data['departemen'] = DepartemenDetail::where('user_id',auth()->user()->id)
                                                    ->first();
            $data['departemen_details'] = DepartemenDetail::where('departemen_id',$data['departemen']['departemen']['id'])
                                        ->whereHas('user', function($query){
                                            $query->where('is_active','!=','0');
                                        })
                                        ->where('user_id','!=',auth()->user()->id)
                                        ->get();
            // dd($data['departemen_details']);
            $data['cek_departemen'] = Departemen::where('id',$data['departemen']['departemen_id'])->first();
            $data['file_manager_disk'] = FileManagerDisk::where('departemen_id',$data['departemen']['departemen_id'])->first();
            
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
            $diskuses = round(100 - ($use_disk));
    
            if($data['departemen']['departemen']['nama_departemen'] == 'Corsec' || $data['departemen']['departemen']['nama_departemen'] == 'IT'){
                $data['surat_offices'] = SuratOffice::paginate(10);
            }else{
                $data['surat_offices'] = SuratOffice::where('pengguna',$data['departemen']['departemen']['nama_departemen'])->paginate(10);
            }
            // dd($data);
            // $data['user_management'] = UserManagement::find(auth()->user()->roles);
    
            return view('backend.home.index',$data,compact('diskuse','diskuses','total_disk_size','disk_used_size'));
            // return view('backend.home.index',$data);
    
            // return view('home');
        }else{
            return redirect()->route('inventaris.scan');
        }
    }
}
