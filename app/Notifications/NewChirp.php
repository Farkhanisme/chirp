<?php

namespace App\Notifications;

use App\Models\Chirp; // tambahkan ini
use Illuminate\Bus\Queueable;
use Illuminate\Support\Str; // dan ini
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewChirp extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    // public function __construct() // ubah ini
    public function __construct(public Chirp $chirp) // menjadi ini
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    // ->line('The introduction to the notification.') // hapus line ini
                    // ->action('Notification Action', url('/')) // dan ini
                    ->subject("New Chirp from {$this->chirp->user->name}") // selanjutnya ganti menjadi ini
                    ->greeting("New Chirp from {$this->chirp->user->name}")
                    ->line(Str::limit($this->chirp->message, 50)) 
                    ->action('Go to Chirper', url('/')) // sampai sini
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
