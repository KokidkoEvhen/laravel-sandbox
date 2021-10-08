<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $uncategorized = Category::firstOrCreate(['title' => 'Uncategorized', 'slug' =>
                'uncategorized']);
            Post::where('category_id', $category->id)->update(
                ['category_id' => $uncategorized->id]);
        });
    }
}
