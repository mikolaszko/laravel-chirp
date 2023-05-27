<?php



namespace App\Listeners;

use App\Events\ChirpCreated;

use App\Models\User;

use App\Notifications\NewChirp;

use Illuminate\Contracts\Queue\ShouldQueue;



class SendChirpCreatedNotifications implements ShouldQueue {

    /**

     * Handle the event.

     */

    public function handle(ChirpCreated $event): void

    {

        //

        foreach (User::where('id', $event->chirp->user_id)->cursor() as $user) {
            $user->notify(new NewChirp($event->chirp));
        }
    }
}
