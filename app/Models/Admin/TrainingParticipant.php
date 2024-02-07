<?php

namespace App\Models\Admin;

use File;
use App\Models\Admin\Training;
use App\Models\Admin\Participant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingParticipant extends Model
{
  use HasFactory;

  protected $table = "tas_training_participants";
  protected $fillable = [
    'participant_id',  'training_id', 'p_register_code',  'invitation_code', 'certificate_code',  'presence'
  ];

  // relation
  function participants()
  {
    return $this->belongsTo(Participant::class, 'participant_id');
  }
  function training()
  {
    return $this->belongsTo(Training::class, 'training_id');
  }
}
