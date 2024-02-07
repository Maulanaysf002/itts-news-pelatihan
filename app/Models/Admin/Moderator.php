<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use File;

class Moderator extends Model
{
  use HasFactory;

  protected $table = "tref_moderators";
  protected $fillable = [
    'name',  'prefixes',  'suffixes',  'position',  'institution'
  ];

  // relation
  function trainings()
  {
    return $this->hasMany(TrainingModerator::class, 'moderator_id');
  }

  // prefixes suffixes

  public function getNameWithTitleAttribute()
  {
    return ($this->prefixes ? $this->prefixes . ' ' : null) . $this->name . ($this->suffixes ? ', ' . $this->suffixes : null);
  }
}
