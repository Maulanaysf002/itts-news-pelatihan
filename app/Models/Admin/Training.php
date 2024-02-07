<?php

namespace App\Models\Admin;

use File;
use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\TrainingParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Training extends Model
{
  use HasFactory;

  protected $table = "tm_trainings";
  protected $fillable = [
    'title',
    'image',
    'description',
    't_type',
    't_date',
    'meet_link',
    'status',
    'colab_id'
  ];

  //

  public function colaborators()
  {
    return $this->belongsTo(Collaboration::class, 'colab_id');
  }

  public function training_type()
  {
    return $this->belongsTo(TrainingTypes::class, 't_type');
  }

  public function signature()
  {
    return $this->hasMany(TrainingSignature::class, 'training_id')->with('signature:id,name');
  }

  public function sksignature()
  {
    return $this->hasMany(TrainingSKSignature::class, 'training_id')->with('sksignature:id,name');
  }

  public function speakers()
  {
    return $this->hasMany(TrainingSpeaker::class, 'training_id')->with('speaker:id,name');
  }

  public function participants()
  {
    return $this->hasMany(TrainingParticipant::class, 'training_id');
  }

  public function moderators()
  {
    return $this->hasMany(TrainingModerator::class, 'training_id')->with('moderator:id,name');
  }

  public function collaborators()
  {
    return $this->hasMany(TrainingCollab::class, 'training_id')->with('collaborator:id,name');
  }



  // image

  function getImagePathAttribute()
  {
    if ($this->image) return 'img/training/' . $this->image;
    else return null;
  }

  public function getShowImageAttribute()
  {
    return File::exists($this->imagePath) ? $this->imagePath : 'img/admin/default.png';
  }

  public function getImagePreviewAttribute()
  {
    return '<div class="avatar-md">'
      . '<img src="' . asset($this->showImage) . '" alt="flayer-' . $this->id . '" class="avatar-img">'
      . '</div>';
  }

  public function getAvatarAttribute()
  {
    return '<div class="avatar-md">'
      . '<img src="' . asset($this->showImage) . '" alt="flayer-' . $this->id . '" class="avatar-img">'
      . '</div>';
  }

  public function getNameWithPhotoAttribute()
  {
    return $this->avatar . $this->title;
  }

  // Attribute
  public function getDateIdAttribute()
  {
    Date::setLocale('id');
    return Date::parse($this->t_date)->format('j F Y');
  }

  function getSpeakerNameAttribute()
  {
    return $this->speakers->pluck('speaker.name')->toArray();
  }

  function getModeratorNameAttribute()
  {
    return $this->moderators->pluck('moderator.name')->toArray();
  }

  function getCollabNameAttribute()
  {
    return $this->collaborators->pluck('collaborator.name')->toArray();
  }

  function getSignatureNameAttribute()
  {
    return $this->signature->pluck('signature.name')->toArray();
  }

  function getSkSignatureNameAttribute()
  {
    return $this->sksignature->pluck('sksignature.name')->toArray();
  }


  // scope

  function scopeUnfinish($query)
  {
    return $query->where('status', 0);
  }

  function scopeFinish($query)
  {
    return $query->where('status', 1);
  }
}
