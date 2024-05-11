<?php

namespace App\Models\Authentication;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;

class OAuthUser extends Model
{
  use LogsActivity;
  use CausesActivity;

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

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logFillable()->dontSubmitEmptyLogs()->logOnlyDirty();;
  }
}
