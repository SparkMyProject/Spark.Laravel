<?php

namespace App\Models\Authentication;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;

class UserTimeline extends Model
{
  use LogsActivity;
  use CausesActivity;

  protected $table = 'user_timeline';
  protected $fillable = [
    'user_id',
    'events'
  ];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function events()
  {
    return $this->hasMany(UserTimelineEvent::class, 'timeline_id', 'id');
  }

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logFillable()->dontSubmitEmptyLogs()->logOnlyDirty()->setDescriptionForEvent(function (string $eventName) {
        return "OAuthUser Model {$eventName}";
      });
  }
}
