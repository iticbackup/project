<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartemenDetail;
use App\Models\User;
use Hash;
use Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = User::find(auth()->user()->id);
        $data['departemen_detail'] = DepartemenDetail::where('user_id',auth()->user()->id)->first();
        return view('backend.profile.index',$data);
    }

    public function update_pswd(Request $request)
    {
        $rules = [
            'username' => 'required',
            'name' => 'required',
            'current_password' => 'required',
            'password' => 'required',
        ];
 
        $messages = [
            'username.required'  => 'Username wajib diisi.',
            'name.required'  => 'Nama wajib diisi.',
            'current_password.required'   => 'Password Lama wajib diisi.',
            'password.required'   => 'Password User wajib diisi.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {
            $user = User::find(auth()->user()->id);
            // dd($user->password);
            if(Hash::check($request->current_password, $user->password)){
                $user->password = Hash::make($request->password);
                $user->update();
                $array_message = array(
                    'success' => true,
                    'message_title' => "Data Berhasil Diupdate!",
                    'message_content' => "-",
                    'message_type' => "success",
                );
                return response()->json($array_message);
                // $input['password'] = Hash::make($request->password);
                // $user = User::find(auth()->user()->id)->update($input);
                // if($user){
                //     $message_title="Berhasil !";
                //     $message_content= "Password ".$user->name." Berhasil Diubah";
                //     $message_type="success";
                //     $message_succes = true;

                //     $array_message = array(
                //         'success' => $message_succes,
                //         'message_title' => $message_title,
                //         'message_content' => $message_content,
                //         'message_type' => $message_type,
                //     );

                //     return response()->json($array_message);
                // }
            }else{
                $array_message = array(
                    'success' => false,
                    'message_title' => "Data Tidak Berhasil Diupdate !",
                    'message_content' => "-",
                    'message_type' => "danger",
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
}
