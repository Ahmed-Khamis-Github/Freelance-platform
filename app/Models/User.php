<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'created_at',
        'updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    ##############Relations##################

    public function freelancer()
    {
        return $this->hasOne(Freelancer::class)
            ->withDefault();
    }


    public function projects()
    {
        return $this->hasMany(Project::class);
    }


    public function proposals()
    {
        return $this->hasMany(Proposal::class,'freelancer_id') ;
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class,'freelancer_id') ;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class) ;
    }

    public function proposedProjects()
    {
        return $this->belongsToMany(Project::class,'proposals','freelancer_id')->withPivot([
            'description', 'cost', 'duration', 'duration_unit', 'status'
        ]) ;
    }

    public function contractedProjects()
    {
        return $this->belongsToMany(Project::class,'contracts','freelancer_id')->withPivot([
            'cost', 'type', 'start_on', 'end_on','completed_on','hours','status'
        ]) ;
    }

    public function getProfilePhotoAttribute()
    {
        if ($this->freelancer->profile_photo_path) {
            return asset('storage/' . $this->freelancer->profile_photo_path);
        }
        return asset('images/default-profile.png');
    }

    public function getNameAttribute($value)
    {
        return Str::title($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Str::lower($value);
    }

   

    public function receivesBroadcastNotificationsOn(){
        return 'Notification.'.$this->id ;
    }

    public function routeNotificationForVonage($notification)
    {
        return $this->mobile_number ;
    }


    public function hasAbility($ability)
    {
        foreach ($this->roles as $role) {
            if (in_array($ability, $role->abilities)) {
                return true;
            }
        }
        return false;
    }


}
