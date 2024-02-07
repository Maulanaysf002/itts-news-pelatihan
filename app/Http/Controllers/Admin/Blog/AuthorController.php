<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use File;
use Session;

use App\Models\Blog\Author;
use App\Models\HumanResources\Employee;

class AuthorController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->active = 'Penulis';
    $this->route = 'admin.blog.article';
    $this->view = 'admin.blog.article';
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Author::orderBy('name')->get();
    $employees = Employee::doesntHave('author')->orderBy('name')->get();
    $used = null;
    foreach ($data as $d) {
      if ($d->articles()->count() > 0) $used[$d->id] = 1;
      else $used[$d->id] = 0;
    }

    $active = $this->active;
    $route = $this->route;

    return view($route . '-index', compact('data', 'used', 'active', 'route', 'employees'));
  }

  /**
   * Display a listing of the resource via API.
   *
   * @return \Illuminate\Http\Response
   */
  public function get(Request $request)
  {
    $authors = Author::select('id', 'name')->latest()->take(25);
    // Ref: https://makitweb.com/loading-data-remotely-in-select2-with-ajax/
    if (isset($request->q)) {
      $authors = $authors->where('name', 'LIKE', '%' . $request->q . '%');
    }
    $authors = $authors->get();

    $data = array();
    foreach ($authors as $a) {
      $data[] = array("id" => $a->id, "text" => $a->name);
    }

    return json_encode($data);
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
      'name.required' => 'Mohon tuliskan nama penulis',
      'bio.required' => 'Mohon tuliskan bio singkat penulis'
    ];

    $this->validate($request, [
      'name' => 'required',
      'bio' => 'required',
    ], $messages);

    $author = Author::where([
      'name' => $request->name,
      'bio' => $request->bio,
    ]);

    if ($author->count() < 1) {
      $employee = Employee::where('id', $request->employee)->first();
      if (!isset($request->employee) || ($request->employee && $employee)) {
        $item = new Author();
        $item->name = $request->name;
        $item->bio = $request->bio;
        $item->employee_id = $request->employee;
        $item->save();
        $item->fresh();

        Session::flash('success', 'Data ' . $item->name . ' berhasil ditambahkan');
      } else Session::flash('danger', 'Mohon pilih salah satu SDM yang valid');
    } else {
      $author = $author->first();
      Session::flash('danger', 'Data ' . $author->name . ' sudah pernah ditambahkan');
    }

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
    $data = Author::find($request->id);
    if ($data) {
      $employees = Employee::where(function ($q) use ($data) {
        $q->where(function ($q) {
          $q->doesntHave('author');
        })->orWhere(function ($q) use ($data) {
          $q->where('id', $data->employee_id)->has('author');
        });
      })->orderBy('name')->get();
      $active = $this->active;
      $route = $this->route;

      return view($route . '-edit', compact('data', 'active', 'route', 'employees'));
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
      'editName.required' => 'Mohon tuliskan nama penulis',
      'editBio.required' => 'Mohon tuliskan bio singkat penulis',
    ];

    $this->validate($request, [
      'editName' => 'required',
      'editBio' => 'required',
    ], $messages);

    $item = Author::where('id', $request->id)->first();

    $author = Author::where([
      'name' => $request->editName,
      'bio' => $request->editBio
    ])->where('id', '!=', $request->id);

    if ($item && $author->count() < 1) {
      $employee = Employee::where('id', $request->editEmployee)->first();
      if (!isset($request->editEmployee) || ($request->editEmployee && $employee)) {
        $old = $item->name;
        $item->name = $request->editName;
        $item->bio = $request->editBio;
        $item->employee_id = $request->editEmployee;
        $item->save();

        $item->fresh();

        Session::flash('success', 'Data ' . $old . ' berhasil diubah' . ($old != $item->name ? ' menjadi ' . $item->name : ''));
      } else Session::flash('danger', 'Mohon pilih salah satu SDM yang valid');
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
    $item = Author::find($id);
    $used_count = $item ? $item->articles()->count() : 0;
    if ($item && $used_count < 1) {
      $name = $item->name;
      $item->delete();

      Session::flash('success', 'Data ' . $name . ' berhasil dihapus');
    } else Session::flash('danger', 'Data gagal dihapus');

    return redirect()->route($this->route . '.index');
  }
}
