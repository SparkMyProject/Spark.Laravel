<?php

namespace App\Models\Authentication;

use Illuminate\Database\Eloquent\Model;
class OAuthUser extends Model
{
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
