<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * CLIENT -> ORDER
         * LISTAGEM DE TODOS OS PEDIDOS DO CLIENTE X
         */
        $client = Client::find(1);

        $orders = $client->orders()->get();

        echo "<h1>Pedidos do Cliente: {$client->name}</h1>";

        echo "<h3>Seus Pedidos são:</h3>";
        echo "<ul>";
        foreach ($orders as $order) {
            echo "<li>#ID: {$order->id}</li>";
            echo "<li>#Data de Compra: {$order->purchase_date}</li>";
            echo "<li>#Preço: {$order->price}</li>";
            echo "<li>#Quantidade: {$order->quantity}</li><hr>";
        }
        echo "</ul>";

        // $client_orders = Client::find(1)->orders;
 
        // foreach ($client_orders as $order) {
        //     echo "<li>#ID: {$order->id}</li>";
        //     echo "<li>{$order->purchase_date}</li>";
        //     echo "<li>{$order->price}</li>";
        //     echo "<li>{$order->quantity}</li><hr>";
        // }

        /**
         * ORDER -> CLIENT
         * A QUAL CLIENTE O PEDIDO X PERTENCE
         */
        $order = Order::find(1);
        $client = $order->client->name;
        $order_id = $order->client->id;

        echo "<h3>O Pedido #ID: {$order_id} pertence ao Cliente: {$client}</h3>";

        $client = $order->client()->get()->first();
        echo $client->name;

        /**
         * ORDER -> PRODUCTS
         * QUAIS SÃO OS PEDIDOS DO PRODUTO X
         */
        $order_products = Order::find(1);

        echo "<h3>Os Produtos do Pedido: {$order_products->id} são:</h3>";
        echo "<ul>";
        foreach ($order_products->orderProducts()->get() as $product) {
            echo "<li>#ID: {$product->id}</li>";
            echo "<li>Categoria: {$product->categories->name}</li>";
            echo "<li>Produto: {$product->name}</li>";
            echo "<li>Valor: {$product->value}</li><hr>";
            echo "<li>Estoque: {$product->stock->quantity_in_stock}</li><hr>";
        }
        echo "</ul>";

        /**
         * ORDER -> PAYMENTS
         * QUAL FORMA DE PAGAMENTO DO PEDIDO X
         */
        $orderPayment = $order_products->orderPayments()->get();

        foreach ($orderPayment as $payment) {
            echo "<h4>Forma de Pagamento é: {$payment->name}</h4>";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
