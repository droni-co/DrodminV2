<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attr extends Model
{
  use HasFactory;

  protected $fillable = ['site_id', 'name', 'value', 'attributable_id', 'attributable_type'];

  /**
   * Get the parent commentable model (post or video).
   */
  public function attributable(): MorphTo
  {
      return $this->morphTo();
  }
}
