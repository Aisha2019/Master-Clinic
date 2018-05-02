<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//Notification for patient
use App\Notifications\PatientResetPasswordNotification;

class Patient extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the comments of a patient file.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\comment')->select('content', 'created_at', 'admin_id')->orderBy('created_at', 'Asc');
    }

    /**
     * Get the prescriptions of a patient file.
     */
    public function prescriptions()
    {
        return $this->hasMany('App\Models\prescription')->select('name', 'created_at', 'admin_id')->orderBy('created_at', 'Asc');
    }

    /**
     * Get the prescriptions of a patient file.
     */
    public function images()
    {
        return $this->hasMany('App\Models\image')->select('image', 'caption', 'created_at', 'admin_id')->orderBy('created_at', 'Asc');
    }

    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PatientResetPasswordNotification($token));
    }
}
