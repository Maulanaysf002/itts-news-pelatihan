<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCollab extends Model
{
  use HasFactory;

  protected $table = "tas_training_collabs";
  protected $fillable = [
    'training_id', 'collabs_id'
  ];

  // relation
  function collaborator()
  {
    return $this->belongsTo(Collaboration::class, 'collabs_id');
  }
  function training()
  {
    return $this->belongsTo(Training::class, 'training_id');
  }
}
