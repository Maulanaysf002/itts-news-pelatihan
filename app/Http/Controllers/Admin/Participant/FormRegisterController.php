<?php

namespace App\Http\Controllers\Admin\Participant;

use Jenssegers\Date\Date;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Training;
use App\Models\Admin\Participant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\TrainingParticipant;

class FormRegisterController extends Controller
{
  protected $route;
  /**
   *
   * create instant class
   *
   **/
  public function __construct()
  {
    $this->active = 'Pendaftaran';
    $this->view = 'home';
    $this->route = 'home.user.register';
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $data = Training::Unfinish()->get();

    $view = $this->view;
    $active = $this->active;
    $route = $this->route;

    return view($this->view . '.form', compact('active', 'route', 'data'));
  }

  /**
   * Display a listing of the resource.
   */
  public function success(Request $request)
  {
    $data = TrainingParticipant::where('register_code', $request->register_code)->with('participants')->get();
    // Participant::where('id', $request->id)->with('trainings')->first();

    $training = TrainingParticipant::where('register_code', $request->register_code)->with('training')->get();

    $view = $this->view;
    $active = $this->active;
    $route = $this->route;

    return view($this->view . '.register-success', compact('active', 'route', 'data', 'training'));
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
    // form validation
    $messages = [
      'trainingId.required' => 'Mohon pilih satu kategori pelatihan',
      'name.required' => 'Mohon tuliskan nama lengkap anda',
      'email.required' => 'mohon tuliskan alamat email anda',
      'participantPhone.required' => 'Mohon tuliskan nomor telpon anda',
      'institution.required' => 'Mohon tuliskan nama institusi anda',
      'institution.required' => 'Mohon tuliskan jabatan anda',
    ];

    $this->validate($request, [
      'trainingId' => 'required',
      'name' => 'required',
      'email' => 'required',
      'participantPhone' => 'required',
      'institution' => 'required',
      'position' => 'required',
    ], $messages);

    // data validation
    $ParticipantTraining = TrainingParticipant::leftJoin('tm_participants', 'tas_training_participants.participant_id', '=', 'tm_participants.id')->where([
      'training_id' => $request->trainingId,
      'email' => $request->email
    ])->get();

    // $participant = Participant::where([
    //   'email' => $request->email,
    // ])->count();

    // kalau email sudah ada dalam pelatihan yang dipilih maka tidak dapat ditambah
    if ($ParticipantTraining->count() < 1) {

      $item = new Participant();
      $item->name = $request->name;
      $item->email = $request->email;
      $item->institution = $request->institution;
      $item->position = $request->position;
      $item->participant_phone = $request->participantPhone;
      $item->social_media = $request->socialMedia;
      $item->save();
      $item->fresh();

      if ($request->trainingId) {
        $trainingParticipant = new TrainingParticipant();
        $trainingParticipant->participant_id = $item->id;
        $trainingParticipant->training_id = $request->trainingId;

        // generate singkatan judul training
        $training = Training::where('id', $request->trainingId)->first();
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

        $trainingParticipant->register_code = $singkatanPelatihan . $item->id . '-' . $type . '-' .  Str::random(3);


        $trainingParticipant->save();
        $trainingParticipant->fresh();
      }

      Session::flash('success', 'Data ' . $item->name . ' berhasil ditambahkan');
      return redirect()->route($this->route . '.success', ['register_code' => $trainingParticipant->register_code]);
    } else Session::flash('danger', 'Data ' . $request->email . '' . 'Sudah Pernah Ditambahkan');

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
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
