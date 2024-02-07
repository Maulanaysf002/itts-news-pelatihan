<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = "tref_article_categories";
    protected $fillable = ['name','slug','is_active'];

    public function articles()
    {
        return $this->belongsToMany('App\Models\Blog\Article','tas_article_article_category','category_id','article_id');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }
    
    public function scopeInactive($query)
    {
        return $query->where('is_active',0);
    }
}
