<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Training;
use App\Models\Admin\Moderator;
use App\Http\Controllers\Controller;
use App\Models\Admin\TrainingModerator;
use Illuminate\Support\Facades\Session;

class ModeratorController extends Controller
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
    $this->active = 'Moderator';
    $this->view = 'admin.moderator';
    $this->route = 'admin.training.moderator';
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    // moderator
    $data = Moderator::all();

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
      'institution.required' => 'Mohon tuliskan nama institusi',
    ];

    $this->validate($request, [
      'name' => 'required',
      'position' => 'required',
      'institution' => 'required',
    ], $messages);

    $speaker = Moderator::where([
      'name' => $request->name,
      'prefixes' => $request->prefixes,
      'suffixes' => $request->suffixes
    ]);

    if ($speaker->count() < 1) {
      $item = new Moderator();
      $item->name = $request->name;
      $item->prefixes = $request->prefixes;
      $item->suffixes = $request->suffixes;
      $item->position = $request->position;
      $item->institution = $request->institution;
      $item->save();
      $item->fresh();

      Session::flash('success', 'Data ' . $item->prefixes . ' ' . $item->name . ' ' . $item->suffixes . ' berhasil ditambahkan');
    } else {
      $speaker = $speaker->first();
      Session::flash('danger', 'Data ' . $speaker->nameWithTitle . ' sudah pernah ditambahkan');
    }

    return redirect()->route($this->route . '.index');
  }


  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Request $request)
  {
    $data = Moderator::find($request->id);
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
    ];

    $this->validate($request, [
      'editName' => 'required',
      'editInstitution' => 'required',
    ], $messages);

    $item = Moderator::where('id', $request->id)->first();
    $nameExist = Moderator::where([
      'name' => $request->editName,
      'prefixes' => $request->editPrefixes,
      'suffixes' => $request->editSuffixes,
    ])->where('id', '!=', $request->id);

    if ($item && $nameExist->count() < 1) {

      $old = $item->name;
      $item->name = $request->editName;
      $item->prefixes = $request->editPrefixes;
      $item->suffixes = $request->editSuffixes;
      $item->position = $request->editPosition;
      $item->institution = $request->editInstitution;
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
    $item = Moderator::find($id);
    if ($item) {
      $item->delete();
      $name = $item->name;

      Session::flash('success', 'Data ' . strtolower($this->active) . ' ' . $name . ' berhasil dihapus');
    } else Session::flash('danger', 'Data gagal dihapus');

    return redirect()->route($this->route . '.index');
  }

  /**
   * Absen Moderator oleh admin.
   */
  public function presence(Request $request)
  {
    $id = $request->id;

    if ($id) {
      $trainingModerator = TrainingModerator::find($id);

      if ($trainingModerator->certificate_code == 0) {

        // generate singkatan judul training
        $training = Training::where('id', $trainingModerator->training_id)->first();
        $titleArray = explode(' ', $training->title);
        // Mengambil karakter pertama dari setiap kata
        $singkatanPelatihan = '';
        foreach ($titleArray as $word) {
          if (ctype_alpha($word)) {
            $singkatanPelatihan .= Str::substr($word, 0, 1);
          }
        }

        // type pelatihan
        $type = '';
        if ($training->t_type == 1) {
          $type = 'Webinar';
        } elseif ($training->t_type == 2) {
          $type = 'Seminar';
        }

        $trainingModerator->presence = 1;
        $trainingModerator->certificate_code = $singkatanPelatihan . $trainingModerator->speaker_id_id . '-' . 'S' . '-' . $type . '-' . 'moderator' . '-' . Str::random(3);
        $trainingModerator->save();
      }
    }

    return redirect()->route('admin.participant.detail', ["id" => $trainingModerator->training_id]);
  }
}
