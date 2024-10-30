<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Category extends Model
{
  use HasFactory, HasUuids;

  /**
   * Get all of the posts that are assigned this tag.
   */
  public function posts(): MorphToMany
  {
      return $this->morphedByMany(Post::class, 'categoryable');
  }
}
