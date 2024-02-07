<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SkSignature extends Model
{
  use HasFactory;

  protected $table = "tm_sksignatures";
  protected $fillable = [
    'name',  'prefixes',  'suffixes',  'position', 'image'
  ];

  // relation
  function trainings()
  {
    return $this->hasMany(TrainingSKSignature::class, 'sksignature_id');
  }

  // image

  function getImagePathAttribute()
  {
    if ($this->image) return 'img/sk-signature/' . $this->image;
    else return null;
  }

  public function getShowImageAttribute()
  {
    return File::exists($this->imagePath) ? $this->imagePath : 'img/admin/default.png';
  }

  public function getImagePreviewAttribute()
  {
    return '<div class="avatar-md">'
      . '<img src="' . asset($this->showImage) . '" alt="flayer-' . $this->id . '" class="avatar-img">'
      . '</div>';
  }

  public function getAvatarAttribute()
  {
    return '<div class="avatar-md">'
      . '<img src="' . asset($this->showImage) . '" alt="flayer-' . $this->id . '" class="avatar-img">'
      . '</div>';
  }

  public function getNameWithPhotoAttribute()
  {
    return $this->avatar . $this->title;
  }

  // prefixes suffixes

  public function getNameWithTitleAttribute()
  {
    return ($this->prefixes ? $this->prefixes . ' ' : null) . $this->name . ($this->suffixes ? ', ' . $this->suffixes : null);
  }
}
