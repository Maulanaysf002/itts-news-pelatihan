<?php

namespace App\Models\Admin;

use File;
use App\Models\Admin\Speaker;

use App\Models\Admin\Training;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingSpeaker extends Model
{
  use HasFactory;

  protected $table = "tas_training_speakers";
  protected $fillable = [
    'speaker_id',  'training_id', 'p_register_code',  'invitation_code', 'certificate_code',  'presence'
  ];

  // relation
  function speaker()
  {
    return $this->belongsTo(Speaker::class, 'speaker_id');
  }
  function training()
  {
    return $this->belongsTo(Training::class, 'training_id');
  }
}
