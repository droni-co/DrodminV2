<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Topic extends Model
{
  use HasFactory, HasUuids;

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  /**
   * Get all of the post's comments.
   */
  public function comments(): MorphMany
  {
    return $this->morphMany(Comment::class, 'commentable')->whereNotNull('approved_at')->whereNull('parent_id');
  }

}
