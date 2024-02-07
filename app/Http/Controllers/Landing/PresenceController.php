<?php

namespace App\Http\Controllers\Landing;

use Jenssegers\Date\Date;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Training;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\TrainingParticipant;

class PresenceController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('home.presence');
  }

  /**
   * ketika peserta memasukan register code.
   */
  public function submit(Request $request)
  {

    // validasi code register
    // $validCode = TrainingParticipant::where('register_code', '=',  $request->register_code)->with('training')->get();

    $validCode = TrainingParticipant::leftJoin('tm_trainings', 'tas_training_participants.training_id', '=', 'tm_trainings.id')->where([
      'register_code' => $request->register_code,
      'training_code' => $request->training_code,
    ])->get();


    if (count($validCode) > 0) {

      foreach ($validCode as $v) {
        if ($v->register_code == $request->register_code && $v->training_code == $request->training_code) {
          $data = TrainingParticipant::where('register_code', '=',  $request->register_code)->with('participants')->first();

          // cek jika certificate code belum dibuat
          if ($data->certificate_code == 0) {

            // generate singkatan judul training
            $training = Training::where('id', $data->training_id)->first();
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

            $data->presence = 1;
            $data->certificate_code = $singkatanPelatihan . $data->participant_id . '-' . 'S' . '-' . $type . '-' . Str::random(3);
            $data->save();
          }

          // data training dari data peserta absen
          $getTraining = Training::where('id', $data->training_id)->first();

          Session::flash('success', 'Code yang anda masukan benar');
          return view('home.presence-success', compact('data', 'getTraining'));
        }
      }
    } else {
      Session::flash('danger', 'Code yang anda masukan salah silahkan lihat code saat pertama kali anda daftar atau masukan kode pelatihan yang benar');
      return redirect()->route('home.user.presence.index');
    }
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
    //
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
