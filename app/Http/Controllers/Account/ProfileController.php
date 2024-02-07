<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->template = 'account.';
        $this->active = 'Profil Saya';
        $this->route = 'profile';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->user();
        $active = $this->active;
        $route = $this->route;

        return view($this->template.$route.'-index', compact('data','active','route'));
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
          'name.required' => 'Mohon masukkan nama lengkap Anda',
          'name.string' => 'Pastikan nama lengkap hanya mengandung karakter',
          'name.max' => 'Pastikan nama tidak lebih dari 255 karakter',
        ];

        $this->validate($request, [
          'name' => 'required|string|max:255',
        ],$messages);

        $item = $request->user();
        $item->name = $request->name;
        $item->save();

        Session::flash('success','Profil Anda berhasil diperbaharui');

        return redirect()->route($this->route.'.index');
    }
}
