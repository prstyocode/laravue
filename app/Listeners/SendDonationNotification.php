<?php

namespace App\Listeners;

use App\Events\Donated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDonationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Donated  $event
     * @return void
     */
    public function handle(Donated $event)
    {
        dump('notified!');
    }
}
