<?php

namespace App\Notifications;

use App\Notifications\MailExtended;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $email;
    protected $subject;
    protected $patient_name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $patient_name)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->patient_name = $patient_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->subject)
                    ->markdown('mail.admin', ['content' => $this->email, 'patient_name' => $this->patient_name]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
