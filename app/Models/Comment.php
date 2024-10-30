<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class Comment extends Model
{
  use HasFactory, HasUuids;

  /**
   * Get the parent commentable model (post or video).
   */
  public function commentable(): MorphTo
  {
    return $this->morphTo();
  }
  public function site()
  {
    return $this->belongsTo(Site::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function parent()
  {
    return $this->belongsTo(Comment::class, 'parent_id');
  }

  public function children()
  {
    return $this->hasMany(Comment::class, 'parent_id')->whereNotNull('approved_at');
  }
}
