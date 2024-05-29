<?php

namespace App\Models\Authentication;

class UserTimelineEvent
{
  protected $table = 'user_timeline_events';
  protected $fillable = [
    'timeline_id',
    'title',
    'description',
    'color',
    'data'
  ];

  public function timeline()
  {
    return $this->belongsTo(UserTimeline::class, 'timeline_id', 'id');
  }
}
