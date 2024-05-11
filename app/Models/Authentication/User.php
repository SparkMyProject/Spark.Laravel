<?php

namespace App\Models\Authentication;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable
{
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use TwoFactorAuthenticatable;
  use \Spatie\Permission\Traits\HasRoles;
  use CausesActivity;


  use LogsActivity;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'username',
    'display_name',
    'email',
    'profile_photo_path',
    'status',
    'timezone',
    'account_status',
    'first_name',
    'last_name'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array<int, string>
   */
  protected $appends = [
    'profile_photo_url',
  ];

  public function oauthUser()
  {
    return $this->hasOne(OAuthUser::class, 'user_id', 'id');
  }

  public function getProfilePhotoUrlAttribute()
  {
    $path = $this->attributes['profile_photo_path'];

    if (Storage::exists($path)) {
      return Storage::url($path);
    }

    return asset('assets/img/avatars/1.png'); // default avatar, just in case of a missing file
  }

  public function getFullNameAttribute()
  {
    return $this->first_name . ' ' . $this->last_name;
  }

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logFillable()->dontSubmitEmptyLogs()->logOnlyDirty();
    // Chain fluent methods for configuration options
  }

}
