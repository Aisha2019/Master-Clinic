<?php

namespace App\Models;

use App\Notifications\AdminEmailNotification;
use App\Notifications\PatientResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PatientResetPasswordNotification($token));
    }

    //Send password reset notification
    public function sendAdminEmailNotification($email, $subject)
    {
        $this->notify(new AdminEmailNotification($email, $subject, $this->name));
    }
}
