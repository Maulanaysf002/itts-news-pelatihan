<?php

namespace App\Http\Controllers\Admin;

use Jenssegers\Date\Date;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Speaker;

// models
use App\Models\Admin\Training;
use App\Models\Admin\Moderator;
use App\Models\Admin\Collaboration;
use App\Models\Admin\TrainingTypes;
use App\Http\Controllers\Controller;
use App\Models\Admin\Signature;
use App\Models\Admin\SkSignature;
use App\Models\Admin\TrainingCollab;
use Illuminate\Support\Facades\File;

use App\Models\Admin\TrainingSpeaker;
use App\Models\Admin\TrainingModerator;
use App\Models\Admin\TrainingSignature;
use App\Models\Admin\TrainingSKSignature;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class TrainingController extends Controller
{

  protected $active;
  protected $route;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->active = 'Pelatihan';
    $this->route = 'admin.training';
  }


  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $collaboration = Collaboration::all();
    $speaker = Speaker::all();
    $moderator = Moderator::all();
    $type = TrainingTypes::all();
    $signature = Signature::all();
    $sksignature = SkSignature::all();
    $data = Training::all();

    $used = null;
    foreach ($data as $d) {
      if ($d->participants()->count() > 0) $used[$d->id] = 1;
      else $used[$d->id] = 0;
    }

    // $speakerName = Training::with('SpeakerName');

    $active = $this->active;
    $route = $this->route;
    return view($this->route . '-index', compact('active', 'route', 'speaker', 'moderator', 'type', 'data', 'collaboration', 'used', 'signature', 'sksignature'));
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
      'title.required' => 'Mohon tuliskan nama ' . Str::lower($this->active),
      'image.file' => 'Pastikan gambar adalah berkas yang valid',
      'image.max' => 'Ukuran gambar yang boleh diunggah maksimum 500 KB',
      'image.mimes' => 'Pastikan gambar yang diunggah berekstensi .jpg, .jpeg, .png, atau .webp',
      'image.dimensions' => 'Pastikan gambar yang diunggah beresolusi minimum 576x720 px',
      'signature' => 'Mohon Pilih Penandatangan',
      'sksignature' => 'Mohon Pilih Penandatangan SK'
    ];

    $this->validate($request, [
      'title' => 'required',
      'image' => 'file|max:500|mimes:jpg,jpeg,png,webp|dimensions:min_width=576,min_height=720',
      'signature' => 'required',
      'sksignature' => 'required'
    ], $messages);

    // data validation
    $count = Training::where(['title' => $request->title, 't_date' => Date::parse($request->date)])->count();

    // logic
    if ($count < 1) {
      $type = TrainingTypes::find($request->type);
      $signature = Signature::find($request->signature);
      $sksignature = SkSignature::find($request->sksignature);

      if ($type && $signature && $sksignature) {
        $item = new Training();
        $item->title = $request->title;
        $item->description = $request->desc;
        $item->meet_link = $request->link;
        $item->t_type = $request->type;
        $item->t_date = isset($request->date) ? Date::parse($request->date) : null;

        $titleArray = explode(' ', $request->title);
        // Mengambil karakter pertama dari setiap kata
        $singkatanPelatihan = '';
        foreach ($titleArray as $word) {
          if (ctype_alpha($word)) {
            $singkatanPelatihan .= Str::substr($word, 0, 1);
          }
        }

        $type = '';
        if ($request->type == 1) {
          $type = 'WEBINAR';
        } else {
          $type = 'SEMINAR';
        }

        // bulan romawi
        function getRomanNumeralMonth()
        {
          $monthNumber = Carbon::now()->format('n');

          $romanNumerals = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
          ];

          return $romanNumerals[$monthNumber];
        }

        $romanMonth = getRomanNumeralMonth();

        $date = Date::parse($request->date);

        $item->training_code = $singkatanPelatihan . Str::random(2) . $date->format('dmY');
        $item->save();
        $item->fresh();

        $trainingSignature = new TrainingSignature();
        $trainingSignature->training_id = $item->id;
        $trainingSignature->signature_id = $request->signature;
        $trainingSignature->save();
        $trainingSignature->fresh();

        $trainingSkSignature = new TrainingSKSignature();
        $trainingSkSignature->training_id = $item->id;
        $trainingSkSignature->sksignature_id = $request->sksignature;
        $trainingSkSignature->save();
        $trainingSkSignature->fresh();

        foreach ($request->speaker as $s) {
          $trainingSpeaker = new TrainingSpeaker();
          $trainingSpeaker->training_id = $item->id;
          $trainingSpeaker->speaker_id = $s;
          $trainingSpeaker->save();

          $trainingSpeaker->invitation_code = '0' . $trainingSpeaker->id . '/' . 'SKEL' . '/' . $type . '/' . 'SPK' . '/' . 'WRIV' . '/' . 'ITTS' . '/' . $romanMonth . '/' . Carbon::now()->format('Y');
          $trainingSpeaker->save();
        }

        foreach ($request->moderator as $m) {
          $trainingModerator = new TrainingModerator();
          $trainingModerator->training_id = $item->id;
          $trainingModerator->moderator_id = $m;
          $trainingModerator->save();

          $trainingModerator->invitation_code = '0' . $trainingModerator->id . '/' . 'SKEL' . '/' . $type . '/' . 'MOD' . '/' . 'WRIV' . '/' . 'ITTS' . '/' . $romanMonth . '/' . Carbon::now()->format('Y');
          $trainingModerator->save();
        }

        if ($request->collaboration && count($request->collaboration) > 0) {
          foreach ($request->collaboration as $c) {
            $trainingCollab = new TrainingCollab();
            $trainingCollab->training_id = $item->id;
            $trainingCollab->collabs_id = $c;
            $trainingCollab->save();
          }
        }


        if ($request->file('image') && $request->file('image')->isValid()) {
          // Move tips image to public
          $file = $request->file('image');
          $image = $item->id . '_' . time() . '_image.' . $file->getClientOriginalExtension();
          $file->move('img/training/',  $image);
        }

        $item->image = isset($image) ? $image : null;
        $item->save();

        Session::flash('success', 'Data ' . $item->name . ' berhasil ditambahkan');
      } else Session::flash('danger', 'Mohon pilih salah satu kategori' . strtolower($this->active));
    } else Session::flash('danger', 'Data ' . $request->name . ' sudah pernah ditambahkan');

    return redirect()->route($this->route . '.index');
  }

  /**
   * update training status.
   */
  public function finish(Request $request)
  {
    $formId = $request->id;

    $training = Training::find($formId);

    if ($training) {
      $training->status = 1;
      $training->save();
    }

    return redirect()->route($this->route . '.index');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Request $request)
  {

    $data = $request->id ? Training::find($request->id) : null;

    if ($data) {
      $speaker = Speaker::all();
      $moderator = Moderator::all();
      $collaboration = Collaboration::all();
      $trainingType = TrainingTypes::all();
      $signature = Signature::all();
      $sksignature = SkSignature::all();
      $active = $this->active;
      $route = $this->route;

      return view($route . '-edit', compact('data', 'active', 'route', 'trainingType', 'speaker', 'moderator', 'collaboration', 'signature', 'sksignature'));
    } else return "Ups, tidak dapat memuat data";
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request)
  {
    $messages = [
      'editTitle.required' => 'Mohon tuliskan nama ' . Str::lower($this->active),
      'editImage.file' => 'Pastikan gambar adalah berkas yang valid',
      'editImage.max' => 'Ukuran gambar yang boleh diunggah maksimum 500 KB',
      'editImage.mimes' => 'Pastikan gambar yang diunggah berekstensi .jpg, .jpeg, .png, atau .webp',
      'editImage.dimensions' => 'Pastikan gambar yang diunggah beresolusi minimum 576x720 px',
      'editSkSignature' => 'Mohon pilih penandatangan sk',
      'editSignature' => 'Mohon pilih penandatangan sertifikat',
    ];

    $this->validate($request, [
      'editTitle' => 'required',
      'editImage' => 'file|max:500|mimes:jpg,jpeg,png,webp|dimensions:min_width=576,min_height=720',
      'editSkSignature' => 'required',
      'editSignature' => 'required'
    ], $messages);

    // bulan romawi
    function getRomanNumeralMonth()
    {
      $monthNumber = Carbon::now()->format('n');

      $romanNumerals = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
        7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
      ];

      return $romanNumerals[$monthNumber];
    }

    $romanMonth = getRomanNumeralMonth();


    $training = Training::where('id', $request->id)->first();
    $trainingCount = Training::where(['title' => $request->title, 't_date' => Date::parse($request->date)])->where('id', '!=', $request->id);

    // data validation
    if ($training && $trainingCount->count() < 1) {

      $type = TrainingTypes::where(['id' => $request->editType])->first();
      $signature = Signature::where(['id' => $request->editSignature])->first();
      $sksignature = SkSignature::where(['id' => $request->editSkSignature])->first();

      if ($request->file('editImage') && $request->file('editImage')->isValid()) {
        // Delete service image from public
        if (File::exists($training->imagePath)) {
          File::delete($training->imagePath);
        }

        // Move service image to public
        $file = $request->file('editImage');
        $image = $training->id . '_' . time() . '_image.' . $file->getClientOriginalExtension();
        $file->move('img/training/', $image);
      }

      if ($type && $signature && $sksignature) {
        $old = $training->title;
        $training->title = $request->editTitle;
        $training->description = $request->editDesc;
        $training->image  = isset($image) ? $image : $training->image;
        $training->meet_link = $request->editLink;
        $training->t_type = $request->editType;
        $training->t_date = isset($request->editDate) ? Date::parse($request->editDate) : null;
        $training->save();
        $training->fresh();

        $type = '';
        if ($request->editType == 1) {
          $type = 'WEBINAR';
        } else {
          $type = 'SEMINAR';
        }

        $titleArray = explode(' ', $request->editTitle);
        // Mengambil karakter pertama dari setiap kata
        $singkatanPelatihan = '';
        foreach ($titleArray as $word) {
          if (ctype_alpha($word)) {
            $singkatanPelatihan .= Str::substr($word, 0, 1);
          }
        }

        // update relasi signature
        if ($signature) {
          $trainingSignature = TrainingSignature::where('training_id', $training->id)->with('signature')->get();

          foreach ($trainingSignature as $ts) {
            $ts->training_id = $training->id;
            $ts->signature_id = $request->editSignature;
            $ts->save();
          }
        }

        // update relasi sksignature
        if ($sksignature) {
          $trainingSkSignature = TrainingSKSignature::where('training_id', $training->id)->with('sksignature')->get();

          foreach ($trainingSkSignature as $tsks) {
            $tsks->training_id = $training->id;
            $tsks->sksignature_id = $request->editSkSignature;
            $tsks->save();
          }
        }

        // update multiple speaker
        $trainingSpeaker_ids = TrainingSpeaker::where('training_id', $training->id)->with('speaker')->pluck('id'); // id dari table training
        $i = 0;
        $len = count($request->editSpeaker);

        if ($len > 0) {
          foreach ($request->editSpeaker as $s) {
            if (count($trainingSpeaker_ids) > 0) {
              if ($i < $len) {
                $trainingSpeaker = TrainingSpeaker::find($trainingSpeaker_ids->shift());

                if ($trainingSpeaker->speaker_id != $s) {
                  $trainingSpeaker->invitation_code = '0' . $trainingSpeaker->id . '/' . 'SKEL' . '/' . $type . '/' . 'SPK' . '/' . 'WRIV' . '/' . 'ITTS' . '/' . $romanMonth . '/' . Carbon::now()->format('Y');
                  $trainingSpeaker->certificate_code = 0;
                  $trainingSpeaker->presence = 0;

                  $trainingSpeaker->speaker_id = $s;
                  $trainingSpeaker->save();
                }
              }
            } else {
              $trainingSpeaker = new TrainingSpeaker();
              $trainingSpeaker->speaker_id = $s;
              $trainingSpeaker->certificate_code = 0;
              $trainingSpeaker->presence = 0;

              $training->speakers()->save($trainingSpeaker);
              $trainingSpeaker->invitation_code = '0' . $trainingSpeaker->id . '/' . 'SKEL' . '/' . $type . '/' . 'SPK' . '/' . 'WRIV' . '/' . 'ITTS' . '/' . $romanMonth . '/' . Carbon::now()->format('Y');
              $training->speakers()->save($trainingSpeaker);
            }
            $i++;
          }
          if (count($trainingSpeaker_ids) > 0) TrainingSpeaker::destroy($trainingSpeaker_ids);
        }

        // update multiple moderator
        $trainingModerator_ids = TrainingModerator::where('training_id', $training->id)->with('moderator')->pluck('id');
        $i = 0;
        $len = count($request->editModerator);

        if ($len > 0) {
          foreach ($request->editModerator as $m) {
            if (count($trainingModerator_ids) > 0) {
              if ($i < $len) {
                $trainingModerator = TrainingModerator::find($trainingModerator_ids->shift());

                if ($trainingModerator->moderator_id != $m) {
                  $trainingModerator->certificate_code = 0;
                  $trainingModerator->presence = 0;
                  $trainingModerator->invitation_code = '0' . $trainingModerator->id . '/' . 'SKEL' . '/' . $type . '/' . 'MOD' . '/' . 'WRIV' . '/' . 'ITTS' . '/' . $romanMonth . '/' . Carbon::now()->format('Y');

                  $trainingModerator->moderator_id = $m;
                  $trainingModerator->save();
                }
              }
            } else {
              $trainingModerator = new TrainingModerator();
              $trainingModerator->moderator_id = $m;
              $trainingModerator->certificate_code = 0;
              $trainingModerator->presence = 0;

              $training->moderators()->save($trainingModerator);
              $trainingModerator->invitation_code = '0' . $trainingModerator->id . '/' . 'SKEL' . '/' . $type . '/' . 'MOD' . '/' . 'WRIV' . '/' . 'ITTS' . '/' . $romanMonth . '/' . Carbon::now()->format('Y');

              $training->moderators()->save($trainingModerator);
            }
            $i++;
          }
          if (count($trainingModerator_ids) > 0) TrainingModerator::destroy($trainingModerator_ids);
        }

        // update multiple collaboration
        if ($request->editCollaboration && count($request->editCollaboration) > 0) {
          $trainingCollab_ids = TrainingCollab::where('training_id', $training->id)->with('collaborator')->pluck('id');
          $i = 0;
          $len = count($request->editCollaboration);

          if ($len && $len > 0) {
            foreach ($request->editCollaboration as $c) {
              if (count($trainingCollab_ids) > 0) {
                if ($i < $len) {
                  $trainingCollab = TrainingCollab::find($trainingCollab_ids->shift());
                  $trainingCollab->save();
                }
              } else {
                $trainingCollab = new TrainingCollab();
                $trainingCollab->collabs_id = $c;

                $training->collaborators()->save($trainingCollab);
              }
              $i++;
            }
            if (count($trainingCollab_ids) > 0) TrainingCollab::destroy($trainingCollab_ids);
          }
        } else {
          $training->collaborators()->delete();
        }

        $training->save();

        Session::flash('success', 'Data pelatihan berhasil diubah');
      }
    } else Session::flash('danger', 'Data pelatihan sudah ada');

    return redirect()->route($this->route . '.index');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request, string $id)
  {

    $training = $request->id ? Training::find($request->id) : null;
    $nama = $training ? $training->title : null;
    $used_count = $training ? $training->participants()->count() : 0;

    if ($training && $used_count < 1) {
      $training->speakers()->delete();
      $training->moderators()->delete();
      $training->colaborators()->delete();
      $training->signature()->delete();
      $training->sksignature()->delete();
      $training->delete();

      Session::flash('success', 'Data ' . $nama . ' berhasil dihapus');
    } else Session::flash('danger', 'Data ' . $nama . ' gagal dihapus');

    return redirect()->route($this->route . '.index');
  }
}
