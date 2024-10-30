<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User; // tambahkan ini 
use App\Notifications\NewChirp; // dan ini
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// class SendChirpCreatedNotifications // ubah baris ini
class SendChirpCreatedNotifications implements ShouldQueue // menjadi ini
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChirpCreated $event): void
    {
        // tambahkan ini
        foreach (User::whereNot('id', $event->chirp->user_id)->cursor() as $user) {
            $user->notify(new NewChirp($event->chirp));
        }
    }
}
