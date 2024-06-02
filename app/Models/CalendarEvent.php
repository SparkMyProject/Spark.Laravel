<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class CalendarEvent extends Model
{
  use LogsActivity;
  use CausesActivity;

  protected $table = 'calendar_events';
  protected $fillable = [
    'calendar_id',
    'user_id',
    'title',
    'label',
    'start_date',
    'end_date',
    'all_day',
    'url',
    'description',
  ];

  public function calendar()
  {
    return $this->belongsTo(Calendar::class);
  }


  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logFillable()->dontSubmitEmptyLogs()->logOnlyDirty()->setDescriptionForEvent(function (string $eventName) {
        return "Calendar Model {$eventName}";
      });
  }
}
