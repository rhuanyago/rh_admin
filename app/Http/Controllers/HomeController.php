<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** Orders */
        $orders = $this->orders()['openOrders'];
        $finishedOrders = $this->orders()['finishedOrders'];

        /** Clients */
        $clients = $this->clients();

        /** Products */
        $products = $this->products();

        return view('home', compact('orders', 'finishedOrders', 'products', 'clients'));
    }

    public function orders()
    {
        return [
            'finishedOrders' => Order::where('status_id', '4')->get(),
            'openOrders' => Order::where('status_id', '1')->get()
        ];
    }

    private function products()
    {
        return Product::all();
    }

    private function clients()
    {
        return Client::all();
    }
}
