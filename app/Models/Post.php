<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
  public function categories()
  {
    return $this->belongsToMany(Category::class);
  }
}
