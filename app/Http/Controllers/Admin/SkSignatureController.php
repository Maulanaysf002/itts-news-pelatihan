<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\SkSignature;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\TrainingSKSignature;

class SkSignatureController extends Controller
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
    $this->active = 'Tanda Tangan SK';
    $this->view = 'admin.invitationSignature';
    $this->route = 'admin.invitation.signature';
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $data = SkSignature::all();

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
      'position.required' => 'mohon tuliskan jabatan',
      'image.file' => 'Pastikan gambar adalah berkas yang valid',
      'image.max' => 'Ukuran gambar yang boleh diunggah maksimum 250 KB',
      'image.mimes' => 'Pastikan gambar yang diunggah berekstensi .jpg, .jpeg, .png, atau .webp',
      'image.dimensions' => 'Pastikan gambar yang diunggah beresolusi minimum 1700x1660 px',
    ];

    $this->validate($request, [
      'name' => 'required',
      'position' => 'required',
      'image' => 'file|max:250|mimes:jpg,jpeg,png,webp|dimensions:min_width=64,min_height=64',
    ], $messages);

    $signature = SkSignature::where([
      'name' => $request->name,
      'prefixes' => $request->prefixes,
      'suffixes' => $request->suffixes
    ]);

    if ($signature && $signature->count() < 1) {
      $item = new SkSignature();
      $item->name = $request->name;
      $item->prefixes = $request->prefixes;
      $item->suffixes = $request->suffixes;
      $item->position = $request->position;
      $item->save();
      $item->fresh();

      if ($request->file('image') && $request->file('image')->isValid()) {
        // Move tips image to public
        $file = $request->file('image');
        $image = $item->id . '_' . time() . '_image.' . $file->getClientOriginalExtension();
        $file->move('img/sk-signature/',  $image);
      }

      $item->image = isset($image) ? $image : null;
      $item->save();

      Session::flash('success', 'Data ' . $item->prefixes . ' ' . $item->name . ' ' . $item->suffixes . ' berhasil ditambahkan');
    } else {
      $signature = $signature->first();
      Session::flash('danger', 'Data ' . $signature->nameWithTitle . ' sudah pernah ditambahkan');
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
    $data = SkSignature::find($request->id);

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
      'editPosition.required' => 'Mohon tuliskan nama Institusi',
      'editImage.file' => 'Pastikan gambar adalah berkas yang valid',
      'editImage.max' => 'Ukuran gambar yang boleh diunggah maksimum 500 KB',
      'editImage.mimes' => 'Pastikan gambar yang diunggah berekstensi .jpg, .jpeg, .png, atau .webp',
      'editImage.dimensions' => 'Pastikan gambar yang diunggah beresolusi minimum 576x720 px',
    ];

    $this->validate($request, [
      'editName' => 'required',
      'editPosition' => 'required',
      'editImage' => 'file|max:500|mimes:jpg,jpeg,png,webp|dimensions:min_width=576,min_height=720',
    ], $messages);

    $item = SkSignature::where('id', $request->id)->first();
    $nameExist = SkSignature::where([
      'name' => $request->editName,
      'prefixes' => $request->editPrefixes,
      'suffixes' => $request->editSuffixes,
    ])->where('id', '!=', $request->id);

    if ($item && $nameExist->count() < 1) {

      if ($request->file('editImage') && $request->file('editImage')->isValid()) {
        // Delete service image from public
        if (File::exists($item->imagePath)) {
          File::delete($item->imagePath);
        }

        // Move service image to public
        $file = $request->file('editImage');
        $image = $item->id . '_' . time() . '_image.' . $file->getClientOriginalExtension();
        $file->move('img/sk-signature/', $image);
      }

      $old = $item->name;
      $item->name = $request->editName;
      $item->prefixes = $request->editPrefixes;
      $item->suffixes = $request->editSuffixes;
      $item->position = $request->editPosition;
      $item->image  = isset($image) ? $image : $item->image;
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
    $item = SkSignature::find($id);
    if ($item) {
      // Delete service icon from public
      if (File::exists($item->imagePath)) File::delete($item->imagePath);

      $item->delete();
      $name = $item->name;

      Session::flash('success', 'Data ' . strtolower($this->active) . ' ' . $name . ' berhasil dihapus');
    } else Session::flash('danger', 'Data gagal dihapus');

    return redirect()->route($this->route . '.index');
  }
}
