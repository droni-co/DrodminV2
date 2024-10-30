<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Enrollment extends Model
{
  use HasFactory, HasUuids;

  protected $fillable = [
    'user_id',
    'site_id'
  ];

  protected $hidden = [
    'apikey'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function site()
  {
    return $this->belongsTo(Site::class);
  }
}
