<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSKSignature extends Model
{
  use HasFactory;

  protected $table = "tas_training_sksignature";
  protected $fillable = [
    'training_id', 'sksignature_id'
  ];

  // relation
  function sksignature()
  {
    return $this->belongsTo(SkSignature::class, 'sksignature_id');
  }

  function training()
  {
    return $this->belongsTo(Training::class, 'training_id');
  }
}
