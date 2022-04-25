<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrderProductCancelledItems;
use App\Services\ProductStockManagerService;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateAddingBackItemsInStock
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
     * @param  \App\Events\OrderProductCancelledItems  $event
     * @return void
     */
    public function handle(OrderProductCancelledItems $event)
    {
        (new ProductStockManagerService($event->order))->addingProductInStock();
    }
}
