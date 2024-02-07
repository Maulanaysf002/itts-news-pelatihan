<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use File;
use Jenssegers\Date\Date;
use Spatie\Tags\HasTags;

class Article extends Model
{
  use HasFactory;
  use HasTags;

  protected $table = "tm_articles";
  protected $fillable = [
    'author_id',
    'title',
    'title_slug',
    'text',
    'keywords',
    'excerpt',
    'thumbnail',
    'reading_time',
    'total_views',
    'is_draft',
    'is_active',
    'is_listed',
    'published_at'
  ];

  public function author()
  {
    return $this->belongsTo('App\Models\Blog\Author', 'author_id');
  }

  public function categories()
  {
    return $this->belongsToMany('App\Models\Blog\ArticleCategory', 'tas_article_article_category', 'article_id', 'category_id');
  }

  public function getIdSlugAttribute()
  {
    return $this->id . ($this->title_slug ? '-' . $this->title_slug : null);
  }

  public function getThumbnailPathAttribute()
  {
    if ($this->thumbnail) return 'img/article/' . $this->thumbnail;
    else return null;
  }

  public function getThumbnailSmPathAttribute()
  {
    if ($this->thumbnail) return 'img/article/' . $this->thumbnail . '.webp';
    else return null;
  }

  public function getShowThumbnailAttribute()
  {
    return File::exists($this->thumbnailPath) ? $this->thumbnailPath : 'img/article/default.png';
  }

  public function getShowThumbnailSmAttribute()
  {
    return File::exists($this->thumbnailSmPath) ? $this->thumbnailSmPath : $this->showThumbnail;
  }

  public function getThumbnailPreviewAttribute()
  {
    return '<div class="image-preview-md">'
      . '<img src="' . asset($this->showThumbnailSm) . '" alt="thumbnail-' . $this->id . '" class="avatar-img">'
      . '</div>';
  }

  public function getTotalViewsWithSeparatorAttribute()
  {
    return number_format($this->total_views, 0, ',', '.');
  }

  public function getCreatedAtIdAttribute()
  {
    Date::setLocale('id');
    return Date::parse($this->created_at)->format('j F Y');
  }

  public function getPublishedAtIdAttribute()
  {
    Date::setLocale('id');
    return $this->published_at ? Date::parse($this->published_at)->format('j F Y') : null;
  }

  public function getPublishedAtIdFullAttribute()
  {
    Date::setLocale('id');
    return $this->published_at ? Date::parse($this->published_at)->format('l, j F Y H.i') : null;
  }

  public function getImplodedCategoriesAttribute()
  {
    return $this->categories()->count() > 0 ? implode(', ', $this->categories()->select('name')->pluck('name')->toArray()) : null;
  }

  public function scopeDraft($query)
  {
    return $query->where('is_draft', 1);
  }

  public function scopePublished($query)
  {
    return $query->where('is_draft', 0);
  }

  public function scopeActive($query)
  {
    return $query->where('is_active', 1);
  }

  public function scopeInactive($query)
  {
    return $query->where('is_active', 0);
  }

  public function scopeListed($query)
  {
    return $query->where('is_listed', 1);
  }

  public function scopeUnlisted($query)
  {
    return $query->where('is_listed', 0);
  }
}
