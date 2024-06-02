<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;

class Calendar extends Model
{
  use LogsActivity;
  use CausesActivity;

  protected $table = 'calendars';
  protected $fillable = [
    'name',
    'events'
  ];

  public function events() {
    return $this->hasMany(CalendarEvent::class);
  }


  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logFillable()->dontSubmitEmptyLogs()->logOnlyDirty()->setDescriptionForEvent(function (string $eventName) {
        return "Calendar Model {$eventName}";
      });
  }
}
