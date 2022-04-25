<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderStatus;
use App\Models\StockProduct;
use Illuminate\Http\Request;
use App\Events\OrderProductItems;

class TesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

                //Disparar evento e ver como é escutado...

            // quem está escutando: UpdateRemovingItemsInStock->handle(OrderProductItems)
        // echo '<pre>';
        // print_r(Product::with('stock')->find(1)->quantity_in_stock);
        // echo '</pre>';

        // exit;

        /** Cliente com seu pedido e seus produtos */
        // $client = Client::with('ordersMany')->find(2);

        // echo "<h1>Pedidos do Cliente: {$client->name}</h1>";
        // echo "<ul>";
        // foreach ($client->ordersMany as $order) {
        //     echo "<li>#ID: {$order->id}</li>";
        //     echo "<li>#Data de Compra: {$order->purchase_date}</li>";
        //     echo "<li>#Preço: {$order->price}</li>";
        //     echo "<li>#Quantidade: {$order->quantity}</li><hr>";

        //     echo "<h3>Os Produtos do Pedido: {$order->id} são:</h3>";
        //     echo "<ul>";
        //     foreach ($order->orderProducts as $product) {
        //         echo "<li>#ID: {$product->id}</li>";
        //         echo "<li>Categoria: {$product->categories->name}</li>";
        //         echo "<li>Produto: {$product->name}</li>";
        //         echo "<li>Valor: {$product->value}</li><hr>";
        //         echo "<li>Estoque: {$product->stock->quantity_in_stock}</li><hr>";
        //     }
        //     echo "</ul>";
        // }
        // echo "</ul>";

        /** Pedido através do pedido pegando o cliente com seu pedido e seus produtos */

        $order = Order::with('clientMany')->find(3);
        echo "<h3>Pedido {$order->id}:</h3>";

        echo "Cliente: {$order->clientMany->first()->name}";

        echo "<h3>Produtos do Pedido {$order->id}:</h3>";

        foreach ($order->orderProducts as $product) {

            echo "<li>#ID Produto: {$product->id}</li>";
            echo "<li>#Data de Compra: {$product->name}</li>";
            echo "<li>#Preço: {$product->value}</li>";
            echo "<li>#Quantidade: {$product->pivot->quantity}</li>";
            echo "<li>#Estoque: {$product->stock->quantity_in_stock}</li><hr>";
        }

        /** Removendo do Estoque */
        // OrderProductItems::dispatch($order); //disparando o evento

        /** Voltando para o Estoque */
        // OrderProductCancelledItems::dispatch($order); //disparando o evento


        exit;
        // exit;
        // echo "<ul>";
        // foreach (Client::with('orders')->get() as $client) {
        //     echo "<h1>Pedidos do Cliente: {$client->name}</h1>";
        //     echo "<h3>Pedidos:</h3>";

        //     foreach ($client->orders as $order) {

        //         echo "<li>#ID: {$order->id}</li>";
        //         echo "<li>#Data de Compra: {$order->purchase_date}</li>";
        //         echo "<li>#Preço: {$order->price}</li>";
        //         echo "<li>#Quantidade: {$order->quantity}</li><hr>";
        //         echo "<ul>";

        //         echo "<h3>Produtos do Pedido {$order->id}:</h3>";
        //         foreach ($order->orderProducts()->get() as $product) {
        //             echo "<li>#ID: {$product->id}</li>";
        //             echo "<li>Categoria: {$product->categories->name}</li>";
        //             echo "<li>Produto: {$product->name}</li>";
        //             echo "<li>Valor: {$product->value}</li><hr>";
        //             echo "<li>Estoque: {$product->stock->quantity_in_stock}</li><hr>";
        //         }
        //         echo "</ul>";

        //     }
        // }
        // echo "</ul>";
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

            echo "<h3>Os Produtos do Pedido: {$order->id} são:</h3>";
            echo "<ul>";
            foreach ($order->orderProducts()->get() as $product) {
                echo "<li>#ID: {$product->id}</li>";
                echo "<li>Categoria: {$product->categories->name}</li>";
                echo "<li>Produto: {$product->name}</li>";
                echo "<li>Valor: {$product->value}</li><hr>";
                echo "<li>Estoque: {$product->stock->quantity_in_stock}</li><hr>";
            }
            echo "</ul>";
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


        // echo '<pre>';
        // print_r(Client::find(1)->orders->find(2)->orderProducts()->get()); exit;
        // echo '</pre>';

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
