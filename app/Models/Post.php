<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
  use HasFactory;

  public function site()
  {
    return $this->belongsTo(Site::class);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  /**
   * Get all of the tags for the post.
   */
  public function categories(): MorphToMany
  {
      return $this->morphToMany(Category::class, 'categoryable');
  }
  /**
   * Get all of the post's comments.
   */
  public function comments(): MorphMany
  {
      return $this->morphMany(Comment::class, 'commentable')->whereNotNull('approved_at')->whereNull('parent_id');
  }
  public function attrs()
  {
    return $this->morphMany(Attr::class, 'attributable');
  }
}
