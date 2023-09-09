<?php

namespace App\Listeners;

use App\Events\PanelEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class VehicleListener
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
    public function handle(PanelEvent $event): void
    {
        Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı {$event->car->brand_name} {$event->car->model_spec} {$event->car->production_year} {$event->action} ");

    }
}
