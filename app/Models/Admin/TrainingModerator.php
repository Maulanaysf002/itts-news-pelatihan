<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use File;

class TrainingModerator extends Model
{
  use HasFactory;

  protected $table = "tas_training_moderators";
  protected $fillable = [
    'moderator_id',  'training_id', 'p_register_code',  'invitation_code', 'certificate_code',  'presence'
  ];

  // relation
  function moderator()
  {
    return $this->belongsTo(Moderator::class, 'moderator_id');
  }
  function training()
  {
    return $this->belongsTo(Training::class, 'training_id');
  }
}
