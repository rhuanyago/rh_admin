<?php

namespace App\Listeners;

use App\Events\OrderProductItems;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\ProductStockManagerService;

class UpdateRemovingItemsInStock
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
     * @param  \App\Events\OrderProductItems  $event
     * @return void
     */
    public function handle(OrderProductItems $event)
    {
        (new ProductStockManagerService($event->order))->removeProductFromStock();
    }
}
