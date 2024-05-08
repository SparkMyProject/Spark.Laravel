<?php

namespace App\Models\Authentication;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
class OAuthUser extends Model
{
  use HasUuids;
  protected $table = 'oauth_users';
  protected $fillable = [
    'user_id',
    'provider_id',
    'email',
    'username',
    'avatar',
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
