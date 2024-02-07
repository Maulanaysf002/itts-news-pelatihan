<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;
use Illuminate\Support\Str;

use App\Models\Blog\ArticleCategory;

class ArticleCategoryController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->active = 'Kategori Artikel';
    $this->route = 'admin.blog.article';
    $this->view = 'admin.blog.article';
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $data = ArticleCategory::all();

    $used = null;
    foreach ($data as $d) {
      if ($d->articles()->count() > 0) $used[$d->id] = 1;
      else $used[$d->id] = 0;
    }

    $active = $this->active;
    $route = $this->route;

    return view($route . '-index', compact('data', 'used', 'active', 'route'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $messages = [
      'name.required' => 'Mohon tuliskan ' . strtolower($this->active),
    ];

    $this->validate($request, [
      'name' => 'required',
    ], $messages);

    $count = ArticleCategory::where('name', $request->name)->count();

    if ($count < 1) {
      $item = new ArticleCategory();
      $item->name = $request->name;
      $item->slug = Str::slug($request->name);
      $item->is_active = $request->active == 'on' ? 1 : 0;
      $item->save();

      Session::flash('success', 'Data ' . $request->name . ' berhasil ditambahkan');
    } else Session::flash('danger', 'Data ' . $request->name . ' sudah pernah ditambahkan');

    return redirect()->route($this->route . '.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request)
  {
    $data = $request->id ? ArticleCategory::find($request->id) : null;
    if ($data) {
      $active = $this->active;
      $route = $this->route;

      return view($route . '-edit', compact('data', 'active', 'route'));
    } else return "Ups, tidak dapat memuat data";
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $messages = [
      'editName.required' => 'Mohon tuliskan ' . strtolower($this->active)
    ];

    $this->validate($request, [
      'editName' => 'required',
    ], $messages);

    $item = ArticleCategory::find($request->id);
    $count = ArticleCategory::where('name', $request->editName)->where('id', '!=', $request->id)->count();

    if ($item && $count < 1) {
      $old = $item->name;
      $item->name = $request->editName;
      $item->slug = Str::slug($request->editName);
      $item->is_active = $request->editActive == 'on' ? 1 : 0;
      $item->save();

      Session::flash('success', 'Data ' . $old . ' berhasil diubah menjadi ' . $item->name);
    } else Session::flash('danger', 'Perubahan data gagal disimpan');

    return redirect()->route($this->route . '.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $item = ArticleCategory::find($id);
    $used_count = $item ? $item->articles()->count() : 0;
    if ($item && $used_count < 1) {
      $name = $item->name;
      $item->delete();

      Session::flash('success', 'Data ' . $name . ' berhasil dihapus');
    } else Session::flash('danger', 'Data gagal dihapus');

    return redirect()->route($this->route . '.index');
  }
}
