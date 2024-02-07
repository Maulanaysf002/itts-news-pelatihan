<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use Session;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->template = 'account.';
        $this->active = 'Ubah Sandi';
        $this->route = 'change-password';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = $this->active;
        $route = $this->route;

        return view($this->template.$route.'-index', compact('active','route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $messages = [
          'old_pass.required' => 'Mohon masukkan sandi lama Anda',
          'new_pass.required' => 'Mohon masukkan sandi baru Anda',
          'new_pass.confirmed' => 'Sandi baru Anda harus dikonfirmasi',
          'new_pass.min' => 'Minimal terdiri dari 8 karakter',
          'new_pass.different' => 'Sandi baru harus berbeda dengan sandi lama'
        ];

        $this->validate($request, [
          'old_pass' => 'required',
          'new_pass' => 'required|string|confirmed|min:8|different:old_pass'
        ],$messages);

        $oldPassCheck = Hash::check($request->old_pass, $request->user()->password);
        $currPassCheck = Hash::check($request->new_pass, $request->user()->password);

        if($currPassCheck) Session::flash('danger','Sandi baru harus berbeda dengan sandi lama');
        else{
            if($oldPassCheck){
                $user = $request->user();
                $user->password = bcrypt($request->new_pass);
                $user->save();

                Session::flash('success','Sandi berhasil diperbaharui');
            }
            else Session::flash('danger','Mohon periksa kembali sandi lama Anda');
        }

        return redirect()->route($this->route.'.index');
    }
}
