<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ArticleArticleCategory extends Pivot
{
    use HasFactory;

    protected $table = "tas_article_article_category";

    public $incrementing = true;

    public function article()
    {
        return $this->belongsTo('App\Models\Blog\Article','article_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Blog\ArticleCategory','category_id');
    }
}
