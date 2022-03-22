<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\addPurshesInInventoryEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class addPurshesInInventoryListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(addPurshesInInventoryEvent $event)
    {
        dd($event->purchas_detalis->product_id);
    }
}
