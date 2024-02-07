<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ParticipantCategories extends Model
{
  use HasFactory;

  protected $table = "tref_participans_categories";
  protected $fillable = [
    'name'
  ];

  // relation

  function categories()
  {
    $this->hasMany(TrainingParticipants::class, 'id_cat');
  }


  // prefixes suffixes

}
