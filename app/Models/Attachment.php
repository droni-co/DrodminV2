<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
  use HasFactory;
  protected $appends = ['url'];

  public function getUrlAttribute() {
    return Storage::disk('digitalocean')->url($this->path);
  }
}
