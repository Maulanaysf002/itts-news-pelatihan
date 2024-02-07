<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Collaboration extends Model
{
  use HasFactory;

  protected $table = "tref_training_collabs";
  protected $fillable = [
    'name',  'logo'
  ];

  // relation
  function trainingCollab()
  {
    $this->hasMany(TrainingCollab::class, 'collabs_id');
  }


  // logo

  function getLogoPathAttribute()
  {
    if ($this->logo) return 'img/collaboration/' . $this->logo;
    else return null;
  }

  public function getShowLogoAttribute()
  {
    return File::exists($this->logoPath) ? $this->logoPath : 'img/admin/default.png';
  }

  public function getLogoPreviewAttribute()
  {
    return '<div class="avatar-md">'
      . '<img src="' . asset($this->showLogo) . '" alt="user-' . $this->id . '" class="avatar-img">'
      . '</div>';
  }

  public function getAvatarAttribute()
  {
    return '<div class="avatar-md">'
      . '<img src="' . asset($this->showLogo) . '" alt="user-' . $this->id . '" class="avatar-img">'
      . '</div>';
  }

  public function getNameWithPhotoAttribute()
  {
    return $this->avatar . $this->name;
  }

  // scope

}
