<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSignature extends Model
{
  use HasFactory;

  protected $table = "tas_training_signature";
  protected $fillable = [
    'training_id', 'signature_id'
  ];

  // relation
  function signature()
  {
    return $this->belongsTo(Signature::class, 'signature_id');
  }

  function training()
  {
    return $this->belongsTo(Training::class, 'training_id');
  }
}
