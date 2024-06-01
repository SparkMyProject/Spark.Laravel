<?php

namespace App\Models\Authentication;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
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
    'username', // Unique, max:20
    'display_name', // nullable, max:30
    'email', // Unique, nullable, max:128
    'profile_photo_path', // default determined by Eloquent, max:2048
    'status', // default: 'Relaxing...', nullable, max:30
    'timezone', // default: 'UTC', enum: ['EST', 'UTC', 'AEST', 'CST', 'PST']
    'account_status', // default: 'Active', enum: ['Active', 'Disabled', 'Banned']
    'first_name', // nullable, max:128
    'last_name' // nullable, max:128
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

  public function getFullNameAttribute()
  {
    return $this->first_name . ' ' . $this->last_name;
  }

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logFillable()->dontSubmitEmptyLogs()->logOnlyDirty()->setDescriptionForEvent(function (string $eventName) {
        return "User Model {$eventName}";
      });
    // Chain fluent methods for configuration options
  }

  public function getDisplayNameAttribute()
  {
    return array_key_exists('display_name', $this->attributes) && $this->attributes['display_name']
      ? $this->attributes['display_name']
      : $this->attributes['username'];
  }

  public function getHighestRole()
  {
    // Greater the number, the higher the priority
    return $this->roles->sortBy('priority')->first();
  }

  public function timeline() {
    return $this->hasOne(UserTimeline::class, 'user_id', 'id');
  }

  public function updateProfilePhoto(UploadedFile $photo, $storagePath = 'avatars')
  {
    tap($this->profile_photo_path, function ($previous) use ($photo, $storagePath) {
      $this->forceFill([
        'profile_photo_path' => $photo->storePublicly(
          $storagePath, ['disk' => $this->profilePhotoDisk()]
        ),
      ])->save();

      if ($previous) {
        Storage::disk($this->profilePhotoDisk())->delete($previous);
      }
    });
  }


  // Have to override default use HasProfilePhoto methods, because we don't have 'name' anymore.
  public function profilePhotoUrl(): Attribute
  {
    return Attribute::get(function (): string {
      return $this->profile_photo_path
        ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
        : $this->defaultProfilePhotoUrl();
    });
  }
  protected function defaultProfilePhotoUrl()
  {
    $name = $this->getFullNameAttribute() ?? $this->getDisplayNameAttribute();

    return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
  }

  public function setDiscordAvatar()
  {
    if (!$this->oauthUser) {
      return;
    }
    $avatarContent = file_get_contents($this->oauthUser->avatar);
    $tempPath = tempnam(sys_get_temp_dir(), 'avatars-temp');
    file_put_contents($tempPath, $avatarContent);

    $avatarFile = new UploadedFile($tempPath, 'avatar.png', 'image/png', null, true);
    $this->updateProfilePhoto($avatarFile);
  }
}
