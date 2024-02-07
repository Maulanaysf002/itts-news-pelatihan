<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = "tm_authors";
    protected $fillable = ['name','bio','employee_id'];

    public function employee()
    {
        return $this->belongsTo('App\Models\HumanResources\Employee','employee_id');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Blog\Article','author_id');
    }
}
