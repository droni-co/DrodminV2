<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Lead extends Model
{
  use HasUuids;
  public function site()
  {
    return $this->belongsTo(Site::class);
  }
}
