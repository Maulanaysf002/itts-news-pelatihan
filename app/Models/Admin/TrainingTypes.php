<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TrainingTypes extends Model
{
  use HasFactory;

  protected $table = "tref_training_types";
  protected $fillable = [
    'name'
  ];

  // relation

  function types()
  {
    $this->hasMany(TrainingParticipants::class, 't_type');
  }


  // prefixes suffixes

}
