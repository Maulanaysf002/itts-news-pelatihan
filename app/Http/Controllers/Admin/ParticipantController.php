<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Training;
use App\Models\Admin\Participant;
use App\Http\Controllers\Controller;
use App\Models\Admin\TrainingModerator;
use App\Models\Admin\TrainingParticipant;
use App\Models\Admin\TrainingSpeaker;

class ParticipantController extends Controller
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
    $this->active = 'Peserta';
    $this->view = 'admin.participant';
    $this->route = 'admin.participant';
  }

  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $training = Training::where('status', '=', 0)->get();

    if (isset($request->trainingStatus) && $request->trainingStatus == 1) {
      $training = Training::where('status', '=', 1)->get();
    }

    $trainingParticipant = TrainingParticipant::all();
    $participant = Participant::all();

    $active = $this->active;
    $route = $this->route;

    return view($this->view . '-index', compact('active', 'route', 'participant', 'training'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Request $request, $id)
  {

    // $trainingSpeaker = TrainingSpeaker::where('training_id', '=', $id)
    //   ->with(['speaker' => function ($query) {
    //     $query->select('id', 'name');
    //   }])
    //   ->get();

    $training = Training::where('id', '=', $id)->get();
    $Trainingparticipant = TrainingParticipant::where('training_id', '=', $id)->with('participants')->get();
    $trainingSpeaker = TrainingSpeaker::where('training_id', '=', $id)->with('speaker')->get();
    $trainingModerator = TrainingModerator::where('training_id', '=', $id)->with('moderator')->get();

    $active = $this->active;
    $route = $this->route;

    return view($this->view . '-detail', compact('active', 'route', 'Trainingparticipant', 'training', 'trainingSpeaker', 'trainingModerator'));
  }

  /**
   * Update presence.
   */
  public function presence(Request $request)
  {
    $id = $request->id;

    if ($id) {
      $trainingParticipant = TrainingParticipant::where('id', $id)->with('participants')->first();

      // cek jika certificate code belum dibuat
      if ($trainingParticipant->certificate_code == 0) {

        // generate singkatan judul training
        $training = Training::where('id', $trainingParticipant->training_id)->first();
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

        $trainingParticipant->presence = 1;
        $trainingParticipant->certificate_code = $singkatanPelatihan . $trainingParticipant->participant_id . '-' . 'S' . '-' . $type . '-' . Str::random(3);
        $trainingParticipant->save();
      }
    }

    return redirect()->route('admin.participant.detail', ["id" => $trainingParticipant->training_id]);
  }
}
