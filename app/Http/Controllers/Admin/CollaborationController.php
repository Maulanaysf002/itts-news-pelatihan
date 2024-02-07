<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Collaboration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CollaborationController extends Controller
{
  protected $active;
  protected $route;
  protected $view;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->active = 'Kolaborasi';
    $this->view = 'admin.collaboration';
    $this->route = 'admin.training.collaboration';
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    // moderator
    $data = Collaboration::all();

    $active = $this->active;
    $route = $this->route;
    $view = $this->view;

    return view($this->view . '-index', compact('active', 'route', 'data'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $messages = [
      'name.required' => 'Mohon tuliskan nama speaker',
      'logo.file' => 'Pastikan logo adalah berkas yang valid',
      'logo.max' => 'Ukuran logo yang boleh diunggah maksimum 250 KB',
      'logo.mimes' => 'Pastikan logo yang diunggah berekstensi .jpg, .jpeg, .png, atau .webp',
      'logo.dimensions' => 'Pastikan logo yang diunggah beresolusi minimum 64x64 px',
    ];

    $this->validate($request, [
      'name' => 'required',
      'logo' => 'file|max:250|mimes:jpg,jpeg,png,webp|dimensions:min_width=64,min_height=64',
    ], $messages);

    $speaker = Collaboration::where([
      'name' => $request->name,
    ]);

    if ($speaker->count() < 1) {
      $item = new Collaboration();
      $item->name = $request->name;
      $item->save();
      $item->fresh();

      if ($request->file('logo') && $request->file('logo')->isValid()) {
        // Move tips logo to public
        $file = $request->file('logo');
        $logo = $item->id . '_' . time() . '_logo.' . $file->getClientOriginalExtension();
        $file->move('img/collaboration/',  $logo);
      }

      $item->logo = isset($logo) ? $logo : null;
      $item->save();

      Session::flash('success', 'Data ' . $item->prefixes . ' ' . $item->name . ' ' . $item->suffixes . ' berhasil ditambahkan');
    } else {
      $speaker = $speaker->first();
      Session::flash('danger', 'Data ' . $speaker->nameWithTitle . ' sudah pernah ditambahkan');
    }

    return redirect()->route($this->route . '.index');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Request $request)
  {
    $data = Collaboration::find($request->id);
    if ($data) {

      $active = $this->active;
      $route = $this->route;
      $view = $this->view;

      return view($this->view . '-edit', compact('data', 'active', 'route'));
    } else return "Ups, tidak dapat memuat data";
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $messages = [
      'editName.required' => 'Mohon tuliskan nama peserta',
      'editInstitution.required' => 'Mohon tuliskan nama Institusi',
      'editLogo.file' => 'Pastikan logo adalah berkas yang valid',
      'editLogo.max' => 'Ukuran logo yang boleh diunggah maksimum 250 KB',
      'editLogo.mimes' => 'Pastikan logo yang diunggah berekstensi .jpg, .jpeg, .png, atau .webp',
      'editLogo.dimensions' => 'Pastikan logo yang diunggah beresolusi minimum 64x64 px',
    ];

    $this->validate($request, [
      'editName' => 'required',
      'editLogo' => 'file|max:250|mimes:jpg,jpeg,png,webp|dimensions:min_width=64,min_height=64'
    ], $messages);

    $item = Collaboration::where('id', $request->id)->first();
    $nameExist = Collaboration::where([
      'name' => $request->editName,
    ])->where('id', '!=', $request->id);

    if ($item && $nameExist->count() < 1) {

      if ($request->file('editLogo') && $request->file('editLogo')->isValid()) {
        // Delete service logo from public
        if (File::exists($item->logoPath)) {
          File::delete($item->logoPath);
        }

        // Move service logo to public
        $file = $request->file('editLogo');
        $logo = $item->id . '_' . time() . '_logo.' . $file->getClientOriginalExtension();
        $file->move('img/collaboration/', $logo);
      }

      $old = $item->name;
      $item->name = $request->editName;
      $item->logo  = isset($logo) ? $logo : $item->logo;
      $item->save();
      $item->fresh();

      Session::flash('success', 'Data ' . $old . ' berhasil diubah' . ($old != $item->name ? ' menjadi ' . $item->name : ''));
    } else Session::flash('danger', 'Perubahan data gagal disimpan');

    return redirect()->route($this->route . '.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $item = Collaboration::find($id);
    if ($item) {
      // Delete logo from public
      if (File::exists($item->logoPath)) File::delete($item->logoPath);

      $item->delete();
      $name = $item->name;

      Session::flash('success', 'Data ' . strtolower($this->active) . ' ' . $name . ' berhasil dihapus');
    } else Session::flash('danger', 'Data gagal dihapus');

    return redirect()->route($this->route . '.index');
  }
}
