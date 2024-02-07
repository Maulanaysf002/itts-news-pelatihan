<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use File;

class Participant extends Model
{
  use HasFactory;

  protected $table = "tm_participants";
  protected $fillable = [
    'name', 'email', 'institution',  'participan_phone',  'social_media'
  ];

  // relation
  function trainings()
  {
    return $this->hasMany(TrainingParticipant::class, 'participant_id');
  }



  // prefixes suffixes

  public function getNameWithTitleAttribute()
  {
    return ($this->prefixes ? $this->prefixes . ' ' : null) . $this->name . ($this->suffixes ? ', ' . $this->suffixes : null);
  }
}
